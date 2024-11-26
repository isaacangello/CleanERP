<div>

    <div id="new-schedule" class="modal-default bottom-sheet"
         x-show="cadOpen"
         x-transition:enter="animate__animated animate__slideInUp animate__faster"
         {{--            x-transition:enter-start="opacity-0 scale-90"--}}
         {{--            x-transition:enter-end="opacity-100 scale-100"--}}
         x-transition:leave="animate__animated animate__slideOutDown animate__faster"
            {{--            x-transition:leave-start="opacity-100 scale-100"--}}
            {{--            x-transition:leave-end="opacity-0 scale-90"--}}

    >

        <div class="modal-content modal-content-bs modal-col-white">
            <div class="modal-header">
                <h6>Create a new Schedule. </h6>
            </div>
            <div class="container z-depth-3" >

                <div class="hide info-box-3 bg-red hover-zoom-effect animate__animated animate__shakeX" id="error_infobox">
                    <div class="icon">
                        <i class="material-icons pulse">report</i>
                    </div>
                    <div class="content">
                        <div class="text ">ERROR</div>
                        <div id="error-text" class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
                <!-- Divider ######################################################################################################-->
                <div class="row label-employee-view-edit" >
                    <span class="label label-padding">People involved in the service schedule</span>
                </div>
                <!-- Divider ######################################################################################################-->
                <form id="schedule-form"  wire:submit.prevent="store">
                    @csrf
                    <input type="hidden" name="who_saved_id" value="{{Auth::id()}}" id="cad-schedule-who_saved_id">
                    <!-- Row ######################################################################################################-->
                    <div class="row">
                        <div class=" col s12 m4">
                            <div class="form-group">
                                <div class="form-line success form-line-customer_id">
                                    <select
                                            wire:model="form.customer_id"
                                            id="cad-schedule-customer_id"
                                            class="materialize-select browser-default"
                                    >
                                        <option @if(empty(old('form.customer_id'))) selected @endif  value="">Customer</option>
                                        @foreach($customers as  $value)
                                            @if(old('form.customer_id') == $value->id)
                                                <option selected value="{{$value->id}}">{{$value->name}} </option>
                                            @else
                                                <option  value="{{$value->id}}">{{$value->name}} </option>
                                            @endif

                                        @endforeach

                                    </select>
                                    <label class="form-label"  for="cad-schedule-customer">Customer</label>
                                </div>
                                @error('form.customer_id')
                                <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                                @enderror

                                <div class="@error('form.customer_id') hide @enderror help-info" id="help-info-customer_id">select the customer for service schedule.</div>
                            </div>
                        </div>
                        <div class=" col s12 m4">
                            <div class="form-group">
                                <div class="form-line success form-line-denomination">
                                    <label class="form-label"  for="cad-schedule-denomination">Denomination</label>
                                    <input
                                            wire:model.blur="form.denomination"
                                            class="form-control"  id="cad-schedule-denomination"
                                            value="{{ old('form.denomination') }}"
                                    />
                                </div>
                                @error('form.denomination')
                                <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                                @enderror
                                <div class="@error('form.denomination') hide @enderror help-info" id="help-info-denomination">Type one denomination.</div>
                            </div>
                        </div>
                        <div class=" col s12 m4">
                            <div class="form-group">
                                <div class="form-line success form-line-employee_id">
                                    <select
                                            wire:model.blur="form.employee_id"
                                            id="cad-schedule-employee_id"
                                            class="materialize-select browser-default"
                                    >
                                        <option  value="none">Employee</option>
                                        @foreach($employees as $values)
                                            @if(old('form.employee_id') == $values->id)
                                                <option selected  value="{{$values->id}}">{{$values->name}} </option>
                                            @else
                                                <option  value="{{$values->id}}">{{$values->name}} </option>
                                            @endif


                                        @endforeach
                                    </select>
                                    <label class="form-label"  for="cad-schedule-employee_id">Employee</label>
                                </div>
                                @error('form.employee_id')
                                <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                                @enderror
                                <div id="help-info-employee_id" class="@error('form.employee_id') hide @enderror help-info" >select the employee for service.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row label-employee-view-edit" >
                        <span class="label label-padding">Schedule information</span>
                    </div>
                    <!-- Row ######################################################################################################-->
                    <div class="row">
                        <div class="col s12 m6">
                            <div class="form-group">
                                <div class="form-line success form-line-schedule_date">
                                    <x-date-flat-pickr
                                            wire:model.debounce="form.schedule_date"
                                            id="cad-schedule-schedule_date"
                                            value="{{ old('schedule_date') }}"
                                    />
                                    <label class="form-label"  for="cad-schedule-schedule_date">Schedule start Date</label>
                                </div>
                                @error('form.schedule_date')
                                <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                                @enderror
                                <div class="@error('form.schedule_date') hide @enderror help-info" id="help-info-schedule_date">Select the Schedule execution date start.</div>
                            </div>
                        </div>
                        <div class=" col s12 m6">
                            <div class="form-group">
                                <div class="form-line success form-line-period">
                                    <select
                                            wire:model.blur="form.team"
                                            class="materialize-select browser-default"
                                            id="cad-schedule-team"
                                    >
                                        @php
                                            $string_first = "selected"; $string_second = "";$string_none= "";
                                            if(!empty(old("form.team"))){
                                                $string_first = ""; $string_second = "";$string_none= "";
                                                switch (old("form.team")){
                                                    case'scale1': $string_first = "selected" ;break;
                                                    case'scale2':$string_second = "selected";break;
                                                }
                                            }else{
                                                $string_first = "selected";
                                            }

                                        @endphp
                                        <option {{ $string_none }} value="scale1">select Scale</option>
                                        <option {{ $string_first }} value="scale1">Scale 1</option>
                                        <option  {{ $string_second }} value="scale2">Scale 2</option>
                                    </select>
                                    <label class="form-label"  for="select-cad-service-period">Team.</label>
                                </div>
                                @error('form.team')
                                <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                                @enderror

                                <div class="@error('form.team') hide @enderror help-info" id="help-info-loop">Select theTeam of this schedule.</div>
                            </div>
                        </div>
                    </div>
                    <!-- Divider ######################################################################################################-->
                    <div class="row label-employee-view-edit" >
                        <span class="label label-padding">Service Schedule repeat. </span>
                    </div>
                    <!-- Divider ######################################################################################################-->

                    <!-- Row ######################################################################################################-->
                    <div class="row">
                        <div class=" col s12 m6">
                            <label class="form-label"  for="cad-schedule-loop">frequency of repetition.</label>
                            <div class="form-group p-t-10 p-b-10 form-line-loop" id="cad-schedule-loop">
                                <div class="form-line success form-line-period">
                                    <select
                                            wire:model="form.repeat_frequency"
                                            id="select-cad-service-form.repeat_frequency"
                                            class="materialize-select browser-default"
                                    >
                                        @php
                                            $string_Eventual = ""; $string_Weekly = "";$string_Biweekly= "";$string_Three_weekly="";$string_Monthly= "";$string_none= "";
                                            if(!empty(old("form.repeat_frequency"))){
                                                switch (old("form.repeat_frequency")){
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
                                        <option {{ $string_Weekly }} value="WEK">Weekly</option>
                                        <option {{ $string_Biweekly }} value="BIW">Biweekly</option>
                                        <option {{ $string_Three_weekly }} value="THR">Three-weekly</option>
                                        <option {{ $string_Monthly }} value="MON">Monthly</option>

                                    </select>
{{--                                    <label class="form-label"  for="select-cad-service-period">frequency of repetition.</label>--}}
                                </div>

                                @error('form.repeat_frequency')
                                <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                                @enderror

                                <div class="@error('form.repeat_frequency') hide @enderror help-info" id="help-info-loop">Select frequency of repetition Service Schedule.</div>
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
                    <!-- Divider ######################################################################################################-->
                    <div class="row label-employee-view-edit" >
                        <span class="label label-padding">Additional information</span>
                    </div>
                    <!-- Divider ######################################################################################################-->

                        <!-- Row ######################################################################################################-->
                    <div class="row">
                        <div class=" col s12 m6">
                            <label for="cad-schedule-note">type service notes.</label>
                            <div class="form-group">
                                <div class="form-line success form-line-notes">
                                    <textarea style="padding: 10px; height: 50px"  id="cad-schedule-note" wire:model="form.notes"  class="form-control custom-textarea"  rows="2" placeholder="Please type service notes here...">{{ old('notes') }}</textarea>
                                </div>
                                <div class="help-info" id="help-info-notes">Type customer notes </div>
                            </div>
                        </div>
                        <div class=" col s12 m6">
                            <label for="textarea-cad-costumer-instructions">Instructions for employees.</label>
                            <div class="form-group">
                                <div class="form-line success form-line-instructions">
                                    <textarea style="padding: 10px;"  id="textarea-cad-costumer-instructions" wire:model="form.instructions"  class="form-control custom-textarea"  rows="2" placeholder="Please type instructions for employees here...">{{ old('instructions') }}</textarea>
                                </div>
                                <div class="help-info" id="help-info-instructions">Type instructions for employees. </div>
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

</div>