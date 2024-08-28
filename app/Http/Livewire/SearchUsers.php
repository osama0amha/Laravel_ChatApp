<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use App\Models\Conversation;

class SearchUsers extends Component
{
    public $search = '';

    protected $listeners =['createConverstion'];


    public function createConverstion($useid){

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
           $conversationss->save();
           $this->emitTo(\App\Http\Livewire\ListChat::class,'refresh');

          // dd('converatin created');

       }else{
           $user = User::find($useid);
           $this->emitTo(\App\Http\Livewire\Chatbox::class,'loadConversation',$conversationss , $user);
            $this->emitTo(\App\Http\Livewire\ChatSendMessag::class,'tackConversation',$conversationss , $user);

       }
   }

   public function isFoundConversation($usear_id)
    {
        $user_conv = Conversation::where('sender_id',Auth()->user()->id)->where('receiver_id',$usear_id)
        ->orWhere('sender_id',$usear_id)
        ->where('receiver_id',Auth()->user()->id)->get();
        return $user_conv;
    }

    public function render()
    {
        return view('livewire.search-users',['users'=> User::where('id','!=',Auth()->user()->id)->where('name','like', '%'.$this->search.'%')->get()]);
    }
}
