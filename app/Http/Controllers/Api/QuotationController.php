<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\QuotationCommentRequest;
use App\Http\Requests\Api\QuotationRequest;
use App\Http\Resources\QuotationCommentResource;
use App\Http\Resources\QuotationResource;
use App\Services\QuotationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class QuotationController extends Controller
{
    protected $quotationService;

    public function __construct(QuotationService $quotationService)
    {
        $this->quotationService = $quotationService;
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
        $userId = Auth::id();
        if (!$userId) {
            return $this->errorResponse(__('unauthorized'));
        }
        $data = array_merge($request->validated(), ['user_id' => $userId]);
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
            return $this->successResponse(__('quotations_comments_retrieved_successfully'),QuotationCommentResource::collection($comments));
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, __('failed_to_retrieve_quotations_comments'));
        }
       }

}