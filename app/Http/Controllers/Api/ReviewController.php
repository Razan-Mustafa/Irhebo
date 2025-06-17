<?php

namespace App\Http\Controllers\Api;

use App\Traits\BaseResponse;
use App\Services\ReviewService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Http\Requests\Api\ReviewRequest;
use App\Models\Notification;
use App\Models\PlayerId;
use App\Services\OneSignalService;
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
            $user=$review->service->user;
            // one signal notification*****************************************
            if ($user) {
                $playerIdRecord = PlayerId::where('user_id', $user->id)
                    ->where('is_notifiable', 1)
                    ->pluck('player_id')->toArray();


                if ($playerIdRecord) {
                    $titles = [
                        'en' => __('messages.rated_title', [], 'en'),
                        'ar' => __('messages.rated_title', [], 'ar'),
                    ];

                    $messages = [
                        'en' => __('messages.rated_message', ['client' => $review->user->username], 'en'),
                        'ar' => __('messages.rated_message', ['client' => $review->user->username], 'ar'),
                    ];

                    $response = app(OneSignalService::class)->sendNotificationToUser(
                        $playerIdRecord, // نرسل player_id من جدول player_ids
                        $titles,
                        $messages
                    );

                    Notification::create([
                        'user_id'           => $user->id,
                        'title'             => json_encode($titles),
                        'body'              => json_encode($messages),
                        'type'              => 'rate',
                        'type_id'           => $review['service_id'],
                        'is_read'           => false,
                        'onesignal_id'      => $response['id'] ?? null,
                        'response_onesignal' => json_encode($response),
                    ]);
                }
            }
            // *********************************************//
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
