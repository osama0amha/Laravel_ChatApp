<div >

    <div class="chat_list_header">
        {{-- profial --}}
        <div class="profil d-flex">

            <span class="d-block profilFoto">
                  <img src="{{Auth()->user()->image}}" alt="logo">
            </span>
            <div  class="name d-flex justify-content-center">
            <p>{{Auth()->user()->name}}</p>
            <span class="text">Sinor Devlebor</span>
            </div>

            <a href="{{route('profile.edit')}}"  class="pencle"><i class="bi bi-pencil"></i></a>

        </div>

         {{-- search in users --}}
         <livewire:search-users/>
    </div>

    {{-- conversations --}}

    <div class="convrsations">

         <ul>
            @foreach ($convertions as $conversation)

            <li class="d-flex" wire:key='{{$conversation->id}}' wire:click="$emit('openMessag', {{$conversation}}, {{$this->returnNameOrImage($conversation,$useridname = 'id')}})">
                <span class="d-block profilFoto">
                      <img src="{{$this->returnNameOrImage($conversation,$useridname = 'image')}}" alt="logo">
                </span>

                <div  class="name ">
                   <p>{{$this->returnNameOrImage($conversation,$useridname = 'name')}}</p>

                  <span class="text d-block">{{$conversation->messages->last()->body}}</span>
                  </div>

                  <span class="dateConversation">{{$conversation->messages->last()?->created_at->shortAbsoluteDiffForHumans()}} AM</span>

                  @if ( count($conversation->messages->where('read',0)->where('receiver_id',Auth()->user()->id)))
                    <span class="countConversation d-block text-center">{{ count($conversation->messages->where('read',0)->where('receiver_id',Auth()->user()->id))}}</span>
                  @endif

            </li>

            @endforeach

          </ul>


    </div>

</div>
