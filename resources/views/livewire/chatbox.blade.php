


<div class="chatbox">

    @if ($messages)
{{-- start header --}}
    <div class="header_box">

        <div class="profil d-flex align-items-center justify-content-between">

            <div class="imagName d-flex align-items-center">
                <span class="image d-block">
                    <img src="{{$receiver->image}}" alt="logo">
                </span>
                <span class="name">{{$receiver->name}}</span>
            </div>
            <dv class="logo">
                <span class="search"><i class="bi bi-search"></i></span>
                <span class="love"><i class="bi bi-heart"></i></span>
                <span class="bell"><i class="bi bi-bell"></i></span>
            </dv>

        </div>

        <div class="line"></div>

    </div>
{{-- start body massage --}}

    <div class="box_body d-flex flex-column  mt-1" id="messages_contaner">

          @foreach ($messages as $message)

               @if ($message->sender_id == Auth()->user()->id)

                    <div class="message_right mt-3 d-flex align-self-end" >

                        <div class="message" ><p>{{$message->body}}</p>
                        </div>
                        <div class="img_contianer"><span class="image d-block"><img src="{{Auth()->user()->image}}" alt="logo"></span></div>

                    </div>
              @else
                        <div class="message_left mt-3 d-flex">
                            <div class="img_contianer"><span class="image d-block"><img src="{{$this->getUserImsg($message->sender_id )}}" alt="logo"></span></div>

                            <div class="message" ><p>{{$message->body}}</p>
                            </div>

                        </div>



              @endif

         @endforeach








        {{-- ################### --}}


    </div>

    <script>
        //alert('fin') ;
        window.addEventListener('chatSelected', () => {

             let contaner = document.querySelector('#messages_contaner');

             contaner.scrollTop = contaner.scrollHeight;

            window.livewire.emit('scrolllHeight',contaner.scrollHeight);

        });

        window.addEventListener('pushMasseg', () => {

             let contaner = document.querySelector('#messages_contaner');
       //            alert(contaner.scrollHeight);
             contaner.scrollTop = contaner.scrollHeight;

        });

       let contaner = document.querySelector('#messages_contaner');
       contaner.onscroll = function(){
          let top = contaner.scrollTop;
          //alert ($this->heiggrt);

          if(top == 0 && contaner.scrollHeight > 400){

            window.livewire.emit('lodmore');
            //contaner.scrollTop =  400;
          }
       }

        window.addEventListener('lllodscroll', event => {


            let contaner = document.querySelector('#messages_contaner');
            let height = contaner.scrollTop = contaner.scrollHeight - event.detail.name;


            window.livewire.emit('scrolllHeight',contaner.scrollHeight)

          // alert(contaner.scrollHeight - event.detail.name);

        });


    </script>


    @else

      <p  class="emty_message">no conversayion</p>

    @endif

</div>
