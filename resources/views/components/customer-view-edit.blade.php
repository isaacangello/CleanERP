 <div>
    <div class="row clearfix">
        <div class="col s12 m8">

            <div class="form-group">
                <div class="form-line success">
                    <input id="input-viewedit-customer-name" name="viewedit-customer-name" type="text" class="form-control" value="{{ $vieweditCustomerName }}">
                    <label class="form-label" for="input-viewedit-customer-name">Name Customer</label>
                </div>
                <div class="help-info">Insert name Customer</div>
            </div>
        </div>
        <div class=" col s12 m4">
            <div class="form-group">
                <div class="form-line success">
                    <select id="select-viewedit-customer-type" name="viewedit-customer-type" class="form-control materialize-select">
                        <option disabled>select type of cutomer</option>
                        <option selected value="{{ $vieweditCustomerType }}">{{ $vieweditCustomerType }}</option>
                        <option value="COMERCIAL">RESIDENCIAL</option>
                        <option value="COMERCIAL">COMERCIAL</option>
                        <option value="RENTAL-HOUSE">RENTAL HOUSE</option>
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
                    <input type="text" id="input-viewedit-customer-address" name="viewedit-customer-address" class="form-control" value="{{ $vieweditCustomerAddress }}">
                    <label class="form-label" for="input-viewedit-customer-address">Address Customer</label>
                </div>
                <div class="help-info">Insert address Customer</div>
            </div>
        </div>
        <div class="col s12 m5">

            <div class="form-group">
                <div class="form-line success">
                    <input type="text" id="input-viewedit-customer-address-complement" name="viewedit-customer-address-complement"   class="form-control" value="{{ $vieweditCustomerAddressComplement }}">
                    <label class="form-label" for="input-viewedit-customer-address-complement">Complement</label>
                </div>
                <div class="help-info">Insert address Complement</div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <input type="text" id="input-viewedit-customer-phone" name="viewedit-customer-phone" class="form-control" value="{{ $vieweditCustomerPhone }}" >
                    <label class="form-label" for="input-viewedit-customer-phone">Phone</label>
                </div>
                <div class="help-info">Insert phone </div>
            </div>
        </div>

        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <input type="text" id="input-viewedit-customer-email" name="viewedit-customer-email" class="form-control" value="{{ $vieweditCustomerEmail }}">
                    <label class="form-label" for="input-viewedit-customer-email" >Email</label>
                </div>
                <div class="help-info">Insert email </div>
            </div>
        </div>
    </div>
    <div class="divider clearfix" style="margin: 30px 0px 30px 0px;"></div>

    <div class="row clearfix">
        <div class="col s12 m4">
            <div class="form-group">
                <div class="form-line success">
                    <input type="text" id="input-viewedit-customer-price-weekly" name="viewedit-customer-price-weekly" class="form-control" value="{{ $vieweditCustomerPriceWeekly }}">
                    <label class="form-label " for="input-viewedit-customer-price-weekly">Price for weekly.</label>
                </div>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="form-group">
                <div class="form-line success">
                    <input type="text" id="input-viewedit-customer-price-biweekly" name="viewedit-customer-price-biweekly" class="form-control" value="{{ $vieweditCustomerPriceBiweekly }}">
                    <label class="form-label " for="input-viewedit-customer-price-biweekly">Price for biweekly.</label>
                </div>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="form-group">
                <div class="form-line success">
                    <input type="text" id="input-viewedit-customer-price-monthly" name="viewedit-customer-price-monthly" class="form-control" value="{{ $vieweditCustomerPriceMonthly }}">
                    <label class="form-label " for="input-viewedit-customer-price-monthly">Price for monthly.</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m4">
            <div class="form-group">
                <div class="form-line success">
                    @php
                    if (isset($vieweditCustomerStatus)){
                        if($vieweditCustomerStatus == 'ACTIVE'){
                            $vieweditCustomerStatus2 = 'INACTIVE';
                        }else{
                            $vieweditCustomerStatus2 = 'ACTIVE';
                        }
                    }else{
                        $vieweditCustomerStatus = 'ACTIVE';
                        $vieweditCustomerStatus2 = 'INACTIVE';
                    }
                    @endphp
                    <select id="select-viewedit-customer-status" name="viewedit-customer-status" class="form-control materialize-select">
                        <option disabled>select status of cutomer</option>
                        <option selected value="{{ $vieweditCustomerStatus }}">{{ $vieweditCustomerStatus }}</option>
                        <option value="{{$vieweditCustomerStatus2}}">{{$vieweditCustomerStatus2}}</option>
                    </select>
                </div>
                <div class="help-info">select status of customer</div>
            </div>
        </div>
        <div class="col s12 m8">
            <div class="form-group">
                <div class="form-line success">
                    <input type="text" id="input-viewedit-customer-justify-inactive" name="viewedit-customer-justify-inactive"  class="form-control" value="{{ $vieweditCustomerJustifyInactive }}" >
                    <label class="form-label" for="input-viewedit-customer-justify-inactive">why change customer status ?</label>
                </div>
                <div class="help-info">why change customer status ?</div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col s12 m5">
             <div class="checkbox-float">
                <input type="checkbox" id="md-checkbox-keys{{ $count }}" name="viewedit-customer-keys" class="filled-in chk-col-teal"  {{ $vieweditCustomerKeys }}  />
                <label for="md-checkbox-keys{{ $count }}" class="flow-text" > Keys in office ?   </label>
             </div>
            <div class="checkbox-float">
                <input type="checkbox" id="md-checkbox-drivelicence{{ $count }}" name="viewedit-customer-drivelicence" class="filled-in chk-col-teal" {{ $vieweditCustomerDrivelicence }} />
                <label for="md-checkbox-drivelicence{{ $count }}" class="flow-text" > Need driver licence ?</label><br>
            </div>
            <div class="checkbox-float">
                <input type="checkbox" id="md-checkbox-passkey{{ $count }}" name="viewdit-customer-passkey" class="filled-in chk-col-teal" {{ $viewditCustomerPasskey }}/>
                <label for="md-checkbox-passkey{{ $count }}"  class="flow-text"> Need door or gate code ?</label>
            </div>
            <div class="checkbox-float">
                <input type="checkbox" id="md-checkbox-moregirl{{ $count }}" name="viewedit-customer-moregirl" class="filled-in chk-col-teal" {{ $vieweditCustomerMoregirl }} />
                <label for="md-checkbox-moregirl{{ $count }}" class="flow-text"> More then one girl ?</label>
            </div>
        </div>
        <div class="col s12 m7">
            <label for="textarea-viewedit-custumer-house-description" >House description</label>
            <div class="form-group">
                <div class="form-line success">
                    <textarea id="textarea-viewedit-custumer-house-description" name="viewedit-custumer-house-description" class="form-control  materialize-textarea" rows="4" placeholder="Please type house description here..." >{{ $vieweditCustumerHouseDescription }}</textarea>
                </div>
                <div class="help-info">Type house description</div>
            </div>

        </div>
    </div>
    <div class="row clearfix">
        <div class="col s12">
            <label for="textarea-viewedit-customer-note">type customer notes</label>
            <div class="form-group">
                <div class="form-line success">
                    <textarea  id="textarea-viewedit-customer-note" name="viewedit-customer-note" class="form-control materialize-textarea"  rows="4" placeholder="Please type customer notes  here...">{{ $vieweditCustomerNote }}</textarea>
                </div>
                <div class="help-info">Type customer notes </div>
            </div>
        </div>
    </div>

    <div class="row clearfix align-left">
            <button class="btn-small" type="submit">save changes</button>
            <button class="btn-small red darken-4" type="submit">Delete</button>
    </div>

</div>
