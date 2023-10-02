<div>
    <div class="row label-employee-view-edit" >
        <span class="label bg-light-green  label-padding">Personal information</span>
    </div>

    <div class="row clearfix">
        <div class="col s12 m12">
            <div class="form-group">
                <div class="form-line success">
                    <input class="form-control"  id="input-view-edit-employee-name" name="employee-name" value="{{$employeeName}}" />
                    <label class="form-label" for="input-view-edit-employee-name">Employee Name</label>
                </div>
                <div class="help-info">Insert emplyee name.</div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col s12 m12">
            <div class="form-group">
                <div class="form-line success">
                    <input class="form-control"  id="input-view-edit-employee-address" name="employee-address" value="{{$employeeAddress}}" />
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
                    <input class="form-control datepicker"  id="input-view-edit-nascimento" name="employee-nascimento" value="{{$employeeBirth}}" />
                    <label class="form-label"  for="input-view-edit-nascimento">Date of birth</label>
                </div>
                <div class="help-info">Insert employee date of birth.</div>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <input class="form-control"  id="input-view-edit-email" name="emplpoyeeEmail" value="{{$employeeEmail}}" />
                    <label class="form-label"  for="input-view-edit-email">Employee email</label>
                </div>
                <div class="help-info">Insert employee email contact.</div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <input class="form-control"  id="input-view-edit-phone" name="employee-phone" value="{{$employeePhone}}" />
                    <label class="form-label"  for="input-view-edit-nascimento">Phone</label>
                </div>
                <div class="help-info">Insert employee phone.</div>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                        <p>
                          <label>
                            <input name="group1" type="radio" checked />
                            <span class="grey-text text-darken-2 ">Part Time</span>
                          </label>
                        </p>
                </div>
                <div class="help-info">Select working period.</div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
            <div class="col s12 m6">
                <div class="form-group">
                    <div class="form-line success">
                        <input class="form-control" type="text"  id="input-view-edit-restricao" name="employee-Restriçao" value="{{$employeeRestricao}}" />
                        <label class="form-label"  for="input-view-edit-restricao">Employee Restriçao</label>
                    </div>
                    <div class="help-info">Insert employee Restricao.</div>
                </div>

            </div>
            <div class="col s12 m6">
                <div class="form-group">
                    <div class="form-line success">
                        <p>
                          <label>
                            <input name="group1" type="radio" />
                            <span class="grey-text text-darken-2">Full Time</span>
                          </label>
                        </p>
                    </div>
                    <div class="help-info">Select working period.</div>
                </div>
            </div>
    </div>

    <div class="row label-employee-view-edit" >
        <span class="label bg-light-green  label-padding">Document information</span>
    </div>

    <div class="row clearfix">
        <div class="col s12 m12">
            <div class="form-group">
                <div class="form-line success">
                    <input class="form-control"  id="input-view-edit-document" name="employee-document" value="{{$employeeDocument}}" />
                    <label class="form-label"  for="input-view-edit-">Document</label>
                </div>
                <div class="help-info">Insert one employee Document number.</div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <p>
                      <label>
                        <input name="employee-type" type="radio" checked>
                        <span class="grey-text text-darken-2">Residencial</span>
                      </label>
                    </p>
                </div>
                <div class="help-info">Select your sector job.</div>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <p>
                      <label>
                        <input name="employee-type" type="radio" >
                        <span class="grey-text text-darken-2">Commercial</span>
                      </label>
                    </p>
                </div>
                <div class="help-info">Select your sector job.</div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
            <div class="col s12 m7">
                <div class="form-group">
                    <div class="form-line success">
                        <input class="form-control"  id="input-view-edit-ref1" name="employee-refname1" value="{{$employeeRefName1}}" />
                        <label class="form-label"  for="input-view-edit-ref1">First reference Name.</label>
                    </div>
                    <div class="help-info">Insert the first employee reference name.</div>
                </div>
            </div>
            <div class="col s12 m5">
                <div class="form-group">
                    <div class="form-line success">
                        <input class="form-control"  id="input-view-edit-ref2" name="employee-refname2" value="{{$employeeRefPhone1}}" />
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
                        <input class="form-control"  id="input-view-edit-ref1" name="employee-refname1" value="{{$employeeRefName2}}" />
                        <label class="form-label"  for="input-view-edit-ref1">Second Reference Name</label>
                    </div>
                    <div class="help-info">Insert the second employee reference name.</div>
                </div>
            </div>
            <div class="col s12 m5">
                <div class="form-group">
                    <div class="form-line success">
                        <input class="form-control"  id="input-view-edit-ref2" name="employee-refname2" value="{{$employeeRefPhone2}}" />
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
                    <p>
                      <label>
                        <input name="employee-status" type="radio" checked />
                        <span class="grey-text text-darken-2">Active</span>
                      </label>
                    </p>
                </div>
                <div class="help-info">Select if employee is active.</div>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <p>
                      <label>
                        <input name="employee-status" type="radio" />
                        <span class="grey-text text-darken-2">Inactive</span>
                      </label>
                    </p>
                </div>
                <div class="help-info">Select if employee is inactive.</div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col s12 m12">
            <div class="form-group">
                <div class="form-line success">
                    <textarea style="padding: 10px;"
                              id="textarea-crud-costumer-note"
                              name="costumer-note"
                              class="form-control custom-textarea"
                              rows="4"
                              placeholder="Please type customer notes here..."
                    >{{$employeeNote}}</textarea>
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