<?php

namespace App\Repositories\Eloquents;

use App\Models\Review;
use App\Models\Service;
use Illuminate\Support\Facades\Log;
use App\Repositories\Interfaces\ReviewRepositoryInterface;
use App\Traits\PaginateTrait;

class ReviewRepository implements ReviewRepositoryInterface
{
    use PaginateTrait;
    protected $model;
    protected $service;
    public function __construct(Review $model, Service $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
    public function index()
    {
        return $this->model->with('user','service')->latest()->paginate(9); 
    }
    public function getByUserAndService(int $userId, int $serviceId)
    {
        return $this->model->where('user_id', $userId)
            ->where('service_id', $serviceId)
            ->first();
    }
    public function getServiceAverageRating(int $serviceId)
    {
        return $this->model->where('service_id', $serviceId)->avg('rating');
    }
    public function submitReview(array $data)
    {
        $review = $this->model->create($data);
        $review->load(['user' => function ($query) {
            $query->with(['languages.language']);
        }]);
        $averageRating = $this->getServiceAverageRating($data['service_id']);
        $count = $this->getReviewsCount($data['service_id']);
        $this->service->find($data['service_id'])->update(['rating' => $averageRating, 'reviews_count' => $count]);
        return $review;
    }
    public function getReviewsByUser($userId, $perPage = null)
    {
        $query = $this->model->where('user_id', $userId)
            ->with(['service', 'user'])
            ->latest();
        return $this->paginate($query, $perPage);
    }
    public function getReviewsByService($serviceId, $perPage = null)
    {
        $query = $this->model->where('service_id', $serviceId)
            ->with(['service', 'user'])
            ->latest();
        return $this->paginate($query, $perPage);
    }
    public function getUserServiceReview($userId, $serviceId)
    {
        return $this->model->where('user_id', $userId)
            ->where('service_id', $serviceId)
            ->first();
    }
    public function getReviewsCount($serviceId)
    {
        return $this->model->where('service_id', $serviceId)->count();
    }
    public function getAverageRatingByUser($userId)
    {
        return number_format($this->model->where('user_id', $userId)->avg('rating'));
    }
}
