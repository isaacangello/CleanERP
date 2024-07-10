<div>

       <div id="new-service" class="modal bottom-sheet">
           <div class="modal-header">
               <h6>Create a new service.</h6>
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

                    <div class="row label-employee-view-edit" >
                        <span class="label bg-light-green  label-padding">People involved in the service</span>
                    </div>
                    <form id="service-form" action="{{ route('services.store') }}" method="post">
                    @csrf
                        <input type="hidden" name="who_saved"  value="{{Auth::user()->name}}">
                        <input type="hidden" name="who_saved_id"  value="{{Auth::user()->id}}">
                    <div class="row">
                        <div class=" col s12 m4">
                            <div class="form-group">
                                <div class="form-line success">
                                    @php
                                        $prices = array();
                                        $i=0;
                                        foreach ($customers as $value){
                                           $prices[$i]['price_weekly']  = $value->price_weekly;
                                           $prices[$i]['price_biweekly']  = $value->price_biweekly;
                                           $prices[$i]['price_monthly']  = $value->price_monthly ;
                                        }
                                    @endphp
                                    <select class="materialize-select" id="select-cad-service-customer" name="customer_id" onchange="price_inject('#select-cad-service-charge')">
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
                                <div class="help-info">select the customer for service.</div>
                            </div>
                        </div>
                        <div class=" col s12 m4">
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
                        <div class=" col s12 m4">
                            <div class="form-group">
                                <div class="form-line success">
                                    <select class="materialize-select" id="select-cad-service-employee2" name="employee2_id">
                                        <option selected value="none">Second employee</option>
                                        @foreach($employees as $values)
                                             @if(old('employee2_id') == $values->id)
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
                    <div class="row label-employee-view-edit" >
                        <span class="label bg-light-green  label-padding">Service information</span>
                    </div>
                    <div class="row">
                        <div class="col s12 m4">
                            <div class="form-group">
                                <div class="form-line success">
                                <input class="form-control datepicker"  id="input-cad-service-date" name="service_date" value="{{ old('service_date') }}" />
                                <label class="form-label"  for="input-cad-service-date">Service Date</label>
                            </div>
                            <div class="help-info">Select the service execution date.</div>
                            </div>
                        </div>
                        <div class="col s12 m4">
                            <div class="form-group">
                                <div class="form-line success">
                                <input class="form-control timepicker"  id="input-cad-service-time" name="service_time" value="{{ old('service_time') }}" />
                                <label class="form-label"  for="input-cad-service-time">Service Time</label>
                            </div>
                            <div class="help-info">Select the service execution time.</div>
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
                    <div class="row">
                        <div class=" col s12 m6">
                            <div class="form-group">
                                <div class="form-line success">
                                    <select class="materialize-select" id="select-cad-service-charge" name="frequency_payment">
                                                @php
                                                    $string_Eventual = ""; $string_Weekly = "";$string_Biweekly= "";$string_Three_weekly="";$string_Monthly= "";$string_none= "";
                                                    if(!empty(old("frequency"))){
                                                        switch (old("frequency")){
                                                            case'One': $string_Eventual = "selected" ;break;
                                                            case'Wek':$string_Weekly = "selected";break;
                                                            case'Biw':$string_Biweekly = "selected";break;
                                                            case'Thr':$string_Three_weekly = "selected";break;
                                                            case'Mon':$string_Monthly = "selected";break;
                                                        }
                                                    }else{
                                                        $string_Eventual = "selected";
                                                    }

                                                @endphp

                                        <option {{ $string_Eventual }} value="One">Eventual </option>
                                        <option {{ $string_Weekly }} value="Wek">Weekly </option>
                                        <option {{ $string_Biweekly }} value="Biw">Biweekly </option>
                                        <option {{ $string_Monthly }} value="Mon">Monthly </option>
                                    </select>
                                    <label class="form-label"  for="select-cad-service-charge">type of charge.</label>
                                </div>
                                <div class="help-info">Select type of service charge.</div>
                            </div>
                        </div>
                        <div class=" col s12 m6">
                            <div class="form-group">
                                <div class="form-line success">
                                    <select class="materialize-select" id="select-cad-service-frequency" name="frequency">
                                                @php
                                                    $string_Eventual = ""; $string_Weekly = "";$string_Biweekly= "";$string_Three_weekly="";$string_Monthly= "";$string_none= "";
                                                    if(!empty(old("frequency_payment"))){
                                                        switch (old("frequency_payment")){
                                                            case'One': $string_Eventual = "selected" ;break;
                                                            case'Wek':$string_Weekly = "selected";break;
                                                            case'Biw':$string_Biweekly = "selected";break;
                                                            case'Thr':$string_Three_weekly = "selected";break;
                                                            case'Mon':$string_Monthly = "selected";break;
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
                                <div class="help-info">Select the service execution frequency.</div>
                            </div>
                        </div>
                    </div>
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