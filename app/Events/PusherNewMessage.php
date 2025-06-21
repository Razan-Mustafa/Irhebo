<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PusherNewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }


    public function broadcastOn()
    {
        // \Log::info('Broadcasting on channel: chat.' . $th/is->message->chat_id);
        return new PrivateChannel('chat.' . $this->message->chat_id);
    }

    public function broadcastAs()
    {
        return 'message.sent';
    }

    // public function broadcastOn()
    // {
    //     // \Log::info('Broadcasting on channel: chat.' . $th/is->message->chat_id);
    //     return new Channel('test-channel');
    // }

    // public function broadcastAs()
    // {
    //     return 'test.event';
    // }

}
