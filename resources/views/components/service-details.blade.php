@props(['showModal' => false, 'title' => 'Service Details'])
@php


    $style='style=margin-bottom:0;';
    $name='Service_Details';
@endphp
<div>

        <div id="modal-default" class="modal-default"
                x-show="open"
        >


            <div class="modal-dialog"
                 x-on:open-modal.window="$event.detail == '{{ $name }}' ? open = true : null"
                 x-on:close-modal.window="$event.detail == '{{ $name }}' ? open = false : null"
                 x-on:close.stop="open = false"
                 x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
                 x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
                 style="display: {{ $showModal ? 'block' : 'none' }};"

                 x-show="open"
                 x-on:keydown.escape.window="open = false"
                 x-transition:enter="animate__animated animate__fadeInUpBig animate__faster"
                 x-transition:leave="animate__animated animate__fadeOutDownBig animate__faster"
            >

{{--                <div--}}
{{--                        x-show="open"--}}
{{--                        class="absolute inset-0 z-0 transform transition-all"--}}
{{--                        x-on:click="open = false"--}}
{{--                        --}}{{--            x-transition:enter="ease-out duration-300"--}}
{{--                        x-transition:enter="animate__animated animate__fadeInUpBig "--}}
{{--                        x-transition:enter-start="opacity-0"--}}
{{--                        x-transition:enter-end="opacity-100"--}}
{{--                        --}}{{--            x-transition:leave="ease-in duration-200"--}}
{{--                        x-transition:leave="animate__animated animate__fadeOutDownBig "--}}
{{--                        x-transition:leave-start="opacity-100"--}}
{{--                        x-transition:leave-end="opacity-0"--}}
{{--                        style="z-index: 9990;"--}}
{{--                >--}}
{{--                    <div class="absolute inset-0  bg-green-700 dark:bg-gray-900 opacity-10" style="z-index: 9990;"></div>--}}
{{--                </div>--}}

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
                                    class=" btn btn-link btn-small red darken-3  z-depth-3"
                                    id="btnDeleteService"
                            >
                                <span class="material-symbols-outlined">
                                    delete
                                </span>
                            </button>
                        </div>
                        <div>
                            <button type="button"  @click="open = false" class=" btn btn-link btn-small green darken-3  z-depth-3 " >CLOSE</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

</div>