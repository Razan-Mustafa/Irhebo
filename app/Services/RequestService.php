<?php

namespace App\Services;

use App\Models\Finance;
use App\Models\General;
use App\Models\Plan;
use App\Models\PlanFeature;
use App\Repositories\Interfaces\RequestRepositoryInterface;
use App\Services\ServiceService;
use Carbon\Carbon;

class RequestService
{
    protected $requestRepository;
    protected $serviceService;
    public function __construct(RequestRepositoryInterface $requestRepository, ServiceService $serviceService)
    {
        $this->requestRepository = $requestRepository;
        $this->serviceService = $serviceService;
    }
    public function getAll()
    {
        return $this->requestRepository->getAll();
    }
    public function getByUser($perPage = null)
    {
        return $this->requestRepository->getByUser($perPage);
    }
    public function getByFreelancer($perPage = null)
    {
        return $this->requestRepository->getByFreelancer($perPage);
    }

    public function createRequest(array $data)
    {
        $service = $this->serviceService->getServiceById($data['service_id']);
        $data['user_id'] = auth()->guard('api')->user()->id;
        $data['order_number'] = '#' . mt_rand(100000, 999999);
        $data['title'] = $service->translation->title;
        $data['image'] = $service->media->where('is_cover', true)->first()->media_path??  null;
        $plan = Plan::where('id', $data['plan_id'])
            ->with(['features' => function ($query) use ($data) {
                $query->where('type', 'delivery_days')->where('service_id', $data['service_id']);
            }])
            ->first();

        $deliveryDaysValue = intval($plan->features->first()->value);
        $data['start_date'] = now();
        $data['end_date'] = Carbon::now()->addDays($deliveryDaysValue)->toDateString();


        // new
        $plan = Plan::where('id', $data['plan_id'])
            ->with(['features' => function ($query) use ($data) {
                $query->where('service_id', $data['service_id']);
            }])
            ->first();

        // Get price feature
        $priceFeature = $plan->features->where('type', 'price')->first();
        $amount = floatval(optional($priceFeature)->value ?? 0);

        // ممكن تحسب عمولة أو رسوم أو خصم إذا بدك
        $feesValue = floatval(optional(General::where('key', 'fees')->first())->value ?? 0);
        $commissionValue = floatval(optional(General::where('key', 'commission')->first())->value ?? 0);
        $feesAmount = ($amount * $feesValue) / 100;
        $commissionAmount = ($amount * $commissionValue) / 100;
        $discount = 0;
        $total = $amount + $feesAmount + $commissionAmount - $discount;

        // Create request
        $request = $this->requestRepository->createRequest($data);

        // Create finance record
        Finance::create([
            'request_id'     => $request->id,
            'amount'         => $amount,
            'fees'           => $feesAmount,
            'commission'     => $commissionAmount,
            'discount'       => $discount,
            'total'          => $total,
            'payment_status' => 'unpaid',
            'payment_method' => 'credit_card',
            'paid_at'        => null,
        ]);
        // dd($price->value);
        return $this->requestRepository->createRequest($data);
    }
    public function getRequestDetails($id)
    {
        return $this->requestRepository->getRequestDetails($id);
    }
    public function addComment($data)
    {
        return $this->requestRepository->addComment($data);
    }
    public function confirmRequest($id)
    {
        return $this->requestRepository->confirmRequest($id);
    }
}
