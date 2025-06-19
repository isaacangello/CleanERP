
    <div id="gifLoading"
         class="w-full h-screen  justify-center items-center hidden"
         style="
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: transparent;
         "
         wire:loading.class="hidden"
    >
        <img  class="w-48" src="{{asset('./img/loading.gif')}}" alt="loading" style="width: 12rem;">
    </div>

