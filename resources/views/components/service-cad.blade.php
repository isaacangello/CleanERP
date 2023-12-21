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
                    <div class="row">
                        <div class=" col s12 m4">
                            <div class="form-group">
                                <div class="form-line success">
                                    <select id="select-cad-service-customer" name="customerService">
                                        <option selected value="">Customer</option>
                                        @foreach($customers as  $value)
                                            <option  value="{{$value->id}}">{{$value->name}} </option>
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
                                    <select id="select-cad-service-employee1" name="employee1Service">
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
                                    <select id="select-cad-service-employee2" name="employee2Service">
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
                                <input class="form-control datepicker"  id="input-cad-service-date" name="service-date" value="" />
                                <label class="form-label"  for="input-cad-service-date">Service Date</label>
                            </div>
                            <div class="help-info">Select the service execution date.</div>
                            </div>
                        </div>
                        <div class="col s12 m4">
                            <div class="form-group">
                                <div class="form-line success">
                                <input class="form-control timepicker"  id="input-cad-service-time" name="service-time" value="" />
                                <label class="form-label"  for="input-cad-service-time">Service Time</label>
                            </div>
                            <div class="help-info">Select the service execution time.</div>
                            </div>
                        </div>
                        <div class=" col s12 m4">
                            <div class="form-group">
                                <div class="form-line success">
                                    <select id="select-cad-service-period" name="service-period">
                                        <option selected value="none">period</option>
                                        <option selected value="first">First</option>
                                        <option selected value="second">Second</option>
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
                                    <select id="select-cad-service-charge" name="service-charge">
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
                                    <select id="select-cad-service-frequency" name="service-frequency">
                                        <option selected value="One">Eventual</option>
                                        <option selected value="Wek">Weekly</option>
                                        <option selected value="Biw">Biweekly</option>
                                        <option selected value="Thr">Three-weekly</option>
                                        <option selected value="Mon">Monthly</option>
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
                                        <textarea style="padding: 10px;"  id="textarea-cad-service-note" name="service-note"  class="form-control custom-textarea"  rows="4" placeholder="Please type service notes here..."></textarea>
                                    </div>
                                    <div class="help-info">Type customer notes </div>
                                </div>
                        </div>
                        <div class=" col s12 m6">
                                <label for="textarea-cad-costumer-note">Instructions for employees.</label>
                                <div class="form-group">
                                    <div class="form-line success">
                                        <textarea style="padding: 10px;"  id="textarea-cad-costumer-note" name="costumer-note"  class="form-control custom-textarea"  rows="4" placeholder="Please type instructions for employees here..."></textarea>
                                    </div>
                                    <div class="help-info">Type instructions for employees. </div>
                                </div>
                        </div>
                    </div>
                            <div class="modal-footer">
                                <button class="btn waves-classic waves-light btn-small " type="submit">save changes</button>
                                <a href="#!" class="btn modal-close waves-classic waves-light btn-small red darken-4">Cancel</a>
                            </div>

                </div><!--END OF CONTAINER -->
            </div><!--END OF MODAL CONTENT -->
    </div>

</div>