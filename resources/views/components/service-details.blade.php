@php
    $style='style=margin-bottom:0;';

@endphp
<div>
        <div id="modal-default" class="modal-default  "
                x-show="open"
        >
            <div class="modal-dialog"
                 x-show="open"
                 x-transition:enter="animate__animated animate__jackInTheBox"
                 x-transition:leave="animate__animated animate__hinge"
            >
                <div class="modal-content modal-col-white">
                    <div class="modal-header">
                        <h5 class="modal-title green-text text-darken-4" id="defaultModalLabel">{{$title??''}}</h5>
                    </div>
                    <div class="modal-body bg-white green-text text-darken-4">

                        {{$slot}}

                    </div>
                    <div class="modal-footer">
                        <div>
                            <button
                                    wire:click="$dispatch('trigger-confirm-fee')"
                                    @click="open = false"
                                    class="btn btn-link btn-small orange darken-3 font-small z-depth-3 btnFeeService"
                                    id="btnFeeService"
                            >
                                <span class="material-symbols-outlined">
                                    cancel
                                </span>
                            </button>
                        </div>
                        <div>
                            <button type="button"
                                    wire:click="$dispatch('trigger-confirm-delete')"
                                    @click="open = false"
                                    class=" btn-custom btn-link btn-small red darken-3  z-depth-3"
                                    id="btnDeleteService"
                            >
                                <span class="material-symbols-outlined">
                                    delete
                                </span>
                            </button>
                        </div>
                        <div>
                            <button type="button"  @click="open = false" class=" btn-custom btn-link btn-small green darken-3  z-depth-3" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>