
   <div class="users ">
    <ul>
        @foreach ($users as $user )

           <li class="d-flex" wire:key='{{$user->id}}' wire:click="$emit('createConverstion', {{$user->id}})">

             <span class="d-block profilFoto">
                   <img src="{{$user->image}}" alt="logo">
             </span>

             <div  class="name "><p>{{$user->name}}</p></div>

           </li>
        @endforeach
 </ul>
   </div>

