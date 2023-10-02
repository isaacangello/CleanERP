<div>
    <div class="row label-employee-view-edit" >
        <span class="label bg-light-green  label-padding">Personal information</span>
    </div>

    <div class="row clearfix">
        <div class="col s12 m8">
            <div class="form-group">
                <div class="form-line success">
                    <input id="input-crud-customer-name" name="customer-name" type="text" class="form-control" value="{{ $customerName }}">
                    <label class="form-label" for="input-crud-customer-name">Name Customer</label>
                </div>
                <div class="help-info">Insert name customer.</div>
            </div>
        </div>
        <div class=" col s12 m4">
            <div class="form-group">
                <div class="form-line success">
                    <select id="select-crud-customer-type" name="customer-type" >
                        <option selected value="{{ $customerType }}">{{ $customerType }}</option>
                        <option  value="RESIDENCIAL">RESIDENCIAL</option>
                        <option value="COMERCIAL">COMERCIAL</option>
                        <option value="RENTAL_HOUSE">RENTAL HOUSE</option>
                    </select>
                </div>
                <div class="help-info">Select type of customer.</div>
            </div>

        </div>
    </div>

    <div class="row clearfix">
        <div class="col s12 m7">

            <div class="form-group">
                <div class="form-line success">
                    <input type="text" id="input-crud-customer-address" name="customer-address" class="form-control" value="{{$customerAddress}}">
                    <label class="form-label" for="input-crud-customer-address">Address Customer</label>
                </div>
                <div class="help-info">Insert address Customer.</div>
            </div>
        </div>
        <div class="col s12 m5">

            <div class="form-group">
                <div class="form-line success">
                    <input type="text" id="input-crud-customer-address-complement" name="customer-address-complement"   class="form-control" value="{{$customerAddressComplement}}">
                    <label class="form-label" for="input-crud-customer-address-complement">Complement</label>
                </div>
                <div class="help-info">Insert address complement.</div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <input type="text" id="input-crud-customer-phone" name="customer-phone" class="form-control" value="{{$customerPhone}}" >
                    <label class="form-label" for="input-crud-customer-phone">Phone</label>
                </div>
                <div class="help-info">Insert customer phone.</div>
            </div>
        </div>

        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <input type="text" id="input-crud-customer-email" name="customer-email" class="form-control" value="{{$customerEmail}}">
                    <label class="form-label" for="input-crud-customer-email" >Email</label>
                </div>
                <div class="help-info">Insert customer email.</div>
            </div>
        </div>
    </div>
    <div class="row label-employee-view-edit" >
        <span class="label bg-light-green  label-padding">Services information</span>
    </div>


    <div class="row clearfix">
        <div class="col s6 m3">
             <ul class="collection">
              <li class="collection-item">
                <div class="form-group" style="margin:0;padding: 0;">
                    <div class="form-line success">
                        <input type="text" id="input-crud-customer-price-weekly" name="customer-price-weekly" class="form-control" value="{{$customerPriceWeekly}}">
                        <label class="form-label " for="input-crud-customer-price-weekly">Price for weekly.</label>
                    </div>
                </div>
              </li>
              <li class="collection-item">
                 <div class="form-group" style="margin:0;padding: 0;">
                    <div class="form-line success">
                        <input type="text" id="input-crud-customer-price-biweekly" name="customer-price-biweekly" class="form-control" value="{{$customerPriceBiweekly}}">
                        <label class="form-label " for="input-crud-customer-price-biweekly">Price for biweekly.</label>
                    </div>
                 </div>
              </li>
              <li class="collection-item">
                <div class="form-group" style="margin:0;padding: 0;">
                    <div class="form-line success">
                        <input type="text" id="input-crud-customer-price-monthly" name="customer-price-monthly" class="form-control" value="{{$customerPriceMonthly}}">
                        <label class="form-label " for="input-crud-customer-price-monthly">Price for monthly.</label>
                    </div>
                </div>

              </li>
            </ul>
        </div>
        <div class="col s6 m4">
            <label for="textarea-crud-costumer-other-services">Other Services</label>
            <div class="form-group" >
                <div class="form-line success " >
                    <textarea id="textarea-crud-costumer-other-services"
                              name="costumer-other-services"
                              class="form-control custom-textarea"
                              rows="4"
                              placeholder="Other services here..."
                    >{{$costumerOtherServices}}</textarea>
                </div>
                <div class="help-info">Ohter services.</div>
            </div>
        </div>
