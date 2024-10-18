@php
    $style='style=margin-bottom:0;';

@endphp

<div class="modal fade in" id="largeModal" tabindex="-1" role="dialog" style="display: block;    background-color: #0c0b0e;opacity: 0.5;">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-white">
            <div class="modal-header">
                <h5 class="modal-title green-text text-darken-4" id="defaultModalLabel">{{$title}}</h5>
            </div>
            <div class="modal-body bg-white green-text text-darken-4">

                {{$slot}}

            </div>
            <div class="modal-footer">
                <div>
                    <button
                            wire:click="$dispatch('trigger-confirm-fee')"
                            class="btn btn-link btn-small orange darken-3 font-small z-depth-3 btnFeeService"
                            id="btnFeeService"
                    >
                        <span class="material-symbols-outlined">
                            cancel
                        </span>
                    </button>
                    <button type="button" wire:click="$dispatch('trigger-confirm-delete')" class=" btn-custom btn-link btn-small red darken-3  z-depth-3" id="btnDeleteService" >
                        <span class="material-symbols-outlined">
                            delete
                        </span>
                    </button>
                    <button type="button" class="modal-close btn-custom btn-link btn-small green darken-3  z-depth-3" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
</div>

