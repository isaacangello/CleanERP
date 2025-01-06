<div>
    <div id="modal-default" class="modal-default"
         x-show="open"
    >
        <div class="modal-dialog"
             x-show="open"
             x-transition:enter="animate__animated animate__fadeInUpBig animate__faster"
             x-transition:leave="animate__animated animate__fadeOutDownBig animate__faster"
             x-on:keydown.escape.window="open = false"
        >
            <div class="modal-content modal-col-white">
                <div class="modal-header">
                    <h5 class="modal-title green-text text-darken-4" id="defaultModalLabel">{{$title??''}}</h5>
                </div>
                <div class="modal-body bg-white green-text text-darken-4">

                    {{$slot}}

                </div>
                <div class="modal-footer">
                    {{$footer??''}}
                </div>
            </div>
        </div>
    </div>

</div>