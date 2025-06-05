<?php

namespace App\Http\Controllers\Api;

use App\Services\TagService;
use Illuminate\Http\Request;
use App\Services\ServiceService;
use App\Http\Resources\TagResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ServiceDetailsResource;
use App\Http\Resources\FeaturedServiceResource;
use App\Http\Requests\Api\GetServicesBySubCategoryRequest;
use App\Http\Requests\Api\ServiceRequest;
use App\Http\Requests\Api\UpdateServiceRequest;
use App\Http\Resources\PortfolioResource;
use App\Services\PortfolioService;
use App\Services\ReviewService;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Utilities\CurrencyConverter;
use App\Models\Currency;
use App\Models\Service;

class ServiceController extends Controller
{
    protected $serviceService;
    protected $tagService;
    protected $portfolioService;
    protected $reviewService;
    public function __construct(ServiceService $serviceService, TagService $tagService, PortfolioService $portfolioService, ReviewService $reviewService)
    {
        $this->serviceService = $serviceService;
        $this->tagService = $tagService;
        $this->portfolioService = $portfolioService;
        $this->reviewService = $reviewService;
    }
    public function getBySubCategory(GetServicesBySubCategoryRequest $request)
    {
        $subCategoryId = $request->query('sub_category_id');
        $perPage = $request->query('per_page', 15);
        $services = $this->serviceService->getBySubCategory($subCategoryId, $perPage);
        // dd($services);
        $tags = $this->tagService->getTagsBySubcategoryId($subCategoryId);
        return $this->successResponse(__('success'), [
            'services' => ServiceResource::collection($services['data']),
            'meta' => $services['meta'],
            'tags' => TagResource::collection($tags)
        ]);
    }
    public function getServicesByTag(Request $request, $tag)
    {
        $perPage = $request->query('per_page', 15);
        $services = $this->serviceService->getServicesByTag($tag, $perPage);
        return $this->successResponse(__('success'), [
            'services' => ServiceResource::collection($services['data']),
            'meta' => $services['meta']
        ]);
    }
    public function getRecommendedServices(Request $request)
    {
        $perPage = $request->query('per_page', 15);
        $services = $this->serviceService->getRecommendedServices($perPage);
        return $this->successResponse(__('success'), [
            'services' => ServiceResource::collection($services['data']),
            'meta' => $services['meta']
        ]);
    }
    public function getFeaturedServices(Request $request)
    {
        $perPage = $request->query('per_page', 15);
        $services = $this->serviceService->getFeaturedServices($perPage);
        return $this->successResponse(
            __('success'),
            [
                'services' => FeaturedServiceResource::collection($services['data']),
                'meta' => $services['meta']
            ]
        );
    }
    public function getServicesByUserId(Request $request)
    {
        $perPage = $request->query('per_page', 15);
        $userId =  Auth::id() ?? $request->query('user_id');
        // dd($userId);
        $services = $this->serviceService->getServicesByUserId($userId, $perPage);
        return $this->successResponse(
            __('success'),
            [
                'services' => ServiceResource::collection($services['data']),
                'meta' => $services['meta']
            ]
        );
    }
    public function serviceDetails($serviceId)
    {
        $service = $this->serviceService->getServiceDetails($serviceId);
        $portfolio = $this->portfolioService->getPortfolioByService($service->id);
        $recommended = $this->serviceService->getRelatedServices($serviceId);
        $plans = $this->serviceService->getPlansByServiceId($serviceId);
        $plans = $plans->map(function ($planItem) {
            return [
                'id' => $planItem->plan->id,
                'title' => $planItem->plan->translation->title,
                'features' => collect($planItem->features)->map(function ($feature) {
                    return collect([
                        'type' => $feature->type,
                        'title' => $feature->translation->title,
                        'value' => $feature->value,
                    ]);
                }),
            ];
        });

        $avgUserRate = $this->reviewService->getAverageRatingByUser($service->user_id);
        return $this->successResponse(__('success'), [
            'service' => new ServiceDetailsResource($service, $avgUserRate),
            'portoflio' => PortfolioResource::collection($portfolio),
            'reviews' => ReviewResource::collection($service->reviews->load('user.profession')),
            'recommended' => ServiceResource::collection($recommended),
            'plans' => $plans,
        ]);
    }

