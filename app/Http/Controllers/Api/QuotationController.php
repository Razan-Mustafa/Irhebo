<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\QuotationCommentRequest;
use App\Http\Requests\Api\QuotationRequest;
use App\Http\Resources\QuotationCommentResource;
use App\Http\Resources\QuotationResource;
use App\Http\Resources\RequestResource;
use App\Models\Category;
use App\Services\QuotationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Utilities\CurrencyConverter;
use App\Models\Currency;
use App\Models\Freelancer;
use App\Models\Plan;
use App\Models\PlanFeature;
use App\Models\Quotation;
use App\Models\Quotation_Comments;
use App\Models\Request;
use App\Models\Service;
use App\Services\RequestService;

class QuotationController extends Controller
{
    protected $quotationService;
    protected $requestService;

    public function __construct(QuotationService $quotationService, RequestService $requestService)
    {
        $this->quotationService = $quotationService;
        $this->requestService = $requestService;
    }
    public function getAll()
    {
        try {
            $perPage = request()->query('per_page');
            $quotations = $this->quotationService->getAllQuotations($perPage);
            return $this->successResponse(__('quotations_retrieved_successfully'), [
                'quotations' => QuotationResource::collection($quotations['data']),
                'meta' => $quotations['meta']
            ]);
            return response()->json($quotations);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, __('failed_to_retrieve_quotations'));
        }
    }
    public function getByUserId()
    {
        try {
            $perPage = request()->query('per_page');
            $quotations = $this->quotationService->getByUserId($perPage);
            return $this->successResponse(__('quotations_retrieved_successfully'), [
                'quotations' => QuotationResource::collection($quotations['data']),
                'meta' => $quotations['meta']
            ]);
            return response()->json($quotations);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, __('failed_to_retrieve_quotations'));
        }
    }

    public function createQuotation(QuotationRequest $request): JsonResponse
    {
        $currencyCode = $request->currency;
        $currencyModel = Currency::where('code', strtoupper($currencyCode))->first();
        $symbol = $currencyModel ? $currencyModel->symbol : '$';

        $userId = Auth::id();
        if (!$userId) {
            return $this->errorResponse(__('unauthorized'));
        }
        $data = array_merge($request->validated(), ['user_id' => $userId]);
        $data['price'] = $data['price']
            ? CurrencyConverter::convert($data['price'], $currencyCode, 'USD')
            : null;
        // dd($data , $data['price']);
        $quotation = $this->quotationService->store($data);
        return $this->successResponse(__('success'), new QuotationResource($quotation));
    }



    public function findById(int $id): JsonResponse
    {
        try {
            $quotation = $this->quotationService->getQuotationById($id);
            return $this->successResponse(__('success'), new QuotationResource($quotation));
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, __('failed_to_retrieve_quotations'));
        }
    }

    public function createComment(QuotationCommentRequest $request): JsonResponse
    {
        $userId = Auth::id();

        if (!$userId) {
            return $this->errorResponse(__('unauthorized'));
        }

        $data = array_merge($request->validated(), ['user_id' => $userId]);

        $comment = $this->quotationService->createQuotationComment($data);

        return $this->successResponse(__('success'), new QuotationCommentResource($comment));
    }

    public function getCommentsByQuotationId(int $quotationId): JsonResponse
    {
        try {
            $perPage = request()->query('per_page');
            $comments = $this->quotationService->getCommentsByQuotationId($quotationId, $perPage);
            return $this->successResponse(__('quotations_comments_retrieved_successfully'), QuotationCommentResource::collection($comments));
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, __('failed_to_retrieve_quotations_comments'));
        }
    }
    public function approveQuotation(Request $request, $id)
    {
        $comment = Quotation_Comments::findOrFail($id);
        $quotation = Quotation::findOrFail($comment->quotation_id);
        $category = Category::find($quotation->subCategory->category_id);

        $service = new Service();
        $service->sub_category_id = $quotation->sub_category_id;
        $service->user_id = $comment->user_id;
        $service->status = 'approved';
        $service->save();
        $service->translations()->create([
            'language' => 'en',
            'title' => $quotation->title,
            'description' => $quotation->description,
        ]);

        // Add Arabic translation
        $service->translations()->create([
            'language' => 'ar',
            'title' => $quotation->title,
            'description' => $quotation->description,
        ]);
        // price
        $feature_price = new PlanFeature();
        $feature_price->plan_id = 1;
        $feature_price->service_id = $service->id;
        $feature_price->value = $quotation->price;
        $feature_price->type = 'price';
        $feature_price->save();

        // delivery_days
        $feature_days = new PlanFeature();
        $feature_days->plan_id = 1;
        $feature_days->service_id = $service->id;
        $feature_days->value = $quotation->delivery_day;
        $feature_days->type = 'delivery_days';
        $feature_days->save();

        // revisions
        $feature_revisions = new PlanFeature();
        $feature_revisions->plan_id = 1;
        $feature_revisions->service_id = $service->id;
        $feature_revisions->value = $quotation->revisions;
        $feature_revisions->type = 'revisions';
        $feature_revisions->save();

        // source_files
        $feature_source = new PlanFeature();
        $feature_source->plan_id = 1;
        $feature_source->service_id = $service->id;
        $feature_source->value = $quotation->source_file;
        $feature_source->type = 'source_files';
        $feature_source->save();

        // dd($category);
        $data = [
            'service_id' => $service->id,
            'plan_id' => 1,
        ];

        $request = $this->requestService->createRequest($data);
        $quotation->delete();

        return $this->successResponse(__('success'), __('quotation_approved'));
    }


    public function getByFreelancerId()
    {
        try {
            $perPage = request()->query('per_page');
            // $quotations = $this->quotationService->getAllQuotations($perPage);
            $freelancer = Auth::user();
            $freelancerCategoryIds = $freelancer->categories->pluck('category_id')->toArray();

            $quotations = Quotation::with('user.profession')->whereHas('subCategory', function ($query) use ($freelancerCategoryIds) {
                $query->whereIn('category_id', $freelancerCategoryIds);
            })->paginate($perPage);

            // dd($freelancer, $this->quotationService->getAllQuotations($perPage));

// dd($freelancerCategoryIds, $quotations);

            return $this->successResponse(__('quotations_retrieved_successfully'), [
                'quotations' => QuotationResource::collection($quotations),
                // 'meta' => $quotations['meta']
            ]);
            return response()->json($quotations);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, __('failed_to_retrieve_quotations'));
        }
    }
}
