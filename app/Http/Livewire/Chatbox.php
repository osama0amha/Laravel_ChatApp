<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use App\Models\Conversation;

class Chatbox extends Component
{
   public $messages;
   public $count_messages;
   public $receiver;
   public $count = 10;
   public $convermessag;
   public $heiggrt= 39;


   public function  getListeners()
   {

       $auth_id = Auth()->user()->id;
       return [
           "echo-private:chat.{$auth_id},MessageSand" => 'broadcastedMessageReceived',
           'loadConversation','pushmessage','lodmore' ,'scrolllHeight','broadcastMessageRead','resetComponent','broadcastedMessageReceived'
       ];
   }


   public function loadConversation(Conversation $conversation, User $user){

      //   dd($conversation, $user);
          $this->convermessag = $conversation;
          $this->count_messages = Message::where('conversation_id', $this->convermessag->id)->count();

          $this->messages = Message::where('conversation_id', $this->convermessag->id)
                          ->skip( $this->count_messages - $this->count)
                          ->take(10)->get();

          $this->receiver = $user;


          $this->dispatchBrowserEvent('chatSelected');

          Message::where('conversation_id', $this->convermessag->id)
                  ->where('receiver_id',Auth()->user()->id)
                  ->where('receiver_id',Auth()->user()->id)->update(['read'=> 1]);
   }

   function broadcastedMessageReceived($event)
   {

      $this->emitTo(\App\Http\Livewire\ListChat::class,'refresh');

       # code...

      $broadcastedMessage = Message::find($event['message']);

       if ($this->convermessag ) {

           #check if Auth/current selected conversation is same as broadcasted selecetedConversationgfg
           if ((int) $this->convermessag ->id  === (int)$event['conversation_id']) {
               # if true  mark message as read
               $broadcastedMessage->read = 1;
               $broadcastedMessage->save();
               $this->pushmessage($broadcastedMessage->id);

           }
       }
   }

   public function pushmessage($userId){

    $newMessage = Message::find($userId);

    $this->messages->push($newMessage );
    $this->emitTo(\App\Http\Livewire\ListChat::class,'refresh');

    $this->dispatchBrowserEvent('pushMasseg');
   }



   public function lodmore(){

    $this->count += 10;

    $this->count_messages = Message::where('conversation_id', $this->convermessag->id)->count();

    $this->messages = Message::where('conversation_id', $this->convermessag->id)
                    ->skip( $this->count_messages - $this->count)
                    ->take($this->count)->get();

    $height = $this->heiggrt;
     $this->dispatchBrowserEvent('lllodscroll',['name'=>$height ]);

   }

   public function getUserImsg($receiver_id){

      $user = User::find($receiver_id);

      return $user->image;

   }

   public function scrolllHeight($containerHeight){

    $this->heiggrt =  $containerHeight;

}



    public function render()
    {
        return view('livewire.chatbox');
    }
}
