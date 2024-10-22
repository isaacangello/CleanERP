
        @php use  App\Helpers\Funcs; @endphp
       <div id="new-service" class="modal-default bottom-sheet"
            x-show="cadOpen"
            x-transition:enter="animate__animated animate__slideInUp animate__faster"
{{--            x-transition:enter-start="opacity-0 scale-90"--}}
{{--            x-transition:enter-end="opacity-100 scale-100"--}}
            x-transition:leave="animate__animated animate__slideOutDown animate__faster"
{{--            x-transition:leave-start="opacity-100 scale-100"--}}
{{--            x-transition:leave-end="opacity-0 scale-90"--}}

       >
            <div class="modal-content modal-content-bs">
                <div class="modal-header">
                    <h6>Create a new service.</h6>
                </div>
                <div class="container z-depth-3" style="width: 95%">

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
                                <div class="form-line success">
                                    <select
                                            wire:model="form.customer_id"
                                            wire:change="price_inject()"
                                            class="materialize-select browser-default"
                                            id="select-cad-service-customer"
                                    >
                                        <option @if(empty(old('customer_id'))) selected @endif  value="">Customer</option>
                                        @foreach($customers as  $value)
                                            @if(old('form.customer_id') == $value->id)
                                                <option selected value="{{$value->id}}">{{$value->name}} </option>
                                            @else
                                                <option  value="{{$value->id}}">{{$value->name}} </option>
                                            @endif

                                        @endforeach

                                    </select>

                                    <label class="form-label"  for="select-cad-service-customer">Customer</label>
                                </div>
                                @error('form.customer_id')
                                <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                                @enderror
                                <div class="@error('form.customer_id') hide @enderror help-info">select the customer for service.</div>
                            </div>
                        </div>
                        <div class=" col s12 m4">
                            <div class="form-group">
                                <div class="form-line success">
                                    <select
                                            wire:model="form.employee1_id"
                                            id="select-cad-service-employee1"
                                            class="materialize-select browser-default"
                                    >
                                        <option  value="none">Employee</option>
                                        @foreach($employees as $values)
                                             @if(old('form.employee1_id') == $values->id)
                                                 <option selected  value="{{$values->id}}">{{$values->name}} </option>
                                            @else
                                                 <option  value="{{$values->id}}">{{$values->name}} </option>
                                            @endif


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
                    <div class="row label-employee-view-edit grey" >
                        <span class="label   label-padding">Service information</span>
                    </div>
                    <div class="row">
                        <div class="col s12 m4">
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
                        <div class="col s12 m4">
                            <div class="form-group">
                                <div class="form-line success">
{{--                                    <input class="form-control timepicker"  id="input-cad-service-time" name="service_time" value="{{ old('service_time') }}" />--}}
                                    <x-time-flat-pickr
                                            wire:model="form.service_time"
                                            id="input-cad-service-time"
                                            value="{{ old('form.service_time') }}"
                                    />
                                <label class="form-label"  for="input-cad-service-time">Service Time</label>
                            </div>
                            @error('form.service_time')
                            <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                            @enderror
                            <div class="@error('form.service_time') hide @enderror help-info">Select the service execution time.</div>

                            </div>
                        </div>
                        <div class=" col s12 m4">
                            <div class="form-group">
                                <div class="form-line success">
                                    <select
                                            wire:model="form.period"
                                            id="select-cad-service-period"
                                            class="materialize-select browser-default"
                                    >
                                                @php
                                                    $string_first = ""; $string_second = "";$string_third="";$string_none= "";
                                                    if(!empty(old("period"))){
                                                        switch (old("period")){
                                                            case'first': $string_first = "selected" ;break;
                                                            case'second':$string_second = "selected";break;
                                                            case'third':$string_third = "selected";break;
                                                        }
                                                    }else{
                                                        $string_none = "selected";
                                                    }

                                                @endphp
                                        <option {{ $string_none }} value="">period</option>
                                        <option {{ $string_first }} value="first">First</option>
                                        <option  {{ $string_second }} value="second">Second</option>
                                        <option  {{ $string_third }} value="third">third</option>
                                    </select>
                                    <label class="form-label"  for="select-cad-service-period">Service Period.</label>
                                </div>
                                @error('form.period')
                                <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                                @enderror

                                <div class="@error('form.period') hide @enderror help-info">Select the period of the day.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                        <div class=" col s12 m6">
                            <div class="form-group">
                                <div class="form-line success">
                                    <select
                                            wire:model="form.frequency"
                                            id="select-cad-service-frequency"
                                            class="materialize-select browser-default"
                                    >
                                                @php
                                                    $string_Eventual = ""; $string_Weekly = "";$string_Biweekly= "";$string_Three_weekly="";$string_Monthly= "";$string_none= "";
                                                    if(!empty(old("frequency"))){
                                                        switch (old("frequency")){
                                                            case'Wek':$string_Weekly = "selected";break;
                                                            case'Biw':$string_Biweekly = "selected";break;
                                                            case'Thr':$string_Three_weekly = "selected";break;
                                                            case'Mon':$string_Monthly = "selected";break;
                                                            case'One':
                                                            default: $string_Eventual = "selected"; break;
                                                        }
                                                    }else{
                                                        $string_none = "selected";
                                                    }

                                                @endphp
                                        <option {{ $string_none }} value="">Select one option</option>
                                        <option {{ $string_Eventual }} value="One">Eventual</option>
                                        <option {{ $string_Weekly }} value="Wek">Weekly</option>
                                        <option {{ $string_Biweekly }} value="Biw">Biweekly</option>
                                        <option {{ $string_Three_weekly }} value="Thr">Three-weekly</option>
                                        <option {{ $string_Monthly }} value="Mon">Monthly</option>

                                    </select>
                                    <label class="form-label"  for="select-cad-service-frequency">Service frequency.</label>
                                </div>
                                @error('form.frequency')
                                <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                                @enderror
                                <div class="@error('form.frequency') hide @enderror  help-info">Select the service execution frequency.</div>
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

