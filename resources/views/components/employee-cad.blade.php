<div>

    <!-- ############  Modal Structure ###########################################################################################-->
    <div id="new-employee" class="modal bottom-sheet">
        <div class="modal-content">
            <div class="container z-depth-3" style="width: 95%">
                <div class="row clearfix">
                    <div class="col s12">
                        <div id="error-box" class="alert alert-danger p-10 m-t-5 animate__animated animate__shakeX hide" role="alert">
                            <span class="font-18" id="errorMsg">Mensagem aqui</span>
                        </div>
                    </div>
                </div>

                <form id="formEmp" action="{{route('employees.store',['filtered_type' => $type])}}" method="post">
                @csrf
                <input type="hidden" name="status" value="ACTIVE">
                <div class="row label-employee-view-edit" >
                    <span class="label label-padding">Personal information</span>
                </div>

                <div class="row clearfix">
                    <div class="col s12 m12">
                        <div class="form-group">
                            <div class="form-line success form-line-name">
                                <input class="form-control" type="text" id="input-cad-employee-name" name="name" value="{{ old('name') }}" />
                                <label class="form-label" for="input-cad-employee-name">Employee Name</label>
                            </div>
                            <div class="help-info">Insert employee name.</div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col s12 m12">
                        <div class="form-group">
                            <div class="form-line success form-line-address">
                                <input class="form-control" type="text" id="input-cad-employee-address" name="address" value="{{ old('address') }}" />
                                <label class="form-label"  for="input-cad-employee-address">Employee Address</label>
                            </div>
                            <div class="help-info">Insert employee address.</div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success form-line-birth">
{{--                                datepicker--}}
                                <x-date-flat-pickr id="input-cad-birth" name="birth"  value="{{ old('birth') }}" />
                                <label class="form-label"  for="input-cad-birth">Birth date</label>
                            </div>
                            <div class="help-info">Insert employee birthdate.</div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success form-line-email">
                                <input class="form-control" type="text" id="input-cad-email" name="email" value="{{ old('email') }}" />
                    <label class="form-label"  for="input-cad-">Employee email</label>
                            </div>
                            <div class="help-info">Insert employee email contact.</div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col s12 m12">
                        <div class="form-group">
                            <div class="form-line success form-line-phone">
                                <input class="form-control" type="text" id="input-cad-phone" name="phone" value="{{ old('phone') }}" />
                                <label class="form-label"  for="input-cad-phone">Phone</label>
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
                            <div class="form-line success form-line-document">
                                <input class="form-control" type="text" id="input-cad-document" name="document" value="{{ old('document') }}" />
                                <label class="form-label"  for="input-cad-document">Document</label>
                            </div>
                            <div class="help-info">Insert one employee Document number.</div>
                        </div>
                    </div>
                </div>


                <div class="row clearfix">
                    <div class="col s12 m7">
                        <div class="form-group">
                            <div class="form-line success form-line-name_ref_one">
                                <input class="form-control" type="text" id="input-cad-name_ref_one" name="name_ref_one" value="{{ old('name_ref_one') }}" />
                                <label class="form-label"  for="input-cad-ref1">First reference Name.</label>
                            </div>
                            <div class="help-info">Insert the first employee reference name.</div>
                        </div>
                    </div>
                    <div class="col s12 m5">
                        <div class="form-group">
                            <div class="form-line success form-line-phone_ref_one">
                                <input class="form-control" type="text" id="input-cad-phone_ref_one" name="phone_ref_one" value="{{ old('phone_ref_one') }}" />
                                <label class="form-label"  for="input-cad-ref2">First reference phone.</label>
                            </div>
                            <div class="help-info">Insert the first employee reference phone.</div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col s12 m7">
                        <div class="form-group">
                            <div class="form-line success form-line-name_ref_two">
                                <input class="form-control" type="text" id="input-cad-name_ref_two" name="name_ref_two" value="{{ old('name_ref_two') }}" />
                                <label class="form-label"  for="input-cad-ref1">Second Reference Name</label>
                            </div>
                            <div class="help-info">Insert the second employee reference name.</div>
                        </div>
                    </div>
                    <div class="col s12 m5">
                        <div class="form-group">
                            <div class="form-line success form-line-phone_ref_two">
                                <input class="form-control" type="text" id="input-cad-phone_ref_two" name="phone_ref_two" value="{{ old('phone_ref_two') }}" />
                                <label class="form-label"  for="input-cad-ref2">Reference Phone 2</label>
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
                            <div class="form-line success form-line-type">
                                <select id="select-cad-service-frequency" name="type" class="materialize-select">
                                    @php
                                        $selected = false;
                                            if(empty(old("type")) and isset($type)){
                                                    switch ($type){
                                                        case'RESIDENTIAL': $string_val = "RESIDENTIAL"; $selected = true; echo"<option selected value='".$type."'>".$string_val."</option>";break;
                                                        case'COMMERCIAL':$string_val = "COMMERCIAL"; $selected = true; echo"<option selected value='".$type."'>".$string_val."</option>";break;
                                                        default: $selected = false;
                                                    }
                                            }else{
                                              if(!empty(old("type"))){
                                                    switch (old("type")){
                                                        case'RESIDENTIAL': $string_val = "RESIDENTIAL"; $selected = true; echo"<option selected value='".old("type")."'>".$string_val."</option>";break;
                                                        case'COMMERCIAL':$string_val = "COMMERCIAL"; $selected = true; echo"<option selected value='".old("type")."'>".$string_val."</option>";break;
                                                        default: $selected = false;
                                                    }

                                                }
                                        }

                                    @endphp
                                    <option @php if(!$selected){echo "selected";} @endphp value="RESIDENTIAL">RESIDENTIAL</option>
                                    <option  value="COMMERCIAL">COMMERCIAL</option>
                                </select>
                                <label class="form-label"  for="select-cad-service-frequency">Sector job.</label>
                            </div>
                            <div class="help-info">Select your sector job.</div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success form-line-shift">
                                <select id="select-cad-service-frequency" name="shift" class="materialize-select">
                                    @php $selected = false; if(!empty(old("shift"))){

                                            switch (old("shift")){
                                                case'FULL-TIME': $string_val = "Full Time"; $selected = true;echo"<option selected value='".old("shift")."'>".$string_val."</option>"; break;
                                                case'PART-TIME': $string_val = "Part Time"; $selected = true;echo"<option selected value='".old("shift")."'>".$string_val."</option>"; break;
                                                default: $selected = false;
                                            }

                                        }
                                    @endphp
                                    <option @php if(!$selected){echo "selected";} @endphp value="FULL-TIME">Full Time</option>
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
                            <div class="form-line success form-line-username">
                                <input class="form-control" type="text" id="input-cad-username" name="username" value="{{ old('username') }}" />
                                <label class="form-label"  for="input-cad-username">User name</label>
                            </div>
                            <div class="help-info">Insert Username to create  Employee login.</div>
                        </div>

                    </div>
                    <div class="col s12 m6">
                        <div class="form-group">
                            <div class="form-line success form-line-password">
                                <input class="form-control" type="text"  id="input-cad-password" name="password" value="{{ old('password') }}" />
                                <label class="form-label"  for="input-cad-password">Password</label>
                            </div>
                            <div class="help-info">Insert Password to create  Employee login.</div>
                        </div>

                    </div>
                </div>

                <div class="row clearfix">
                    <div class="col s12 m12">
                        <div class="form-group">
                            <div class="form-line success form-line-restriction">
                                <label for="textarea-crud-costumer-restriction">Restriction field.</label>
                                <textarea style="padding: 10px;"
                               id="textarea-crud-costumer-restriction"
                               name="restriction"
                               class="form-control custom-textarea"
                               rows="4"
                               placeholder="Please type employee restriction here..."
                                >{{ old('restriction') }}</textarea>
                            </div>
                            <div class="help-info">Insert employee restriction.</div>
                        </div>

                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col s12 m12">
                        <div class="form-group">
                            <div class="form-line success form-line-note">
                                <label for="textarea-crud-costumer-note">Notes.</label>
                    <textarea style="padding: 10px;"
                              id="textarea-crud-costumer-note"
                              name="note"
                              class="form-control custom-textarea"
                              rows="4"
                              placeholder="Please type employee notes here..."
                    >{{ old('note') }}</textarea>
                            </div>
                            <div class="help-info">Insert employee Additional information.</div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnSaveEmp" class="btn  btn-small " type="submit">save changes</button>
                    <a href="#!" class="btn modal-close btn-small red darken-4">Cancel</a>
                </div>
                </form>
            </div><!--END OF CONTAINER -->

        </div><!--END OF MODAL CONTENT -->
    </div>
</div>
