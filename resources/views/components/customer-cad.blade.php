<div>

<!-- ############  Modal Structure ###########################################################################################-->
    <div id="new-customer" class="modal bottom-sheet">
        <div class="modal-content">
            <form id="customerFormCad" action="{{ route('customers.store') }}" method="post" >
                @csrf
                <input type="hidden" value="ACTIVE" name="status">
                <div class="container z-depth-3" style="width: 95%">
                            <div class="row clearfix">
                                <div class="col s12 m8">
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <input id="input-cad-customer-name" name="name" type="text" class="form-control" value="{{ old('name') }}">
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
                                                @php if(!empty(old("type"))){echo"<option value='".old("type")."'>".old("type")."</option>";}@endphp
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
                                            <input type="text" id="input-cad-customer-address" name="address" class="form-control" value="{{ old("address") }}">
                                            <label class="form-label" for="input-cad-customer-address">Address Customer</label>
                                        </div>
                                        <div class="help-info">Insert address Customer</div>
                                    </div>
                                </div>
                                <div class="col s12 m5">

                                    <div class="form-group">
                                        <div class="form-line success">
                                            <input type="text" id="input-cad-customer-address-complement" name="complement"   class="form-control" value="{{ old('complement') }}">
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
                                            <input type="text" id="input-cad-customer-phone" name="phone" class="form-control" value="{{ old('phone') }}" >
                                            <label class="form-label" for="input-cad-customer-phone">Phone</label>
                                        </div>
                                        <div class="help-info">Insert phone </div>
                                    </div>
                                </div>

                                <div class="col s12 m6">
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <input type="text" id="input-cad-customer-email" name="email" class="form-control" value="{{ old('email') }}">
                                            <label class="form-label" for="input-cad-customer-email" >Email</label>
                                        </div>
                                        <div class="help-info">Insert email</div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider clearfix" style="margin: 30px 0 30px 0;"></div>

                            <div class="row clearfix">
                                <div class="col s12 m8">
                                    <label for="textarea-cad-costumer-other-services">Other Services</label>
                                    <div class="form-group" >
                                        <div class="form-line success " >
                                            <textarea id="textarea-cad-costumer-other-services" name="other_services"  class="form-control custom-textarea"  rows="4" placeholder="Other services here...">{{ old('other_services') }}</textarea>

                                        </div>
                                        <div class="help-info">Ohter Services</div>
                                    </div>
                                </div>

                                <div class="col s12 m4">
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <select id="select-cad-service-frequency" name="frequency">
                                                @php if(!empty(old("frequency"))){
                                                        switch (old("frequency")){
                                                            case'One': $string_val = "Eventual" ;break;
                                                            case'Wek':$string_val = "Weekly";break;
                                                            case'Biw':$string_val = "Biweekly";break;
                                                            case'Mon':$string_val = "Monthly";break;
                                                        }
                                                        echo"<option value='".old("frequency")."'>".$string_val."</option>";
                                                    }
                                                @endphp
                                                <option selected value="One">Eventual</option>
                                                <option  value="Wek">Weekly</option>
                                                <option  value="Biw">Biweekly</option>
                                                <option  value="Mon">Monthly</option>
                                            </select>
                                            <label class="form-label"  for="select-cad-service-frequency">Service frequency.</label>
                                        </div>
                                        <div class="help-info">Select the service execution frequency.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col s12 m3">
                                    <ul class="collection">
                                        <li class="collection-item">
                                            <div class="form-group" style="margin:0;padding: 0;">
                                                <div class="form-line success">
                                                    <input type="text" id="input-cad-customer-price-weekly" name="price_weekly" class="form-control" value="{{ old('price_weekly') }}">
                                                    <label class="form-label " for="input-cad-customer-price-weekly">Price for weekly.</label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="collection-item">
                                            <div class="form-group" style="margin:0;padding: 0;">
                                                <div class="form-line success">
                                                    <input type="text" id="input-cad-customer-price-biweekly" name="price_biweekly" class="form-control" value="{{ old('price_biweekly') }}">
                                                    <label class="form-label " for="input-cad-customer-price-biweekly">Price for biweekly.</label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="collection-item">
                                            <div class="form-group" style="margin:0;padding: 0;">
                                                <div class="form-line success">
                                                    <input type="text" id="input-cad-customer-price-monthly" name="price_monthly" class="form-control" value="{{ old('price_monthly') }}">
                                                    <label class="form-label " for="input-cad-customer-price-monthly">Price for monthly.</label>
                                                </div>
                                            </div>

                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <div class="row clearfix">
                                <div class="col s12 m5">
                                     <div class="checkbox-float">
                                         <label for="md-checkbox-keys">
                                             @php if(old('key')) {$customerKeysString = "checked='checked'"; }else{$customerKeysString = ""; }@endphp
                                            <input type="checkbox" id="md-checkbox-keys" name="key" {{ $customerKeysString }}  class="filled-in chk-col-teal"  />
                                             <span> Keys in office ?</span>
                                         </label>
                                     </div>
                                    <div class="checkbox-float">
                                        <label for="md-checkbox-drive-licence" >
                                            @php
                                                if(old('drive_licence')){$customerDriveLicenceString= "checked='checked'";}else{$customerDriveLicenceString='';}
                                            @endphp
                                            <input type="checkbox" id="md-checkbox-drive-licence" name="drive_licence" {{ $customerDriveLicenceString }}  class="filled-in chk-col-teal"   />
                                            <span> Need driver licence ?</span>
                                        </label>
                                        <br>
                                    </div>
                                    <div class="checkbox-float">
                                        <label for="md-checkbox-gate-code">
                                            @php if(old('gate_code')) {$customerGateCodeString = "checked='checked'"; }else{$customerGateCodeString = ""; }@endphp
                                            <input type="checkbox" id="md-checkbox-gate-code" name="gate_code"  {{ $customerGateCodeString }} class="filled-in chk-col-teal" />
                                            <span> Need door or gate code ?</span>
                                        </label>
                                    </div>
                                    <div class="checkbox-float">
                                        <label for="md-checkbox-more-girl" style="margin-right: 20px;">
                                            @php if(old('more_girl')) {$customerMoreGirlString = "checked='checked'"; }else{$customerMoreGirlString = ""; }@endphp
                                            <input type="checkbox" id="md-checkbox-more-girl" name="more_girl" {{ $customerMoreGirlString }}  class="filled-in chk-col-teal" />
                                            <span>More then one girl ?</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col s12 m7">
                                    <label for="textarea-cad-customer-house-description" >House description.</label>
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <textarea style="padding: 10px; height: 200px"  id="textarea-cad-customer-house-description" name="house_description" class="form-control custom-textarea"   placeholder="Please type customer house description here...">{{ old('house_description') }}</textarea>
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
                                            <textarea style="padding: 10px;"  id="textarea-cad-costumer-note" name="note"  class="form-control custom-textarea"  rows="4" placeholder="Please type customer notes here...">{{ old('note') }}</textarea>
                                        </div>
                                        <div class="help-info">Type customer notes </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn waves-classic waves-light btn-small" id="btnCadCustomer" type="submit">save changes</button>
                                <a href="#!" class="btn modal-close waves-classic waves-light btn-small red darken-4">Cancel</a>
                            </div>
                </div><!--END OF CONTAINER -->
            </form>
        </div><!--END OF MODAL CONTENT -->

    </div>

</div>
