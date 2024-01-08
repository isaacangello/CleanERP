<div>

<!-- ############  Modal Structure ###########################################################################################-->
    <div id="new-customer" class="modal bottom-sheet">
        <div class="modal-content">
            <form method="post" action="{{ route('customers.store') }}">
                @csrf
                <div class="container z-depth-3" style="width: 95%">
                            <div class="row clearfix">
                                <div class="col s12 m8">
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <input id="input-cad-customer-name" name="name" type="text" class="form-control" value="">
                                            <label class="form-label" for="input-cad-customer-name">Name Customer</label>
                                        </div>
                                        <div class="help-info">Insert name Customer</div>
                                    </div>
                                </div>
                                <div class=" col s12 m4">
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <select id="select-cad-customer-type" name="type">
                                                <option value="">Select one option</option>
                                                <option selected value="RESIDENCIAL">RESIDENCIAL</option>
                                                <option value="COMERCIAL">COMERCIAL</option>
                                                <option value="RENTALHOUSE">RENTAL HOUSE</option>
                                            </select>
                                        </div>
                                        <div class="help-info">select type of customer</div>
                                    </div>

                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col s12 m7">

                                    <div class="form-group">
                                        <div class="form-line success">
                                            <input type="text" id="input-cad-customer-address" name="address" class="form-control" value="">
                                            <label class="form-label" for="input-cad-customer-address">Address Customer</label>
                                        </div>
                                        <div class="help-info">Insert address Customer</div>
                                    </div>
                                </div>
                                <div class="col s12 m5">

                                    <div class="form-group">
                                        <div class="form-line success">
                                            <input type="text" id="input-cad-customer-address-complement" name="complement"   class="form-control" value="">
                                            <label class="form-label" for="input-cad-customer-address-complement">Complement</label>
                                        </div>
                                        <div class="help-info">Insert address Complement</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col s12 m6">
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <input type="text" id="input-cad-customer-phone" name="phone" class="form-control" value="" >
                                            <label class="form-label" for="input-cad-customer-phone">Phone</label>
                                        </div>
                                        <div class="help-info">Insert phone </div>
                                    </div>
                                </div>

                                <div class="col s12 m6">
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <input type="text" id="input-cad-customer-email" name="email" class="form-control" value="">
                                            <label class="form-label" for="input-cad-customer-email" >Email</label>
                                        </div>
                                        <div class="help-info">Insert email</div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider clearfix" style="margin: 30px 0 30px 0;"></div>

                            <div class="row clearfix">
                                <div class="col s12 m3">
                                     <ul class="collection">
                                      <li class="collection-item">
                                        <div class="form-group" style="margin:0;padding: 0;">
                                            <div class="form-line success">
                                                <input type="text" id="input-cad-customer-price-weekly" name="price_weekly" class="form-control" value="">
                                                <label class="form-label " for="input-cad-customer-price-weekly">Price for weekly.</label>
                                            </div>
                                        </div>
                                      </li>
                                      <li class="collection-item">
                                         <div class="form-group" style="margin:0;padding: 0;">
                                            <div class="form-line success">
                                                <input type="text" id="input-cad-customer-price-biweekly" name="price_biweekly" class="form-control" value="">
                                                <label class="form-label " for="input-cad-customer-price-biweekly">Price for biweekly.</label>
                                            </div>
                                         </div>
                                      </li>
                                      <li class="collection-item">
                                        <div class="form-group" style="margin:0;padding: 0;">
                                            <div class="form-line success">
                                                <input type="text" id="input-cad-customer-price-monthly" name="price_monthly" class="form-control" value="">
                                                <label class="form-label " for="input-cad-customer-price-monthly">Price for monthly.</label>
                                            </div>
                                        </div>

                                      </li>
                                    </ul>
                                </div>
                                <div class="col s12 m5">
                                    <label for="textarea-cad-costumer-other-services">Other Services</label>
                                    <div class="form-group" >
                                        <div class="form-line success " >
                                            <textarea id="textarea-cad-costumer-other-services" name="other_services"  class="form-control custom-textarea"  rows="4" placeholder="Other services here..."></textarea>

                                        </div>
                                        <div class="help-info">Ohter Services</div>
                                    </div>
                                </div>

                                <div class="col s12 m4">
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <select class="btn-group bootstrap-select  show-tick">
                                                <option disabled>select status of cutomer</option>
                                                <option selected value="ACTIVE">ACTIVE</option>
                                                <option value="INACTIVE">INACTIVE</option>
                                            </select>
                                        </div>
                                        <div class="help-info">select status of customer</div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <input type="text"  name="justify_inactive" id="input-cad-customer-justify-inactive" class="form-control" value=""/>
                                            <label class="form-label" for="input-cad-customer-justify-inactive">why change customer status ?</label>
                                        </div>
                                        <div class="help-info">Why change customer status ?</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col s12 m5">
                                     <div class="checkbox-float">
                                        <input type="checkbox" id="md-checkbox-keys" name="customer-keys" value="" class="filled-in chk-col-teal"  />
                                        <label for="md-checkbox-keys"> Keys in office ?</label>
                                     </div>
                                    <div class="checkbox-float">
                                        <input type="checkbox" id="md-checkbox-drive-licence" name="drive_licence" value="" class="filled-in chk-col-teal"   />
                                        <label for="md-checkbox-drive-licence" > Need driver licence ?</label><br>
                                    </div>
                                    <div class="checkbox-float">
                                        <input type="checkbox" id="md-checkbox-gate-code" name="gate_code" value="" class="filled-in chk-col-teal" />
                                        <label for="md-checkbox-gate-code" > Need door or gate code ?</label>
                                    </div>
                                    <div class="checkbox-float">
                                        <input type="checkbox" id="md-checkbox-more-girl" name="more_girl" value="" class="filled-in chk-col-teal" />
                                        <label for="md-checkbox-more-girl" style="margin-right: 20px;"> More then one girl ?</label>
                                    </div>
                                </div>
                                <div class="col s12 m7">
                                    <label for="textarea-cad-customer-house-description" >House description.</label>
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <textarea style="padding: 10px; height: 200px"  id="textarea-cad-customer-house-description" name="house_description" class="form-control custom-textarea"   placeholder="Please type customer house description here..."></textarea>
                                        </div>
                                        <div class="help-info">Type house description</div>
                                    </div>

                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col s12">
                                    <label for="textarea-cad-costumer-note">type customer notes.</label>
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <textarea style="padding: 10px;"  id="textarea-cad-costumer-note" name="note"  class="form-control custom-textarea"  rows="4" placeholder="Please type customer notes here..."></textarea>
                                        </div>
                                        <div class="help-info">Type customer notes </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn waves-classic waves-light btn-small " type="submit">save changes</button>
                                <a href="#!" class="btn modal-close waves-classic waves-light btn-small red darken-4">Cancel</a>
                            </div>
                </div><!--END OF CONTAINER -->
            </form>
        </div><!--END OF MODAL CONTENT -->

    </div>

</div>
