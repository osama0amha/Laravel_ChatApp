

<div class="box_seand d-flex ">

    <form class="d-flex justify-content-between align-items-center"  enctype="multipart/form-data" wire:submit.prevent="submit">

        <div class="form_input d-flex align-items-center">

              <input class="text_input" type="text" value="{{$title}}" placeholder="Write Something..." wire:model="title">
              <spam class="mic"><i class="bi bi-mic"></i></spam>

              <div class="icons d-flex align-items-center">

                  <label for="img"><i class="bi bi-camera"></i></label>
                  <input type="file" class="d-none" wire:model="photo" id="img">

                  <label for="pdf"><i class="bi bi-filetype-pdf"></i></label>
                  <input type="file" class="d-none" wire:model="pdf" id="pdf">

                  <label ><i class="bi bi-emoji-smile"></i></label>
              </div>
        </div>


        {{-- <input type="text" wire:model="email"> --}}

         <span class="button d-flex"><button type="submit"><i class="bi bi-symmetry-horizontal"></i></button></span>

    </form>
</div>
