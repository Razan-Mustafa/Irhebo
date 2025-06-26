<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        $notification = Notification::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        // dd($notification);
        return view('pages-freelancer.notification.index', compact('notification'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => 1]);

        return response()->json(['status' => 'success']);
    }
}
