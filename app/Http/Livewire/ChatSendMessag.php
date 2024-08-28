<?php

namespace App\Http\Livewire;
use App\Models\User;

use App\Models\Message;
use Livewire\Component;
use App\Models\Conversation;
use Livewire\WithFileUploads;
use App\Events\MessageSand;

class ChatSendMessag extends Component
{

    use WithFileUploads;

    public $title = '';
    public $photo;
    public $pdf;
    public $xconvertion;
    public $xuser;
    public $mesage;

    protected $listeners =['tackConversation','dispatchMessageSent'];


    public function tackConversation(Conversation $conversation, User $user){

          $this->xconvertion = $conversation;
          $this->xuser = $user;

        //   dd($this->xconvertion,$this->xuser);
    }


    public function submit(){

      //  dd($this->photo);
        if($this->xuser == null)return null;

       $this->mesage = Message::create([
             'sender_id'=> Auth()->user()->id,
             'receiver_id' => $this->xuser->id,
             'conversation_id' => $this->xconvertion->id,
             'body' => $this->title,
             'read' => 0
       ]);
       $this->title = '';

       $this->xconvertion->last_time_message =  $this->mesage->created_at;
       $this->xconvertion->save();

       $this->emitTo(\App\Http\Livewire\Chatbox::class,'pushmessage', $this->mesage->id);


      $this->emitSelf('dispatchMessageSent');
        // broadcast(new MessageSand(Auth()->user()->id,  $this->mesage->id,  $this->xconvertion->id, $this->xuser->id ));

    }

    public function dispatchMessageSent()
    {
        broadcast(new MessageSand(Auth()->user()->id,  $this->mesage->id,  $this->xconvertion->id, $this->xuser->id ));
        # code...
    }

    public function render()
    {
        return view('livewire.chat-send-messag');
    }
}
