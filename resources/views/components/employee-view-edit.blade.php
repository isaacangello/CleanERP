<div>
            @php

                $urlBase = "/api/employee/".$employeeId;
            @endphp

                <div class="row label-employee-view-edit" >
                    <span class="label label-padding">Personal information</span>
                </div>

                <div class="row clearfix">
                    <div class="col s12 m8">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-employee-name{{$employeeId}}" name="name" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" value="{{$employeeName}}" />
                                <label class="form-label" for="input-view-edit-employee-name{{$employeeId}}">Employee Name</label>
                            </div>
                            <div class="help-info">Insert employee name.</div>
                        </div>
                    </div>
                    <div class="col s12 m4">
                        <div class="form-group">
                            <div class="form-line success">

                                <select class="materialize-select" id="select-cad-service-status{{$employeeId}}" name="type" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')">
                                    <option value='{{ $employeeStatus }}'>{{ $employeeStatus }}</option>
                                    <option selected value="ACTIVE">ACTIVE</option>
                                    <option  value="INACTIVE">INACTIVE</option>
                                </select>
                                <label class="form-label"  for="select-cad-service-frequency">Status.</label>
                            </div>
                            <div class="help-info">Select your sector job.</div>
                        </div>
                    </div>

                </div>
                <div class="row clearfix">
                    <div class="col s12 m12">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-employee-address{{$employeeId}}" name="address" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" value="{{$employeeAddress}}" />
                                <label class="form-label"  for="input-view-edit-employee-address{{$employeeId}}">Employee Address</label>
                            </div>
                            <div class="help-info">Insert employee address.</div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success">
                                @php
                                    $employeeBirth_p = \Carbon\Carbon::create($employeeBirth)->format('m/d/Y');
                                @endphp
                                <input class="form-control datepicker"  id="input-view-edit-birth{{$employeeId}}" name="birth" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" value="{{$employeeBirth_p}}" />
                                <label class="form-label"  for="input-view-edit-birth{{$employeeId}}">Birth date</label>
                            </div>
                            <div class="help-info">Insert employee birthdate.</div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-email{{$employeeId}}" name="email" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" value="{{$employeeEmail}}" />
                    <label class="form-label"  for="input-view-edit-email{{$employeeId}}">Employee email</label>
                            </div>
                            <div class="help-info">Insert employee email contact.</div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col s12 m12">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-phone{{$employeeId}}" name="phone"  onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" value="{{$employeePhone}}"  />
                                <label class="form-label"  for="input-view-edit-phone{{$employeeId}}">Phone</label>
                            </div>
                            <div class="help-info">Insert employee phone.</div>
                        </div>
                    </div>
                </div>


                <div class="row label-employee-view-edit" >
                    <span class="label label-padding">Document information and references.</span>
                </div>

                <div class="row clearfix">
                    <div class="col s12 m12">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-document{{$employeeId}}" name="document" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" value="{{$employeeDocument}}"  />
                                <label class="form-label"  for="input-view-edit-document{{$employeeId}}">Document</label>
                            </div>
                            <div class="help-info">Insert one employee Document number.</div>
                        </div>
                    </div>
                </div>


                <div class="row clearfix">
                    <div class="col s12 m7">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-ref1{{$employeeId}}" name="name_ref_one" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" value="{{$employeeRefName1}}" />
                                <label class="form-label"  for="input-view-edit-ref1{{$employeeId}}">First reference Name.</label>
                            </div>
                            <div class="help-info">Insert the first employee reference name.</div>
                        </div>
                    </div>
                    <div class="col s12 m5">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-ref2{{$employeeId}}" name="phone_ref_one" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" value="{{$employeeRefPhone1}}"  />
                                <label class="form-label"  for="input-view-edit-ref2{{$employeeId}}">First reference phone.</label>
                            </div>
                            <div class="help-info">Insert the first employee reference phone.</div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col s12 m7">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-ref1{{$employeeId}}" name="name_ref_two" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" value="{{$employeeRefName2}}" />
                                <label class="form-label"  for="input-view-edit-ref1{{$employeeId}}">Second Reference Name</label>
                            </div>
                            <div class="help-info">Insert the second employee reference name.</div>
                        </div>
                    </div>
                    <div class="col s12 m5">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-ref2{{$employeeId}}" name="phone_ref_two" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" value="{{$employeeRefPhone2}}" />
                                <label class="form-label"  for="input-view-edit-ref2{{$employeeId}}">Reference Phone 2</label>
                            </div>
                            <div class="help-info">Insert the second employee reference phone.</div>
                        </div>
                    </div>
                </div>

                <div class="row label-employee-view-edit" >
                    <span class="label label-padding">Additional information</span>
                </div>
                <div class="row clearfix">
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success">
                                <label class="form-label"  for="select-cad-service-sector-job{{$employeeId}}">Sector job.</label>
                                <select class="materialize-select" id="select-cad-service-sector-job{{$employeeId}}" name="type" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')">
                                    <option selected value="{{$employeeType}}">{{$employeeType}}</option>
                                    <option  value="RESIDENTIAL">RESIDENTIAL</option>
                                    <option  value="COMMERCIAL">COMMERCIAL</option>
                                </select>

                            </div>
                            <div class="help-info">Select your sector job.</div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success">
                                <select class="materialize-select" id="select-cad-service-frequency{{$employeeId}}" name="shift" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')">
                                    @php $selected = false; if(!empty($employeeShift)){

                                            switch (old("shift")){
                                                case'FULL-TIME': $string_val = "Full Time"; $selected = true;echo"<option selected value='".$employeeShift."'>".$string_val."</option>"; break;
                                                case'PART-TIME': $string_val = "Part Time"; $selected = true;echo"<option selected value='".$employeeShift."'>".$string_val."</option>"; break;
                                                default: $selected = false;
                                            }

                                        }
                                    @endphp

                                    <option @php if(!$selected){echo "selected";} @endphp  value="FULL-TIME">Full Time</option>
                                    <option  value="PART-TIME">Part Time</option>
                                </select>
                                <label class="form-label"  for="select-cad-service-frequency{{$employeeId}}">Working period.</label>
                            </div>
                            <div class="help-info">Select working period.</div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-username{{$employeeId}}" name="username" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" value="{{$employeeUsername}}" />
                                <label class="form-label"  for="input-view-edit-username{{$employeeId}}">User name</label>
                            </div>
                            <div class="help-info">Insert Username to create  Employee login.</div>
                        </div>

                    </div>
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-password{{$employeeId}}" name="password" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" value="{{$employeePassword}}" />
                                <label class="form-label"  for="input-view-edit-password{{$employeeId}}">Password</label>
                            </div>
                            <div class="help-info">Insert Password to create  Employee login.</div>
                        </div>

                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col s12 m12">
                        <div class="form-group">
                            <div class="form-line success">
                                <label for="textarea-crud-costumer-restriction{{$employeeId}}">Restriction field.</label>
                                <textarea style="padding: 10px;"
                                    id="textarea-crud-costumer-restriction{{$employeeId}}"
                                    name="restriction"
                                    onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')"
                                    class="form-control custom-textarea"
                                    rows="4"
                                    placeholder="Please type employee restriction here..."
                                >{{$employeeRestriction}}</textarea>
                            </div>
                            <div class="help-info">Insert employee restriction.</div>
                        </div>

                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col s12 m12">
                        <div class="form-group">
                            <div class="form-line success">
                                <label for="textarea-crud-costumer-note{{$employeeId}}">Notes.</label>
                    <textarea style="padding: 10px;"
                              id="textarea-crud-costumer-note{{$employeeId}}"
                              name="note"
                              onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')"
                              class="form-control custom-textarea"
                              rows="4"
                              placeholder="Please type employee notes here..."
                    >{{$employeeDescription}}</textarea>
                            </div>
                            <div class="help-info">Insert employee Additional information.</div>
                        </div>

                    </div>
                </div>

</div>

{{--
    <div class="row clearfix">
        <div class="col s12 ">
            <div class="form-group">
                <div class="form-line success">

                </div>
            </div>
        </div>
    </div>

--}}