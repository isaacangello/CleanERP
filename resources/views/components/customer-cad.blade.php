<div>

<!-- ############  Modal Structure ###########################################################################################-->
    <div id="new-customer" class="modal bottom-sheet">
        <div class="modal-content">

            <div class="container z-depth-3" style="width: 95%">
                    <h2 >CUSTOMER REGISTER</h2>
                <div class="divider clearfix" style="margin: 20px 0px 20px 0px;"></div>
                        <div class="row clearfix">
                            <div class="col s12 m8">

                                <div class="form-group">
                                    <div class="form-line success">
                                        <input id="input-cad-customer-name" name="cad-customer-name" type="text" class="form-control" value="">
                                        <label class="form-label" for="input-cad-customer-name">Name Customer</label>
                                    </div>
                                    <div class="help-info">Insert name Customer</div>
                                </div>
                            </div>
                            <div class=" col s12 m4">
                                <div class="form-group">
                                    <div class="form-line success">
                                        <select id="select-cad-customer-type" name="cad-customer-type" class="form-control">
                                            <option disabled>select type of cutomer</option>
                                            <option selected value="RESIDENCIAL">RESIDENCIAL</option>
                                            <option value="COMERCIAL">COMERCIAL</option>
                                            <option value="RENTAL_HOUSE">RENTAL HOUSE</option>
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
                                        <input type="text" id="input-cad-customer-address" name="cad-customer-address" class="form-control" value="">
                                        <label class="form-label" for="input-cad-customer-address">Address Customer</label>
                                    </div>
                                    <div class="help-info">Insert address Customer</div>
                                </div>
                            </div>
                            <div class="col s12 m5">

                                <div class="form-group">
                                    <div class="form-line success">
                                        <input type="text" id="input-cad-customer-address-complement" name="cad-customer-address-complement"   class="form-control" value="">
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
                                        <input type="text" id="input-cad-customer-phone" name="cad-customer-phone" class="form-control" value="" >
                                        <label class="form-label" for="input-cad-customer-phone">Phone</label>
                                    </div>
                                    <div class="help-info">Insert phone </div>
                                </div>
                            </div>

                            <div class="col s12 m6">
                                <div class="form-group">
                                    <div class="form-line success">
                                        <input type="text" id="input-cad-customer-email" name="cad-customer-email" class="form-control" value="">
                                        <label class="form-label" for="input-cad-customer-email" >Email</label>
                                    </div>
                                    <div class="help-info">Insert email </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider clearfix" style="margin: 30px 0px 30px 0px;"></div>

                        <div class="row clearfix">
                            <div class="col s12 m2">
                                 <ul class="collection">
                                  <li class="collection-item">
                                    <div class="form-group" style="margin:0;padding: 0;">
                                        <div class="form-line success">
                                            <input type="text" id="input-cad-customer-price-weekly" name="cad-customer-price-weekly" class="form-control" value="">
                                            <label class="form-label " for="input-cad-customer-price-weekly">Price for weekly.</label>
                                        </div>
                                    </div>
                                  </li>
                                  <li class="collection-item">
                                     <div class="form-group" style="margin:0;padding: 0;">
                                        <div class="form-line success">
                                            <input type="text" id="input-cad-customer-price-biweekly" name="cad-customer-price-biweekly" class="form-control" value="">
                                            <label class="form-label " for="input-cad-customer-price-biweekly">Price for biweekly.</label>
                                        </div>
                                     </div>
                                  </li>
                                  <li class="collection-item">
                                    <div class="form-group" style="margin:0;padding: 0;">
                                        <div class="form-line success">
                                            <input type="text" id="input-cad-customer-price-monthly" name="cad-customer-price-monthly" class="form-control" value="">
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
                                        <textarea id="textarea-cad-costumer-other-services" name="cad-costumer-other-services"  class="form-control custom-textarea"  rows="4" placeholder="Other services here..."></textarea>
                                    </div>
                                    <div class="help-info">Ohter services </div>
                                </div>
                            </div>

                            <div class="col s12 m5">
                                <div class="form-group">
                                    <div class="form-line success">
                                        <select class="form-control">
                                            <option disabled>select status of cutomer</option>
                                            <option selected>ACTIVE</option>
                                            <option>INACTIVE</option>
                                        </select>
                                    </div>
                                    <div class="help-info">select status of customer</div>
                                </div>
                                <div class="form-group">
                                    <div class="form-line success">
                                        <input type="text"  name="cad-customer-justify-inatctive" id="input-cad-customer-justify-inatctive" class="form-control" />
                                        <label class="form-label" for="input-cad-customer-justify-inatctive">why change customer status ?</label>
                                    </div>
                                    <div class="help-info">why change customer status ?</div>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="row">
                            <div class="col s12 m4">
                                <div class="form-group">
                                    <div class="form-line success">
                                        <select class="form-control">
                                            <option disabled>select status of cutomer</option>
                                            <option selected>ACTIVE</option>
                                            <option>INACTIVE</option>
                                        </select>
                                    </div>
                                    <div class="help-info">select status of customer</div>
                                </div>
                            </div>
                            <div class="col s12 m8">
                                <div class="form-group">
                                    <div class="form-line success">
                                        <input type="text"  name="cad-customer-justify-inatctive" id="input-cad-customer-justify-inatctive" class="form-control" />
                                        <label class="form-label" for="input-cad-customer-justify-inatctive">why change customer status ?</label>
                                    </div>
                                    <div class="help-info">why change customer status ?</div>
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="row clearfix">
                            <div class="col s12 m5">
                                 <div class="checkbox-float">
                                    <input type="checkbox" id="md-checkbox-keys" name="cad-customer-keys" class="filled-in chk-col-teal"  />
                                    <label for="md-checkbox-keys"> Keys in office ?</label>
                                 </div>
                                <div class="checkbox-float">
                                    <input type="checkbox" id="md-checkbox-drivelicence" name="cad-customer-drivlicence" class="filled-in chk-col-teal"  />
                                    <label for="md-checkbox-drivelicence" > need driver licence ?</label><br>
                                </div>
                                <div class="checkbox-float">
                                    <input type="checkbox" id="md-checkbox-passkey" name="cad_customer-passkey" class="filled-in chk-col-teal" />
                                    <label for="md-checkbox-passkey" > need door or gate code ?</label>
                                </div>
                                <div class="checkbox-float">
                                    <input type="checkbox" id="md-checkbox-moregirl" name="cad_customer-moregril" class="filled-in chk-col-teal" />
                                    <label for="md-checkbox-moregirl" style="margin-right: 20px;"> more then one girl ?</label>
                                </div>
                            </div>
                            <div class="col s12 m7">
                                <label for="textarea-cad-custumer-house-description" >house description</label>
                                <div class="form-group">
                                    <div class="form-line sucess">
                                    </div>
                                    <div class="help-info">Type house description</div>
                                </div>

                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col s12">
                                <label for="textarea-cad-costumer-note">type customer notes</label>
                                <div class="form-group">
                                    <div class="form-line success">
                                        <textarea style="padding: 10px;"  id="textarea-cad-costumer-note" name="cad-costumer-note" class="form-control custom-textarea"  rows="4" placeholder="Please type customer notes here..."></textarea>
                                    </div>
                                    <div class="help-info">Type customer notes </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn waves-effect waves-light btn-small " type="submit">save changes</button>
                            <a href="#!" class="btn modal-close waves-effect waves-light btn-small red darken-4">Cancel</a>
                        </div>
                    </div><!--END OF CONTAINER -->

        </div><!--END OF MODAL CONTENT -->
    </div>
</div>
