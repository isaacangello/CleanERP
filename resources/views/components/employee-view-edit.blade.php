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
                                <input
                                        name="name"
                                        value="{{$employeeName}}"
                                        class="form-control listenerChanges"
                                        id="input-view-edit-employee-name{{$employeeId}}"
                                        data-employee-id="{{$employeeId}}"
                                        data-url-base="{{ $urlBase }}"
                                        data-token="{{ csrf_token() }}"
                                />
                                <label class="form-label" for="input-view-edit-employee-name{{$employeeId}}">Employee Name</label>
                            </div>
                            <div class="help-info">Insert employee name.</div>
                        </div>
                    </div>
                    <div class="col s12 m4">
                        <div class="form-group">
                            <div class="form-line success">

                                <select
                                        name="type"
                                        class="materialize-select listenerChanges"
                                        id="select-cad-service-status{{$employeeId}}"
                                        data-employee-id="{{$employeeId}}"
                                        data-url-base="{{ $urlBase }}"
                                        data-token="{{ csrf_token() }}"
                                >
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
                                <input
                                        name="address"
                                        class="form-control listenerChanges"
                                        id="input-view-edit-employee-address{{$employeeId}}"
                                        value="{{$employeeAddress}}"
                                />
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
                                    $options = "
                                            {
                                                weekNumbers:true,
                                                monthSelectorType:'static',
                                                dateFormat:'Y-m-d',
                                                altFormat:'F j, Y',
                                                altInput:true,
                                                defaultDate:$employeeBirth
                                            }
                                    ";
                                @endphp

                                <x-date-flat-pickr
                                        options="{!! $options !!}"
                                        name="birth"
                                        class="form-control listenerChanges"
                                        id="input-view-edit-birth{{$employeeId}}"
                                        data-employee-id="{{$employeeId}}"
                                        data-url-base="{{ $urlBase }}"
                                        data-token="{{ csrf_token() }}"
                                />
{{--                                <input name="birth" class="form-control datepicker"  id="input-view-edit-birth{{$employeeId}}"   />--}}
                                <label class="form-label"  for="input-view-edit-birth{{$employeeId}}">Birth date</label>
                            </div>
                            <div class="help-info">Insert employee birthdate.</div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success">
                                <input name="email"
                                       class="form-control listenerChanges"
                                       id="input-view-edit-email{{$employeeId}}"
                                       value="{{$employeeEmail}}"
                                       data-employee-id="{{$employeeId}}"
                                       data-url-base="{{ $urlBase }}"
                                       data-token="{{ csrf_token() }}"
                                />
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
                                <input
                                name="phone"
                                class="form-control listenerChanges"
                                id="input-view-edit-phone{{$employeeId}}"
                                value="{{$employeePhone}}"
                                data-employee-id="{{$employeeId}}"
                                data-url-base="{{ $urlBase }}"
                                data-token="{{ csrf_token() }}"
                                />
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
                                <input name="document"
                                       class="form-control listenerChanges"
                                       id="input-view-edit-document{{$employeeId}}"
                                       value="{{$employeeDocument}}"
                                       data-employee-id="{{$employeeId}}"
                                       data-url-base="{{ $urlBase }}"
                                       data-token="{{ csrf_token() }}"
                                />
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
                                <input name="name_ref_one"
                                       class="form-control listenerChanges"
                                       id="input-view-edit-ref1{{$employeeId}}"
                                       value="{{$employeeRefName1}}"
                                       data-employee-id="{{$employeeId}}"
                                       data-url-base="{{ $urlBase }}"
                                       data-token="{{ csrf_token() }}"
                                />
                                <label class="form-label"  for="input-view-edit-ref1{{$employeeId}}">First reference Name.</label>
                            </div>
                            <div class="help-info">Insert the first employee reference name.</div>
                        </div>
                    </div>
                    <div class="col s12 m5">
                        <div class="form-group">
                            <div class="form-line success">
                                <input name="phone_ref_one"
                                       class="form-control listenerChanges"
                                       id="input-view-edit-ref2{{$employeeId}}"
                                       value="{{$employeeRefPhone1}}"
                                       data-employee-id="{{$employeeId}}"
                                       data-url-base="{{ $urlBase }}"
                                       data-token="{{ csrf_token() }}"
                                />
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
                                <input name="name_ref_two"
                                       class="form-control listenerChanges"
                                       id="input-view-edit-ref1{{ $employeeId }}"
                                       value="{{ $employeeRefName2 }}"
                                       data-employee-id="{{ $employeeId }}"
                                       data-url-base="{{ $urlBase }}"
                                       data-token="{{ csrf_token() }}"
                                />
                                <label class="form-label"  for="input-view-edit-ref1{{ $employeeId }}" >Second Reference Name</label>
                            </div>
                            <div class="help-info">Insert the second employee reference name.</div>
                        </div>
                    </div>
                    <div class="col s12 m5">
                        <div class="form-group">
                            <div class="form-line success">
                                <input name="phone_ref_two"
                                       class="form-control listenerChanges"
                                       id="input-view-edit-ref2{{$employeeId}}"
                                       value="{{$employeeRefPhone2}}"
                                       data-employee-id="{{$employeeId}}"
                                       data-url-base="{{ $urlBase }}"
                                       data-token="{{ csrf_token() }}"
                                />
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
                                <select name="type"
                                        class="materialize-select listenerChanges"
                                        id="select-cad-service-sector-job{{$employeeId}}"
                                        data-employee-id="{{$employeeId}}"
                                        data-url-base="{{ $urlBase }}"
                                        data-token="{{ csrf_token() }}"
                                >
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
                                <select name="shift"
                                        class="materialize-select listenerChanges"
                                        id="select-cad-service-frequency{{$employeeId}}"
                                        data-employee-id="{{$employeeId}}"
                                        data-url-base="{{ $urlBase }}"
                                        data-token="{{ csrf_token() }}"
                                >
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
                                <input name="username"
                                       class="form-control listenerChanges"
                                       id="input-view-edit-username{{$employeeId}}"
                                       value="{{$employeeUsername}}"
                                       data-employee-id="{{$employeeId}}"
                                       data-url-base="{{ $urlBase }}"
                                       data-token="{{ csrf_token() }}"

                                />
                                <label class="form-label"  for="input-view-edit-username{{$employeeId}}">User name</label>
                            </div>
                            <div class="help-info">Insert Username to create  Employee login.</div>
                        </div>

                    </div>
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success">
                                <input  name="password"
                                        class="form-control listenerChanges"
                                        id="input-view-edit-password{{$employeeId}}"
                                        value="{{$employeePassword}}"
                                        data-employee-id="{{$employeeId}}"
                                        data-url-base="{{ $urlBase }}"
                                        data-token="{{ csrf_token() }}"

                                />
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
                                        name="restriction"
                                        id="textarea-crud-costumer-restriction{{$employeeId}}"
                                        class="form-control custom-textarea listenerChanges"
                                        rows="4"
                                        placeholder="Please type employee restriction here..."
                                        data-employee-id="{{$employeeId}}"
                                        data-url-base="{{ $urlBase }}"
                                        data-token="{{ csrf_token() }}"
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
                              class="form-control custom-textarea listenerChanges"
                              rows="4"
                              placeholder="Please type employee notes here..."
                              data-employee-id="{{$employeeId}}"
                              data-url-base="{{ $urlBase }}"
                              data-token="{{ csrf_token() }}"
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