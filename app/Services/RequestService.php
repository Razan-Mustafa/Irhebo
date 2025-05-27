<?php

namespace App\Services;

use App\Models\Plan;
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
    public function getAll(){
        return $this->requestRepository->getAll();
    }
    public function getByUser($perPage = null){
        return $this->requestRepository->getByUser($perPage);
    }
    public function getByFreelancer($perPage = null){
        return $this->requestRepository->getByFreelancer($perPage);
    }

    public function createRequest(array $data)
    {
        $service = $this->serviceService->getServiceById($data['service_id']);
        $data['user_id'] = auth()->guard('api')->user()->id;

        $data['order_number'] = '#' . mt_rand(100000, 999999);
        $data['title'] = $service->translation->title;
        $data['image'] = $service->media->where('is_cover', true)->first()->media_path;
        $plan = Plan::where('id', $data['plan_id'])
            ->with(['features' => function ($query) use ($data){
                $query->where('type', 'delivery_days')->where('service_id',$data['service_id']);
            }])
            ->first();

        $deliveryDaysValue = intval($plan->features->first()->value);
        $data['start_date'] = null;
        $data['end_date'] = Carbon::now()->addDays($deliveryDaysValue)->toDateString();
        return $this->requestRepository->createRequest($data);
    }
    public function getRequestDetails($id){
        return $this->requestRepository->getRequestDetails($id);
    }
    public function addComment($data){
        return $this->requestRepository->addComment($data);
    }
    public function confirmRequest($id){
        return $this->requestRepository->confirmRequest($id);
    }

}
