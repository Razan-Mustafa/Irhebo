<?php

namespace App\Http\Controllers\Api;

use App\Traits\BaseResponse;
use App\Services\ReviewService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\Api\ReviewRequest;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use BaseResponse;

    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function submitReview(ReviewRequest $request)
    {
        try {
            $review = $this->reviewService->submitReview($request->validated());
            if (isset($review['error']) && $review['error']) {
                return $this->errorResponse($review['message']);
            }
            return $this->successResponse(
                __('review_submitted_successfully'),
                new ReviewResource($review)
            );
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, __('failed_to_submit_review'));
        }
    }
    public function getReviewsByUser(Request $request, $userId)
    {
        $perPage = $request->query('per_page');
        try {
            $reviews = $this->reviewService->getReviewsByUser($userId, $perPage);
            return $this->successResponse(
                __('reviews_retrieved_successfully'),
                [
                    'reviews' => ReviewResource::collection($reviews['data']),
                    'meta' => $reviews['meta']

                ]
            );
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, __('failed_to_retrieve_reviews'));
        }
    }
    public function getReviewsByService($serviceId)
    {
        try {
            $perPage = request()->query('per_page');
            $reviews = $this->reviewService->getReviewsByService($serviceId, $perPage);
            return $this->successResponse(
                __('reviews_retrieved_successfully'),
                [
                    'reviews' => ReviewResource::collection($reviews['data']),
                    'meta' => $reviews['meta']

                ]
            );
        } catch (\Exception $e) {
            return $this->exceptionResponse($e, __('failed_to_retrieve_reviews'));
        }
    }
}
