<?php

namespace App\Http\Controllers\Api;

use App\Models\PlanFeature;
use Illuminate\Http\Request;
use App\Services\PlanService;
use App\Services\ServiceService;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use App\Http\Resources\ServiceDetailsResource;
use App\Models\Currency;
use App\Models\General;
use App\Models\Plan;
use App\Utilities\CurrencyConverter;

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
        $fees = General::where('key', 'fees')->first()->value / 100;
        $commission = General::where('key', 'commission')->first()->value / 100;


        $currencyCode = $request->header('currency', 'USD');
        $currencyModel = Currency::where('code', strtoupper($currencyCode))->first();
        $symbol = $currencyModel ? $currencyModel->symbol : '$';

        //  dd($planPrice);
        $planPriceConverted = $planPrice->value ? CurrencyConverter::convert($planPrice->value, 'USD', $currencyCode) : null;
        $feesConverted = ($planPrice->value * $fees) ? CurrencyConverter::convert(($planPrice->value * $fees), 'USD', $currencyCode) : null;
        $commissionConverted = ($planPrice->value * $commission) ? CurrencyConverter::convert(($planPrice->value * $commission), 'USD', $currencyCode) : null;
        $total = ($planPriceConverted) + ($feesConverted) + ($commissionConverted);

        return $this->successResponse('success', [
            'request_info' => [
                'title' => $service->translation->title,
                'description' => $service->translation->description,
                'plan_title' => $plan->translation->title,
                'sub_total' => $planPriceConverted ? number_format($planPriceConverted, 2) . $symbol  : null,
                'fees' => $feesConverted ? number_format($feesConverted, 2) . $symbol  : null,
                'commission' => $commissionConverted ? number_format($commissionConverted, 2) . $symbol  : null,
                'total' => $total ? number_format($total, 2) . $symbol  : null,

            ],
        ]);
    }
}
