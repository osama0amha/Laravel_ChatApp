<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Message;
//use Symfony\Component\Mime\Message;
use Livewire\Component;
use App\Models\Conversation;

class ListChat extends Component
{


    public $convertions;

    protected $listeners =['openMessag','refresh'=>'$refresh'];

    public function openMessag(Conversation $conversation , $useridname){
        // dd('ffffffffffff');
        $user = User::find($useridname);
        $this->emitTo(\App\Http\Livewire\Chatbox::class,'loadConversation',$conversation , $user);
        $this->emitTo(\App\Http\Livewire\ChatSendMessag::class,'tackConversation',$conversation , $user);


    }

    public function returnNameOrImage(Conversation $conversation , $useridname){

         if(Auth()->user()->id == $conversation->sender_id ){
            $uess = User::where('id',$conversation->receiver_id)->first();
         }
         else{
            $uess = User::where('id',$conversation->sender_id)->first();
         }

         return $uess->$useridname;
    }



    public function render()
    {
        //ini_get('max_execution_time');

        $this->convertions = Conversation::where('sender_id',Auth()->user()->id)
        ->orWhere('receiver_id',Auth()->user()->id)->get();

        return view('livewire.list-chat');
    }


}