@php
if (isset($customerStatus)){
    if($customerStatus == 'ACTIVE'){
        $customerStatus2 = 'INACTIVE';
    }else{
        $customerStatus2 = 'ACTIVE';
    }
}else{
    $customerStatus = 'ACTIVE';
    $customerStatus2 = 'INACTIVE';
}
@endphp

        <div class="col s12 m5">
            <div class="form-group">
                <div class="form-line success">
                    <select class="">
                        <option disabled>select status of cutomer</option>
                        <option selected value="{{ $customerStatus }}">{{ $customerStatus }}</option>
                        <option value="{{$customerStatus2}}">{{$customerStatus2}}</option>
                    </select>
                </div>
                <div class="help-info">select status of customer.</div>
            </div>
            <div class="form-group">
                <div class="form-line success">
                    <input type="text"  name="customer-justify-inatctive" id="input-crud-customer-justify-inatctive" class="form-control" value="{{  $customerJustifyInactive }}"/>
                    <label class="form-label" for="input-crud-customer-justify-inatctive">why change customer status ?</label>
                </div>
                <div class="help-info">Why change customer status ?</div>
            </div>
        </div>
    </div>
    <div class="row label-employee-view-edit" >
        <span class="label bg-light-green  label-padding">Additional information</span>
    </div>

    <div class="row clearfix">
        <div class="col s12 m5">
             <div class="checkbox-float">
                <input type="checkbox" id="med-checkbox-keys{{ $count }}" name="customer-keys" value="{{ $customerKeys }}" class="filled-in chk-col-teal"  />
                <label for="med-checkbox-keys{{ $count }}"> Keys in office ?</label>
             </div>
            <div class="checkbox-float">
                <input type="checkbox" id="med-checkbox-drive-licence{{ $count }}" name="customer-drive-licence" value="{{$customerDriveLicence}}" class="filled-in chk-col-teal"   />
                <label for="med-checkbox-drive-licence{{ $count }}" > need driver licence ?</label><br>
            </div>
            <div class="checkbox-float">
                <input type="checkbox" id="med-checkbox-gate-code{{ $count }}" name="customer-gate-code" value="{{$customerGateCode}}" class="filled-in chk-col-teal" />
                <label for="med-checkbox-gate-code{{ $count }}" > need door or gate code ?</label>
            </div>
            <div class="checkbox-float">
                <input type="checkbox" id="med-checkbox-moregirl{{ $count }}" name="customer-moregril" value="{{$customerMoregirl}}" class="filled-in chk-col-teal" />
                <label for="med-checkbox-moregirl{{ $count }}" style="margin-right: 20px;"> more then one girl ?</label>
            </div>
        </div>
        <div class="col s12 m7">
            <label for="textarea-crud-custumer-house-description" >house description</label>
            <div class="form-group">
                <div class="form-line success">
                    <textarea style="padding: 10px; height: 200px"
                              id="textarea-crud-house-description"
                              name="costumer-house-description"
                              class="form-control custom-textarea"
                              placeholder="Please type customer house description here..."
                    >{{$customerHouseDescription}}</textarea>
                </div>
                <div class="help-info">Type house description</div>
            </div>

        </div>
    </div>
    <div class="row clearfix">
        <div class="col s12">
            <label for="textarea-crud-costumer-note">Customer notes</label>
            <div class="form-group">
                <div class="form-line success">
                    <textarea style="padding: 10px;"
                              id="textarea-crud-costumer-note"
                              name="costumer-note"
                              class="form-control custom-textarea"
                              rows="4"
                              placeholder="Please type customer notes here..."
                    >{{$customerNote}}</textarea>
                </div>
                <div class="help-info">Type customer notes.</div>
            </div>
        </div>
    </div>
</div>

