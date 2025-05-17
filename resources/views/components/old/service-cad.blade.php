@props(['cadOpen' => false ,  'name' => 'serviceCad', 'customers', 'employees' ])
@php use  App\Helpers\Funcs; @endphp
<div id="new-service" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
     x-on:open-modal.window="$event.detail == '{{ $name }}' ? cadOpen = true : null"
     x-on:close-modal.window="$event.detail == '{{ $name }}' ? cadOpen = false : null"
     x-on:close.stop="cadOpen = false"
     x-on:keydown.escape.window="cadOpen = false"
     x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
     x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
     style="display: {{ $cadOpen ? 'block' : 'none' }};"
     x-show="cadOpen"
     x-transition:enter="animate__animated animate__slideInUp animate__faster"
     x-transition:leave="animate__animated animate__slideOutDown animate__faster"

>
    <div
            x-show="cadOpen"
            class="fixed inset-0 transform transition-all"
            x-on:click="cadOpen = false"
            {{--            x-transition:enter="ease-out duration-300"--}}
            x-transition:enter="animate__animated animate__fadeInUpBig "
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            {{--            x-transition:leave="ease-in duration-200"--}}
            x-transition:leave="animate__animated animate__fadeOutDownBig "
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
    >
        <div class="fixed inset-0 bg-green-700 dark:bg-gray-900 opacity-75"></div>
    </div>

    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
        <div class="modal-header">
            <h6>Create a new service.</h6>
        </div>
        <div class="container z-depth-3">

            <div class="hide info-box-3 bg-red hover-zoom-effect animate__animated animate__shakeX" id="error_infobox">
                <div class="icon">
                    <i class="material-icons pulse">report</i>
                </div>
                <div class="content">
                    <div class="text ">ERROR</div>
                    <div id="error-text" class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>

            <div class="row label-employee-view-edit" >
                <span class="label label-padding">People involved in the service</span>
            </div>
            <form id="service-form"  method="post" wire:submit.prevent="store">
                @csrf
                <input type="hidden" wire:model="form.who_saved"  value="{{Funcs::replaceSpaces(Auth::user()->name)}}">
                <input type="hidden" wire:model="form.who_saved_id"  value="{{Auth::user()->id}}">

                <div class="row">
                    <div class=" col s12 m4">
                        <div class="form-group">
                            <div class="form-line success" >
                                <div  wire:loading class="absolute top-2 left-1/2 mt-4 ml-14  bg-white w-2/6 h-8"><div class="button--loading "></div></div>
                                <select

                                        wire:model.live="form.customer_id"
                                        wire:change="price_inject()"
                                        class="materialize-select browser-default"
                                        id="select-cad-service-customer"
                                >
                                    <option>Customer</option>
                                    @foreach($customers as  $value)
                                        <option  value="{{$value->id}}">{{$value->name}} </option>
                                    @endforeach

                                </select>

                                <label class="form-label"  for="select-cad-service-customer">Customer</label>

                            </div>
                            @error('form.customer_id')
                            <div class="help-info text-red-700" id="help-info-title">{{ $message }}</div>
                            @enderror
                            <div class="@error('form.customer_id') hidden @enderror help-info">select the customer for service.</div>
                        </div>
                    </div>
                    <div class=" col s12 m4">
                        <div class="form-group">
                            <div class="form-line success">
                                <div  wire:loading class="absolute top-2 left-1/2 mt-4 ml-14  bg-white w-2/6 h-8 right"><div class=" button--loading absolute top-0"></div></div>
                                <select
                                        wire:model.live="form.employee1_id"
                                        id="select-cad-service-employee1"
                                        class="materialize-select browser-default"
                                >

                                    <option  value="none">Employee</option>

                                    @foreach($employees as $values)
                                        <option  value="{{$values->id}}">{{$values->name}} </option>
                                    @endforeach
                                </select>
                                <label class="form-label"  for="select-cad-service-employee1">Employee</label>

                            </div>
                            @error('form.employee1_id')
                            <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                            @enderror

                            <div class=" @error('form.employee1_id') hide @enderror help-info">select the employee for service.</div>
                        </div>
                    </div>
                    <div class=" col s12 m4">
                        <div class="form-group">
                            <div class="form-line success">
                                <select
                                        wire:model="form.employee2_id"
                                        class="materialize-select browser-default"
                                        id="select-cad-service-employee2"
                                >
                                    <option selected value="0">Second employee</option>
                                    @foreach($employees as $values)
                                        @if(old('form.employee2_id') == $values->id)
                                            <option selected  value="{{$values->id}}">{{$values->name}} </option>
                                        @elseif($values->id === $empFromOpen)
                                            <option selected  value="{{$values->id}}">{{$values->name}} </option>
                                        @else
                                            <option  value="{{$values->id}}">{{$values->name}} </option>
                                        @endif
                                    @endforeach
                                </select>
                                <label class="form-label"  for="select-cad-service-employee1">Second employee.</label>
                            </div>
                            <div class="help-info">Select the second employee.</div>
                        </div>
                    </div>
                </div>
                <!-- Divider ######################################################################################################-->
                <div class="row label-employee-view-edit" >
                    <span class="label label-padding">Service repeat. </span>
                </div>
                <!-- Divider ######################################################################################################-->

                <!-- Row ######################################################################################################-->
                <div class="row">
                    <div class=" col s12 m6">
                        <label class="form-label"  for="cad-schedule-loop">Service frequency.</label>
                        <div class="form-group p-t-10 p-b-10 form-line-loop" id="cad-schedule-loop">
                            <div class="form-line success form-line-period">
                                <select
                                        wire:model="form.repeat_frequency"
                                        id="select-cad-service-form.repeat_frequency"
                                        class="materialize-select browser-default"
                                >
                                    <option value="ONE">Select one option</option>
                                    <option  value="ONE">Eventual</option>
                                    <option  value="WEK">Weekly</option>
                                    <option  value="BIW">Biweekly</option>
                                    <option  value="THR">Three-weekly</option>
                                    <option  value="MON">Monthly</option>
                                </select>
                                {{--                                    <label class="form-label"  for="select-cad-service-period">frequency of repetition.</label>--}}
                            </div>

                            @error('form.repeat_frequency')
                            <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                            @enderror

                            <div class="@error('form.repeat_frequency') hide @enderror help-info" id="help-info-loop">Select the service execution frequency</div>
                        </div>
                    </div>
                    <div class=" col s12 m6">
                        <label class="form-label"  for="cad-schedule-loop">month(s) to repeat</label>
                        <div class="form-group p-t-10 p-b-10 form-line-loop" id="cad-schedule-loop">
                            <div class="form-line success form-line-period">
                                <select
                                        wire:model="form.repeat_months"
                                        class="materialize-select browser-default"
                                        id="cad-schedule-team"
                                >
                                    @php
                                        $string_0= "";
                                        $string_1= "";
                                        $string_2 = "";
                                        $string_3 = "";
                                        $string_6 = "";
                                        $string_12 = "";
                                        if(!empty(old("form.repeat_months"))){
                                            switch (old("form.repeat_months")){
                                                case'1': $string_1 = "selected" ;break;
                                                case'2': $string_2 = "selected" ;break;
                                                case'3': $string_3 = "selected" ;break;
                                                case'6': $string_6 = "selected" ;break;
                                                case'12': $string_12 = "selected" ;break;
                                            }
                                        }else{
                                            $string_none = "selected";
                                        }

                                    @endphp
                                    <option  {{ $string_none }} value="0">select month(s) to repeat</option>
                                    <option  {{ $string_1 }} value="0">no repeat</option>
                                    <option  {{ $string_1 }} value="1">1 month</option>
                                    <option  {{ $string_2 }} value="2">2 months</option>
                                    <option  {{ $string_3 }} value="3">3 months</option>
                                    <option  {{ $string_6 }} value="6">6 months</option>
                                    <option  {{ $string_12 }} value="12">12 months</option>
                                </select>
                                {{--                                    <label class="form-label"  for="select-cad-service-period">month(s) to repeat</label>--}}
                            </div>

                            @error('form.repeat_months')
                            <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                            @enderror

                            <div class="@error('form.repeat_months') hide @enderror help-info" id="help-info-loop">Select month(s) to repeat Service Schedule.</div>
                        </div>
                    </div>
                </div>
                <div class="row label-employee-view-edit grey" >
                    <span class="label   label-padding">Service information</span>
                </div>
                <div class="row">
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success">
                                {{--                                <input class="form-control datepicker"  id="input-cad-service-date" name="service_date" value="{{ old('service_date') }}" />--}}
                                <x-date-flat-pickr
                                        wire:model="form.service_date"
                                        id="input-cad-service-date"
                                        value="{{ old('form.service_date') }}"
                                />
                                <label class="form-label"  for="input-cad-service-date">Service Date</label>
                            </div>
                            @error('form.service_date')
                            <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                            @enderror
                            <div class=" @error('form.service_date') hide @enderror help-info">Select the service execution date.</div>
                        </div>
                    </div>
                    <div class=" col s12 m6">
                        <div class="form-group">
                            <div class="form-line success" id="select-cad-service-billings-container">
                                <select
                                        wire:model="form.frequency_payment"
                                        id="select-cad-service-billings"
                                        class="materialize-select browser-default"
                                        value
                                >
                                    @if($populateBillings??array())
                                        @foreach($populateBillings as $billing)
                                            <option value="{{$billing->id}},{{$billing->value}}">{{$billing->label}} / {{ $billing->value }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <label class="form-label"  for="select-cad-service-billings">type of billing.</label>
                            </div>
                            @error('form.frequency_payment')
                            <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                            @enderror
                            <div class="@error('form.frequency_payment') hide @enderror help-info">Select type of billing.</div>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class=" col s12 m6">
                        <label for="textarea-cad-service-note">type service notes.</label>
                        <div class="form-group">
                            <div class="form-line success">
                                        <textarea
                                                wire:model="form.notes"
                                                id="textarea-cad-service-note"
                                                class="form-control custom-textarea"
                                                rows="4"
                                                placeholder="Please type service notes here..."
                                                style="padding: 10px;"
                                        >{{ old('notes') }}</textarea>
                            </div>
                            <div class="help-info">Type customer notes </div>
                        </div>
                    </div>
                    <div class=" col s12 m6">
                        <label for="textarea-cad-costumer-instructions">Instructions for employees.</label>
                        <div class="form-group">
                            <div class="form-line success">
                                        <textarea
                                                wire:model="form.instructions"
                                                id="textarea-cad-costumer-instructions"
                                                class="form-control custom-textarea"
                                                rows="4"
                                                placeholder="Please type instructions for employees here..."
                                                style="padding: 10px;"
                                        >{{ old('instructions') }}</textarea>
                            </div>
                            <div class="help-info">Type instructions for employees. </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-link font-12 btn-small " type="submit">save changes</button>
                    <a href="#" @click="cadOpen = false" class="btn btn-link btn-small font-12 red darken-4">Cancel</a>
                </div>
            </form>
        </div><!--END OF CONTAINER -->
    </div><!--END OF MODAL CONTENT -->
</div>

