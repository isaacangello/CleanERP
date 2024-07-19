<div>

    <div id="new-schedule" class="modal bottom-sheet">
        <div class="modal-header">
            <h6>Create a new Schedule. </h6>
        </div>
        <div class="modal-content modal-content-bs">
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
                <!-- Divider ######################################################################################################-->
                <div class="row label-employee-view-edit" >
                    <span class="label bg-light-green  label-padding">People involved in the service schedule</span>
                </div>
                <!-- Divider ######################################################################################################-->
                <form id="schedule-form" action="{{ route('services.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="who_saved"  value="{{Auth::user()->name}}">
                    <input type="hidden" name="who_saved_id"  value="{{Auth::user()->id}}">
                    <!-- Row ######################################################################################################-->
                    <div class="row">
                        <div class=" col s12 m6">
                            <div class="form-group">
                                <div class="form-line success">
                                    @php
                                        $prices = array();
                                        $i=0;
                                        /**
                                        *  @var
                                         */
                                        foreach ($customers as $value){
                                           $prices[$i]['price_weekly']  = $value->price_weekly;
                                           $prices[$i]['price_biweekly']  = $value->price_biweekly;
                                           $prices[$i]['price_monthly']  = $value->price_monthly ;
                                        }
                                    @endphp
                                    <select class="materialize-select" id="select-cad-service-customer" name="customer_id" >
                                        @php
                                            if(!empty(old('customer_id'))){

                                            }
                                        @endphp
                                        <option @if(empty(old('customer_id'))) selected @endif  value="">Customer</option>
                                        @foreach($customers as  $value)
                                            @if(old('customer_id') == $value->id)
                                                <option selected value="{{$value->id}}">{{$value->name}} </option>
                                            @else
                                                <option  value="{{$value->id}}">{{$value->name}} </option>
                                            @endif

                                        @endforeach

                                    </select>
                                    <label class="form-label"  for="select-cad-service-customer">Customer</label>
                                </div>
                                <div class="help-info">select the customer for service schedule.</div>
                            </div>
                        </div>
                        <div class=" col s12 m6">
                            <div class="form-group">
                                <div class="form-line success">
                                    <select id="select-cad-service-employee1" name="employee1_id" class="materialize-select">
                                        <option  value="none">Employee</option>
                                        @foreach($employees as $values)
                                            @if(old('employee1_id') == $values->id)
                                                <option selected  value="{{$values->id}}">{{$values->name}} </option>
                                            @else
                                                <option  value="{{$values->id}}">{{$values->name}} </option>
                                            @endif


                                        @endforeach
                                    </select>
                                    <label class="form-label"  for="select-cad-service-employee1">Employee</label>
                                </div>
                                <div class="help-info">select the employee for service.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row label-employee-view-edit" >
                        <span class="label bg-light-green  label-padding">Schedule information</span>
                    </div>
                    <!-- Row ######################################################################################################-->
                    <div class="row">
                        <div class="col s12 m4">
                            <div class="form-group">
                                <div class="form-line success">
                                    <input class="form-control datepicker"  id="input-cad-service-date" name="service_date" value="{{ old('service_date') }}" />
                                    <label class="form-label"  for="input-cad-service-date">Schedule start Date</label>
                                </div>
                                <div class="help-info">Select the Schedule execution date start.</div>
                            </div>
                        </div>
                        <div class="col s12 m4">
                            <div class="form-group">
                                <div class="form-line success">
                                    <input class="form-control timepicker"  id="input-cad-service-time" name="service_time" value="{{ old('service_time') }}" />
                                    <label class="form-label"  for="input-cad-service-time">Service Time</label>
                                </div>
                                <div class="help-info">Select the Schedule execution time.</div>
                            </div>
                        </div>
                        <div class=" col s12 m4">
                            <div class="form-group">
                                <div class="form-line success">
                                    <select class="materialize-select" id="select-cad-service-period" name="period">
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
                                <div class="help-info">Select the period of the day.</div>
                            </div>
                        </div>
                    </div>
                    <!-- Divider ######################################################################################################-->
                    <div class="row label-employee-view-edit" >
                        <span class="label bg-light-green  label-padding">Service Schedule repeat. </span>
                    </div>
                    <!-- Divider ######################################################################################################-->

                    <!-- Row ######################################################################################################-->
                    <div class="row">
                        <div class=" col s12 ">
                            <label class="form-label"  for="select-cad-service-period">Schedule repeat.</label>
                            <div class="form-group p-10">
                                <div class="grid-schedules m-b-5">
                                    @foreach($weekArr as $key => $day)
                                        @if($key !== 'Saturday' and $key !== 'Sunday')
                                        <div class="switch">
                                            <label>
                                                <span class="green-text text-darken-4">{{$key}}</span>
                                                Off
                                                <input  name="loop[]" type="checkbox" value="{{$key}}">
                                                <span class="lever"></span>
                                                On
                                            </label>
                                        </div>
                                        @endif

                                    @endforeach
                                </div>

                                <div class="help-info">Select day for repeat Service Schedule.</div>
                            </div>
                        </div>
                    </div>
                    <!-- Divider ######################################################################################################-->
                    <div class="row label-employee-view-edit" >
                        <span class="label bg-light-green  label-padding">Additional information</span>
                    </div>
                    <!-- Divider ######################################################################################################-->

                        <!-- Row ######################################################################################################-->
                    <div class="row">
                        <div class=" col s12 m6">
                            <label for="textarea-cad-service-note">type service notes.</label>
                            <div class="form-group">
                                <div class="form-line success">
                                    <textarea style="padding: 10px;"  id="textarea-cad-service-note" name="notes"  class="form-control custom-textarea"  rows="4" placeholder="Please type service notes here...">{{ old('notes') }}</textarea>
                                </div>
                                <div class="help-info">Type customer notes </div>
                            </div>
                        </div>
                        <div class=" col s12 m6">
                            <label for="textarea-cad-costumer-instructions">Instructions for employees.</label>
                            <div class="form-group">
                                <div class="form-line success">
                                    <textarea style="padding: 10px;"  id="textarea-cad-costumer-instructions" name="instructions"  class="form-control custom-textarea"  rows="4" placeholder="Please type instructions for employees here...">{{ old('instructions') }}</textarea>
                                </div>
                                <div class="help-info">Type instructions for employees. </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn waves-classic waves-light btn-small " type="submit">save changes</button>
                        <a href="#!" class="btn modal-close waves-classic waves-light btn-small red darken-4">Cancel</a>
                    </div>
                </form>
            </div><!--END OF CONTAINER -->
        </div><!--END OF MODAL CONTENT -->
    </div>

</div>