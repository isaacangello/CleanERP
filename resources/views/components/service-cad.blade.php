<div>
       <div id="new-service" class="modal bottom-sheet">
           <div class="modal-header">
               <h6>Create a new service.</h6>
           </div>
            <div class="modal-content">
                <div class="container z-depth-3" style="width: 95%">
                    <div class="row label-employee-view-edit" >
                        <span class="label bg-light-green  label-padding">People involved in the service</span>
                    </div>
                    <form action="{{ route('services.store') }}" method="post">
                    @csrf
                        <input type="hidden" name="who_saved" id="" value="{{Auth::user()->name}}">
                        <input type="hidden" name="who_saved_id" id="" value="{{Auth::user()->id}}">
                    <div class="row">
                        <div class=" col s12 m4">
                            <div class="form-group">
                                <div class="form-line success">
                                    <select id="select-cad-service-customer" name="customer_id">
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
                                    <select id="select-cad-service-employee1" name="employee1_id">
                                        <option selected value="none">Employee</option>
                                        @foreach($employees as $values)
                                            <option  value="{{$values->id}}">{{$values->name}} </option>
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
                                    <select id="select-cad-service-employee2" name="employee2_id">
                                        <option selected value="none">Second employee</option>
                                        @foreach($employees as $values)
                                            <option  value="{{$values->id}}">{{$values->name}} </option>
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
                                    <select id="select-cad-service-period" name="period">
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
                                        <option {{ $string_none }} value="none">period</option>
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
                                    <select id="select-cad-service-charge" name="frequency">
                                        <option selected value="One">Eventual</option>
                                        <option selected value="Wek">Weekly</option>
                                        <option selected value="Biw">Biweekly</option>
                                        <option selected value="Thr">Three-weekly</option>
                                        <option selected value="Mon">Monthly</option>
                                    </select>
                                    <label class="form-label"  for="select-cad-service-charge">type of charge.</label>
                                </div>
                                <div class="help-info">Select type of service charge.</div>
                            </div>
                        </div>
                        <div class=" col s12 m6">
                            <div class="form-group">
                                <div class="form-line success">
                                    <select id="select-cad-service-frequency" name="frequency_payment">
                                        <option selected value="One">Price for Eventual</option>
                                        <option selected value="Wek">Price for Weekly</option>
                                        <option selected value="Biw">Price for Biweekly</option>
                                        <option selected value="Mon">Price for Monthly</option>
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
                                        <textarea style="padding: 10px;"  id="textarea-cad-service-note" name="notes"  class="form-control custom-textarea"  rows="4" placeholder="Please type service notes here..."></textarea>
                                    </div>
                                    <div class="help-info">Type customer notes </div>
                                </div>
                        </div>
                        <div class=" col s12 m6">
                                <label for="textarea-cad-costumer-note">Instructions for employees.</label>
                                <div class="form-group">
                                    <div class="form-line success">
                                        <textarea style="padding: 10px;"  id="textarea-cad-costumer-note" name="instructions"  class="form-control custom-textarea"  rows="4" placeholder="Please type instructions for employees here..."></textarea>
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