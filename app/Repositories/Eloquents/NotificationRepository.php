<?php

namespace App\Repositories\Eloquents;

use App\Models\Notification;
use App\Traits\PaginateTrait;
use App\Models\UserNotification;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\NotificationRepositoryInterface;

class NotificationRepository implements NotificationRepositoryInterface
{
    use PaginateTrait;
    protected $model;

    public function __construct(Notification $notification)
    {
        $this->model = $notification;
    }
    public function getNotificationsForUser($userId = null, $perPage = null)
    {
        $query = $this->model->with(['userNotifications'])
        ->where(function ($query) use ($userId) {
            $query->where('is_general', true);

            if ($userId) {
                $query->orWhereHas('userNotifications', function ($subQuery) use ($userId) {
                    $subQuery->where('user_id', $userId);
                });
            }
        })
            ->latest();

        return $this->paginate($query, $perPage);
    }

    public function markAsRead($userId)
    {
        return UserNotification::where('user_id', $userId)
            ->where('is_read',false)
            ->update(['is_read' => true]);
    }
    public function getUnreadNotifications()
    {
        $userId = Auth::id();
        return UserNotification::where(['is_read'=>false,'user_id'=>$userId])->count();
    }
}
