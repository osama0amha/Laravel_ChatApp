<?php

namespace App\Events;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class MessageSand implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    public $conversation;
    public $receiver;


    public function __construct($user,$message,$conversation, $receiver)
    {
        $this->user= $user;
        $this->message= $message;
        $this->conversation= $conversation;
        $this->receiver= $receiver;
    }

    public function broadcastWith( )
    {

        return [
             'user_id'=>$this->user,
             'message'=>$this->message,
             'conversation_id'=>$this->conversation,
             'receiver_id'=>$this->receiver,
        ];
        # code...
    }


    public function broadcastOn()
    {
        // error_log($this->message);
        //error_log($this->receiver);
        return new PrivateChannel('chat.' .$this->receiver);
    }
}
