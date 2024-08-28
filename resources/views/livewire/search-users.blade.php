

<div>

    <div class="serche">
        {{-- <input type="text" wire:model ="search" placeholder="Search Here..."> --}}
        <input class="form-control me-2"  wire:model ="search" type="search" placeholder="Search Here..." aria-label="Search">
        <span class="iconserch"><i class="bi bi-search"></i></span>
        <div class="pord"></div>
    </div>


    <div class="convrsationsSearch">

       @if (strlen($this->search)>0)

               <ul>
                   @foreach ($users as $user )

                      <li class="d-flex justify-content-between align-items-center" wire:key='{{$user->id}}' wire:click="$emit('createConverstion', {{$user->id}})">
                        <div class="userNamAndImg  d-flex">
                            <span class="d-block profilFoto">
                                <img src="{{$user->image}}" alt="logo">
                           </span>

                           <div  class="name "><p>{{$user->name}}</p></div>
                        </div>

                        <span class="add"  wire:poll>
                            @if (count($this->isFoundConversation($user->id))== 0)
                               <i class="bi bi-person-plus-fill"></i>

                            @else
                               <i class="bi bi-person-check-fill"></i>
                            @endif

                        </span>


                      </li>
                   @endforeach
               </ul>
       @endif
       <div class="pord"></div>

    </div>

</div>
