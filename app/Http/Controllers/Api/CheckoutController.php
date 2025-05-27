<?php

namespace App\Http\Controllers\Api;

use App\Models\PlanFeature;
use Illuminate\Http\Request;
use App\Services\PlanService;
use App\Services\ServiceService;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use App\Http\Resources\ServiceDetailsResource;
use App\Models\Plan;

class CheckoutController extends Controller
{
    protected $serviceService;
    protected $planService;
    public function __construct(ServiceService $serviceService, PlanService $planService)
    {

        $this->serviceService = $serviceService;
        $this->planService = $planService;
    }
    public function proceedCheckout(Request $request)
    {

        $data = $request->validate([
            'service_id' => 'required',
            'plan_id' => 'required',
        ]);
        $service = $this->serviceService->getServiceDetails($data['service_id']);
        $plan = $this->planService->find($data['plan_id']);
        $planFeatures = $service->features()->where('plan_id', $data['plan_id'])->get();
        $planPrice = $planFeatures->where('type', 'price')->first();
        return $this->successResponse('success', [
            'request_info' => [
                'title'=>$service->translation->title,
                'description'=> $service->translation->description,
                'plan_title'=>$plan->translation->title,
                'sub_total'=> isset($planPrice) ? $planPrice->value : "100 $",
                'tax' => "20 $",
                'total'=>"120 $"
            ],
        ]);
    }
}
