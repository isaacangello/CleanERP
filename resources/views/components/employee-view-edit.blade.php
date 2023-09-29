<div>
    <div class="row label-employee-view-edit" >
        <span class="label bg-light-green  label-padding">Personal information</span>
{{--        <hr>--}}
    </div>

    <div class="row clearfix">
        <div class="col s12 m12">
            <div class="form-group">
                <div class="form-line success">
                    <input class="form-control"  id="input-view-edit-employee-name" name="employee-name" value="{{$employeeName}}" />
                    <label class="form-label" for="input-view-edit-employee-name">Employee Name</label>
                </div>
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
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <input class="form-control"  id="input-view-edit-nascimento" name="employee-nascimento" value="{{$employeeBirth}}" />
                    <label class="form-label"  for="input-view-edit-nascimento">Date of birth</label>
                </div>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <input class="form-control"  id="input-view-edit-email" name="emplpoyeeEmail" value="{{$employeeEmail}}" />
                    <label class="form-label"  for="input-view-edit-">Employee Name</label>
                </div>
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
            </div>
        </div>
    </div>

    <div class="row clearfix">
            <div class="col s12 m6">
                <div class="form-group">
                    <div class="form-line success">
                        <input class="form-control"  id="input-view-edit-nascimento" name="employee-nascimento" value="{{$employeeBirth}}" />
                        <label class="form-label"  for="input-view-edit-nascimento">Employee Name</label>
                    </div>
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
                </div>
            </div>
    </div>
    <div class="row">
        <span class="label bg-light-green p-12 label-padding">Document information</span>
        <hr>
    </div>

    <div class="row clearfix">
        <div class="col s12 m12">
            <div class="form-group">
                <div class="form-line success">
                    <input class="form-control"  id="input-view-edit-document" name="employee-document" value="{{$employeeDocument}}" />
                    <label class="form-label"  for="input-view-edit-">Document</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <p>
                      <label>
                        <input name="employee-type" type="radio" checked />
                        <span class="grey-text text-darken-2">Residencial</span>
                      </label>
                    </p>
                </div>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <p>
                      <label>
                        <input name="employee-type" type="radio" />
                        <span class="grey-text text-darken-2">Commercial</span>
                      </label>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
            <div class="col s12 m7">
                <div class="form-group">
                    <div class="form-line success">
                        <input class="form-control"  id="input-view-edit-ref1" name="employee-refname1" value="{{$employeeRefName1}}" />
                        <label class="form-label"  for="input-view-edit-ref1">Reference Name 1</label>
                    </div>
                </div>
            </div>
            <div class="col s12 m5">
                <div class="form-group">
                    <div class="form-line success">
                        <input class="form-control"  id="input-view-edit-ref2" name="employee-refname2" value="{{$employeeRefPhone1}}" />
                        <label class="form-label"  for="input-view-edit-ref2">Reference phone 1</label>
                    </div>
                </div>
            </div>
    </div>
    <div class="row clearfix">
            <div class="col s12 m7">
                <div class="form-group">
                    <div class="form-line success">
                        <input class="form-control"  id="input-view-edit-ref1" name="employee-refname1" value="{{$employeeRefName2}}" />
                        <label class="form-label"  for="input-view-edit-ref1">Reference Name 1</label>
                    </div>
                </div>
            </div>
            <div class="col s12 m5">
                <div class="form-group">
                    <div class="form-line success">
                        <input class="form-control"  id="input-view-edit-ref2" name="employee-refname2" value="{{$employeeRefPhone2}}" />
                        <label class="form-label"  for="input-view-edit-ref2">Reference Phone 2</label>
                    </div>
                </div>
            </div>
    </div>

    <div class="row">
        <span class="label bg-light-green label-padding">Additional information</span>
        <hr>
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
            </div>
        </div>
        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <p>
                      <label>
                        <input name="employee-status" type="radio" />
                        <span class="grey-text text-darken-2">Commercial</span>
                      </label>
                    </p>
                </div>
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