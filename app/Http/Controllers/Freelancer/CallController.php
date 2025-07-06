<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Call;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use TaylanUnutmaz\AgoraTokenBuilder\RtcTokenBuilder;

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
        // dd(date("Y-m-d H:i:s" ,now()->timestamp ) , $privilegeExpireTs);

        return RtcTokenBuilder::buildTokenWithUid(
            $appId,
            $appCertificate,
            $channelName,
            $uid,
            $roleValue,
            $privilegeExpireTs
        );
    }

    public function startCall($receiverId)
    {
        $receiver = User::findOrFail($receiverId);
        $channelName = 'Call_' . Str::slug(auth()->user()->username, '_');

        $call = Call::create([
            'caller_id' => auth()->id(),
            'receiver_id' => $receiverId,
            'channel_name' => $channelName,
        ]);

        $token = $this->generateAgoraToken($channelName, auth()->user()->id);

        return view('pages-freelancer.call.caller', [
            'call' => $call,
            'receiver' => $receiver,
            'channelName' => $channelName,
            'token' => $token,
            'appId' => config('agora.app_id'),
            'uid' => auth()->user()->id,
        ]);
    }

    public function answerCall($callId)
    {
        $call = Call::findOrFail($callId);
        $call->update(['started_at' => now()]);

        $channelName = $call->channel_name;
        $token = $this->generateAgoraToken($channelName, auth()->user()->id);

        // dd($call ,$token ,$channelName);
        return view('pages-freelancer.call.receiver', [
            'call' => $call,
            'token' => $token,
            'channelName' => $channelName,
            'appId' => config('agora.app_id'),
            'uid' => auth()->user()->id,
        ]);
    }

    public function endCall($callId)
    {
        $call = Call::findOrFail($callId);
        $call->update(['ended_at' => now()]);

        return redirect()->route('freelancer.home.index')->with('success', 'Call ended.');
    }
}
