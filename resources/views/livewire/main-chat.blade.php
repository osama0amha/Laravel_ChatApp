<x-app-layout>
 <div class="d-flex   justify-content-center"  >
    <div class="chat_container mt-3 container d-flex">
        <div class="chat_list">
            <livewire:list-chat />
        </div>


        <div class="chat_box">


                <livewire:chatbox />


                <livewire:chat-send-messag/>

         {{-- <form method="POST" action="{{ route('logout') }}">
                @csrf
           <a href="{{route('logout')}}"
           onclick="event.preventDefault();
                       this.closest('form').submit();">
                    logout
           </a>

         </form> --}}
        </div>
    </div>
 </div>

</x-app-layout>

