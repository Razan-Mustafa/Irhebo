<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Get all general notifications and user-specific notifications.
     */
    public function getNotifications(Request $request)
    {
        $perPage = request('per_page', null);
        $userId = Auth::guard('api')->id();
       
        $notifications = $this->notificationService->getUserNotifications($userId, $perPage);

        return $this->successResponse(__('notifications_retrieved'), [
            'notifications' => NotificationResource::collection($notifications['data']),
            'meta' => $notifications['meta'],
        ]);
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead()
    {
        $userId = Auth::id();

        $result = $this->notificationService->markNotificationAsRead($userId);

            return $this->successResponse(__('notification_marked_as_read'));
    }
}
