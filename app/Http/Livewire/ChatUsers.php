<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use App\Models\Conversation;

class ChatUsers extends Component
{

    public $search = '';
    protected $listeners =['createConverstion'];

    public function createConverstion($useid){
        dd('jjjjjj');
       // ini_set('max_execution_time', 180);

         $conversationss = Conversation::where('sender_id',Auth()->user()->id)->where('receiver_id',$useid)
                     ->orWhere('sender_id',$useid)
                     ->where('receiver_id',Auth()->user()->id)->get();

        if(count($conversationss) == 0){

            $conversationss = Conversation::create([
                'sender_id'=> Auth()->user()->id,
                'receiver_id'=> $useid,
                'last_time_message'=> '2024-02-20',
            ]);

            $message = Message::create([
                'conversation_id'=> $conversationss->id,
                'sender_id'=> Auth()->user()->id,
                'receiver_id'=> $useid,
                'body' => 'hello',
            ]);

            $conversationss->last_time_message = $message->created_at;

        }else{
       // $this->emitTo(\App\Http\Livewire\ListChat::class,'refresh');

        }
    }



    public function render()
    {
        return view('livewire.chat-users',['users'=> User::where('id','!=',Auth()->user()->id)->where('name','like', '%'.$this->search.'%')->get()]);
    }
}
