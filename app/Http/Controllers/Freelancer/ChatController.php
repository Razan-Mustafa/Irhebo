<?php

namespace App\Http\Controllers\Freelancer;

use App\Events\PusherNewMessage;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{


    public function index()
    {
        $userId = auth()->id();
        $users = User::all();
        $chats = Chat::where('user_id_one', $userId)
            ->orWhere('user_id_two', $userId)
            ->with(['userOne:id,name', 'userTwo:id,name'])
            ->get();

        return view('pages-freelancer.chat.index', compact('chats','users'));
    }



    public function showChat($chatId)
    {
        return view('pages-freelancer.chat.showChat', compact('chatId'));
    }

    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        broadcast(new PusherNewMessage($message))->toOthers();

        // \Log::info('Message broadcasted:', ['message' => $message]);

        return response()->json(['status' => 'Message Sent!']);
    }
}
