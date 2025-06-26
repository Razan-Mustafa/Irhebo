<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Freelancer;
use App\Models\Notification;
use App\Models\PlayerId;
use App\Models\User;
use App\Services\OneSignalService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function create()
    {
        return view('pages.notifications.create');
    }

    public function send(Request $request)
    {
        $request->validate([
            'audience'   => 'required|in:all,freelancer,client',
            'platform'   => 'required|in:all,ios,android',
            'title_en'   => 'required|string',
            'title_ar'   => 'required|string',
            'body_en'    => 'required|string',
            'body_ar'    => 'required|string',
        ]);

        // Get users according to audience
        $usersQuery = User::query();

        if ($request->audience == 'freelancer') {
            $freelancerIds = Freelancer::pluck('user_id')->toArray();
            $usersQuery->whereIn('id', $freelancerIds);
        } elseif ($request->audience == 'client') {
            $freelancerIds = Freelancer::pluck('user_id')->toArray();
            $usersQuery->whereNotIn('id', $freelancerIds);
        }

        $users = $usersQuery->pluck('id')->toArray();

        if (empty($users)) {
            return redirect()->back()->with('error', 'No users found for this audience.');
        }

        // Get player ids according to platform
        $playerIdsQuery = PlayerId::whereIn('user_id', $users)
            ->where('is_notifiable', 1);

        if ($request->platform != 'all') {
            $playerIdsQuery->where('platform', $request->platform);
        }

        $playerIds = $playerIdsQuery->pluck('player_id')->toArray();

        if (empty($playerIds)) {
            return redirect()->back()->with('error', 'No devices found for this audience and platform.');
        }

        // Prepare titles & messages
        $titles = [
            'en' => $request->title_en,
            'ar' => $request->title_ar,
        ];

        $messages = [
            'en' => $request->body_en,
            'ar' => $request->body_ar,
        ];

        // Send notification via OneSignal
        $response = app(OneSignalService::class)->sendNotificationToUser(
            $playerIds,
            $titles,
            $messages,
            'admin',
            null
        );

        // Save notification to each user
        foreach ($users as $userId) {
            Notification::create([
                'user_id'            => $userId,
                'title'              => json_encode($titles),
                'body'               => json_encode($messages),
                'type'               => 'admin',
                'type_id'            => null,
                'is_read'            => false,
                'onesignal_id'       => $response['id'] ?? null,
                'response_onesignal' => json_encode($response),
            ]);
        }

        return redirect()->back()->with('success', 'Notification sent successfully.');
    }

    //
}