    public function search(Request $request)
    {
        $query = trim($request->query('query', ''));
        $perPage = $request->query('per_page', 15);
        $subCategoryId = $request->query('sub_category_id');
        if (empty($query) || strlen($query) < 3) {
            return $this->successResponse(__('Please enter at least 2 characters to search'), [
                'services' => [],
                'meta' => [
                    'total' => 0,
                    'per_page' => $perPage,
                    'current_page' => 1
                ]
            ], 422);
        }
        $services = $this->serviceService->search($query, $subCategoryId, $perPage);
        return $this->successResponse(__('success'), [
            'services' => ServiceResource::collection($services['data']),
            'meta' => $services['meta']
        ]);
    }
    // public function create(ServiceRequest $request)
    // {
    //     try {
    //         $data = $request->validated();
    //         $data = array_merge($data, ['user_id' => Auth::id()]);
    //         dd($data);
    //         $service = $this->serviceService->create($data);
    //         return $this->successResponse(__('success'), new ServiceDetailsResource($service));
    //     } catch (Exception $e) {
    //         return $this->exceptionResponse($e);
    //     }
    // }
    public function create(ServiceRequest $request)
    {
        try {

            $currencyCode = $request->header('currency', 'USD');
            $currencyModel = Currency::where('code', strtoupper($currencyCode))->first();
            $symbol = $currencyModel ? $currencyModel->symbol : '$';

            $data = $request->validated();

            // Get currency code from header (default 'USD')
            $currencyCode = $request->currency;
            // dd($data['plans']);

            // Loop on each plan and convert price to USD
            foreach ($data['plans'] as &$plan) {
                foreach ($plan['features'] as &$feature) {
                    if ($feature['type'] === 'price') {
                        // Convert price to USD
                        $feature['value'] = CurrencyConverter::convert($feature['value'], $currencyCode, 'USD');
                    }
                }
            }

            // Add user id
            $data['user_id'] = Auth::id();

            // Continue with saving
            $service = $this->serviceService->create($data);

            return $this->successResponse(__('success'), new ServiceDetailsResource($service));
        } catch (Exception $e) {
            return $this->exceptionResponse($e);
        }
    }

    // public function update(UpdateServiceRequest $request, $id)
    // {
    //     try {
    //         $data = $request->validated();
    //         $data = array_merge($data, ['user_id' => Auth::id()]);
    //         $service = $this->serviceService->update($data, $id);
    //         return $this->successResponse(__('success'), new ServiceDetailsResource($service));
    //     } catch (Exception $e) {
    //         return $this->exceptionResponse($e);
    //     }
    // }

    public function update(UpdateServiceRequest $request, $id)
    {
        try {
            // Get currency code from header (default 'USD')
            $currencyCode = $request->currency;
            $currencyModel = Currency::where('code', strtoupper($currencyCode))->first();
            $symbol = $currencyModel ? $currencyModel->symbol : '$';

            $data = $request->validated();

            // Add user id
            $data['user_id'] = Auth::id();

            // Fetch service
            $service = Service::findOrFail($id);

            // Loop on each plan and handle update
            foreach ($data['plans'] as $planData) {

                $plan = $service->plans()->where('plan_id', $planData['plan_id'])->first();
                $service_id = ($plan->pivot->service_id);
                if ($plan) {
                    // plan exists -> update its features
                    foreach ($planData['features'] as $featureData) {
                        $feature = $plan->features()->where('type', $featureData['type'])->where('service_id', $service_id)->first();
                        if ($feature) {
                            // Convert price if it's price type
                            // dd($featureData['type']);
                            if ($featureData['type'] === 'price') {
                                $featureData['value'] = CurrencyConverter::convert($featureData['value'], $currencyCode, 'USD');
                            }

                            // Update feature value
                            $feature->update([
                                'title' => $featureData['title'],
                                'value' => $featureData['value'],
                            ]);
                        } else {
                            // if feature not exists, create it
                            $plan->features()->create([
                                'title' => $featureData['title'],
                                'type'  => $featureData['type'],
                                'value' => $featureData['type'] === 'price'
                                    ? CurrencyConverter::convert($featureData['value'], $currencyCode, 'USD')
                                    : $featureData['value'],
                            ]);
                        }
                    }
                } else {
                    // if plan not exists, create it with its features
                    $newPlan = $service->servicePlans()->create([
                        'plan_id' => $planData['plan_id'],
                    ]);

                    foreach ($planData['features'] as $featureData) {
                        $newPlan->features()->create([
                            'title' => $featureData['title'],
                            'type'  => $featureData['type'],
                            'value' => $featureData['type'] === 'price'
                                ? CurrencyConverter::convert($featureData['value'], $currencyCode, 'USD')
                                : $featureData['value'],
                        ]);
                    }
                }
            }

            return $this->successResponse(__('success'), new ServiceDetailsResource($service));
        } catch (Exception $e) {
            return $this->exceptionResponse($e);
        }
    }


    public function delete($id)
    {
        try {
            $this->serviceService->delete($id);
            return $this->successResponse(__('success'));
        } catch (Exception $e) {
            return $this->exceptionResponse($e);
        }
    }
    public function deleteMedia($id)
    {
        try {
            $this->serviceService->deleteMedia($id);
            return $this->successResponse(__('success'));
        } catch (Exception $e) {
            return $this->exceptionResponse($e);
        }
    }
}
