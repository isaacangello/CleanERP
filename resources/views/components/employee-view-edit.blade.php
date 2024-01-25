<div>

                <div class="row label-employee-view-edit" >
                    <span class="label bg-light-green  label-padding">Personal information</span>
                </div>

                <div class="row clearfix">
                    <div class="col s12 m8">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-employee-name" name="name" value="{{$employeeName}}" />
                                <label class="form-label" for="input-view-edit-employee-name">Employee Name</label>
                            </div>
                            <div class="help-info">Insert employee name.</div>
                        </div>
                    </div>
                    <div class="col s12 m4">
                        <div class="form-group">
                            <div class="form-line success">

                                <select id="select-cad-service-status" name="type">
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
                                <input class="form-control"  id="input-view-edit-employee-address" name="address" value="{{$employeeAddress}}" />
                                <label class="form-label"  for="input-view-edit-employee-address">Employee Address</label>
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
                                <input class="form-control datepicker"  id="input-view-edit-birth" name="birth" value="{{$employeeBirth_p}}" />
                                <label class="form-label"  for="input-view-edit-birth">Birth date</label>
                            </div>
                            <div class="help-info">Insert employee birthdate.</div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-email" name="email" value="{{$employeeEmail}}" />
                    <label class="form-label"  for="input-view-edit-">Employee email</label>
                            </div>
                            <div class="help-info">Insert employee email contact.</div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col s12 m12">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-phone" name="phone"  value="{{$employeePhone}}"  />
                                <label class="form-label"  for="input-view-edit-phone">Phone</label>
                            </div>
                            <div class="help-info">Insert employee phone.</div>
                        </div>
                    </div>
                </div>


                <div class="row label-employee-view-edit" >
                    <span class="label bg-light-green  label-padding">Document information and references.</span>
                </div>

                <div class="row clearfix">
                    <div class="col s12 m12">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-document" name="document" value="{{$employeeDocument}}"  />
                                <label class="form-label"  for="input-view-edit-">Document</label>
                            </div>
                            <div class="help-info">Insert one employee Document number.</div>
                        </div>
                    </div>
                </div>


                <div class="row clearfix">
                    <div class="col s12 m7">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-ref1" name="name_ref_one" value="{{$employeeRefName1}}" />
                                <label class="form-label"  for="input-view-edit-ref1">First reference Name.</label>
                            </div>
                            <div class="help-info">Insert the first employee reference name.</div>
                        </div>
                    </div>
                    <div class="col s12 m5">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-ref2" name="phone_ref_one" value="{{$employeeRefPhone1}}"  />
                                <label class="form-label"  for="input-view-edit-ref2">First reference phone.</label>
                            </div>
                            <div class="help-info">Insert the first employee reference phone.</div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col s12 m7">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-ref1" name="name_ref_two" value="{{$employeeRefName2}}" />
                                <label class="form-label"  for="input-view-edit-ref1">Second Reference Name</label>
                            </div>
                            <div class="help-info">Insert the second employee reference name.</div>
                        </div>
                    </div>
                    <div class="col s12 m5">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-ref2" name="phone_ref_two" value="{{$employeeRefPhone2}}" />
                                <label class="form-label"  for="input-view-edit-ref2">Reference Phone 2</label>
                            </div>
                            <div class="help-info">Insert the second employee reference phone.</div>
                        </div>
                    </div>
                </div>

                <div class="row label-employee-view-edit" >
                    <span class="label bg-light-green  label-padding">Additional information</span>
                </div>
                <div class="row clearfix">
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success">
                                <label class="form-label"  for="select-cad-service-frequency">Sector job.</label>
                                <select id="select-cad-service-type" name="type">
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
                                <select id="select-cad-service-frequency" name="shift">
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
                                <label class="form-label"  for="select-cad-service-frequency">Working period.</label>
                            </div>
                            <div class="help-info">Select working period.</div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-username" name="username" value="{{$employeeUsername}}" />
                                <label class="form-label"  for="input-view-edit-username">User name</label>
                            </div>
                            <div class="help-info">Insert Username to create  Employee login.</div>
                        </div>

                    </div>
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success">
                                <input class="form-control"  id="input-view-edit-password" name="password" value="{{$employeePassword}}" />
                                <label class="form-label"  for="input-view-edit-password">Password</label>
                            </div>
                            <div class="help-info">Insert Password to create  Employee login.</div>
                        </div>

                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col s12 m12">
                        <div class="form-group">
                            <div class="form-line success">
                                <label for="textarea-crud-costumer-restriction">Restriction field.</label>
                                <textarea style="padding: 10px;"
                               id="textarea-crud-costumer-restriction"
                               name="restriction"
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
                                <label for="textarea-crud-costumer-note">Notes.</label>
                    <textarea style="padding: 10px;"
                              id="textarea-crud-costumer-note"
                              name="note"
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