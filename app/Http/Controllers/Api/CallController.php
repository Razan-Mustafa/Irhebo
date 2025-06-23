<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CallResource;
use App\Models\Call;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Notification;
use App\Models\PlayerId;
use App\Models\User;
use App\Services\OneSignalService;
use Illuminate\Http\Request;
use TaylanUnutmaz\AgoraTokenBuilder\RtcTokenBuilder;
use Illuminate\Support\Str;

class CallController extends Controller
{
    private const ROLE_PUBLISHER = 1;
    private const ROLE_SUBSCRIBER = 2;
    private function generateAgoraToken($channelName, $uid, $role = 'publisher', $expireTimeInSeconds = 3600)
    {
        $appId = config('agora.app_id');
        $appCertificate = config('agora.app_certificate');

        if (!$appId || !$appCertificate) {
            throw new \Exception("Agora App ID and Certificate must be set in the configuration.");
        }

        $roleValue = $role === 'publisher'
            ? self::ROLE_PUBLISHER
            : self::ROLE_SUBSCRIBER;

        $currentTimestamp = now()->timestamp;
        $privilegeExpireTs = $currentTimestamp + $expireTimeInSeconds;

        return RtcTokenBuilder::buildTokenWithUid(
            $appId,
            $appCertificate,
            $channelName,
            $uid,
            $roleValue,
            $privilegeExpireTs
        );
    }






    public function startCall(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
        ]);

        $channelName = 'Call_' . Str::slug(auth()->user()->username, '_');
        $token = $this->generateAgoraToken($channelName, $request->receiver_id);

        $call = Call::create([
            'caller_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'channel_name' => $channelName,
        ]);
        $data = [
            'token' => $token,
            'call'  => new CallResource($call),
        ];

        $user = User::where('id', $request->receiver_id)->first();
        if ($user) {
            $playerIdRecord = PlayerId::where('user_id', $user->id)
                ->where('is_notifiable', 1)
                ->pluck('player_id')->toArray();


            if ($playerIdRecord) {
                $titles = [
                    'en' => __('messages.call_start_title', [], 'en'),
                    'ar' => __('messages.call_start_title', [], 'ar'),
                ];

                $messages = [
                    'en' => __('messages.call_start_message', ['caller_name' => auth()->user()->username], 'en'),
                    'ar' => __('messages.call_start_message', ['caller_name' => auth()->user()->username], 'ar'),
                ];

                $response = app(OneSignalService::class)->sendNotificationToUser(
                    $playerIdRecord,
                    $titles,
                    $messages
                );

                Notification::create([
                    'user_id'           => $user->id,
                    'title'             => json_encode($titles),
                    'body'              => json_encode($messages),
                    'type'              => 'call',
                    'type_id'           => $request->call_id,
                    'is_read'           => false,
                    'onesignal_id'      => $response['id'] ?? null,
                    'response_onesignal' => json_encode($response),
                ]);
            }
        }
        // *********************************************//



        return $this->successResponse(__('call_started'), $data);
    }

    public function answerCall(Request $request)
    {
        $request->validate([
            'call_id' => 'required|exists:calls,id',
        ]);

        $call = Call::findOrFail($request->call_id);

        $call->update([
            'started_at' => now(),
        ]);

        return $this->successResponse(
            __('Call accepted'),
            $call
        );
    }

    public function endCall(Request $request)
    {

        $request->validate([
            'call_id' => 'required|exists:calls,id',
        ]);

        $call = Call::findOrFail($request->call_id);

        $call->update([
            'ended_at' => now(),
        ]);

        $durationInSeconds = $call->started_at->diffInSeconds($call->ended_at);

        $minutes = floor($durationInSeconds / 60);
        $seconds = $durationInSeconds % 60;
        $duration = $minutes . ' min ' . $seconds . ' sec';


        $authId = auth()->id();
        $receiverId = $call->receiver_id;

        $chat = Chat::where(function ($query) use ($authId, $receiverId) {
            $query->where('user_id_one', $authId)
                ->where('user_id_two', $receiverId);
        })->orWhere(function ($query) use ($authId, $receiverId) {
            $query->where('user_id_one', $receiverId)
                ->where('user_id_two', $authId);
        })->first();


        if (!$chat) {
            return $this->errorResponse('No chat found between users.', 404);
        }

        $chatId = $chat->id;


        $message = ChatMessage::create([
            'chat_id'        => $chatId,
            'sender_id'      => auth()->id(),
            'message'        => $duration,
            'attachment_url' => null,
            'attachment_type' => 'call',
            'is_read' => true,
        ]);


        return $this->successResponse(
            __('Call ended'),
            ['call' => $call, 'message' => $message]
        );
    }
}
