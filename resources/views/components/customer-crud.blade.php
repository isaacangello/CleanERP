<div>
    <div class="row label-employee-view-edit" >
        <span class="label bg-light-green  label-padding">Personal information</span>
    </div>
    @php $urlBase = "api/customer/".$customerId; @endphp
    <div class="row clearfix">
        <div class="col s12 m8">
            <div class="form-group">
                <div class="form-line success">
                    <input id="input-crud-customer-name{{$customerId}}" name="name" onchange="field_change(this,'{{ $urlBase }}','{{ csrf_token() }}')" type="text" class="form-control" value="{{ $customerName }}">
                    <label class="form-label" for="input-crud-customer-name{{$customerId}}">Name Customer</label>
                </div>
                <div class="help-info">Insert name customer.</div>
            </div>
        </div>
        <div class=" col s12 m4">
            <div class="form-group">
                <div class="form-line success">
                    <select id="select-crud-customer-type{{$customerId}}" name="type" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')">
                        <option selected value="{{ $customerType }}">{{ $customerType }}</option>
                        <option  value="RESIDENCIAL">RESIDENCIAL</option>
                        <option value="COMMERCIAL">COMERCIAL</option>
                        <option value="RENTALHOUSE">RENTAL HOUSE</option>
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
                    <input type="text" id="input-crud-customer-address{{$customerId}}" name="address" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" class="form-control" value="{{$customerAddress}}" >
                    <label class="form-label" for="input-crud-customer-address{{$customerId}}">Address Customer</label>
                </div>
                <div class="help-info">Insert address Customer.</div>
            </div>
        </div>
        <div class="col s12 m5">

            <div class="form-group">
                <div class="form-line success">
                    <input type="text" id="input-crud-customer-address-complement{{$customerId}}" name="complement" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')"  class="form-control" value="{{$customerAddressComplement}}">
                    <label class="form-label" for="input-crud-customer-address-complement{{$customerId}}">Complement</label>
                </div>
                <div class="help-info">Insert address complement.</div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <input type="text" id="input-crud-customer-phone{{$customerId}}" name="phone" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" class="form-control" value="{{$customerPhone}}" >
                    <label class="form-label" for="input-crud-customer-phone{{$customerId}}">Phone</label>
                </div>
                <div class="help-info">Insert customer phone.</div>
            </div>
        </div>

        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <input type="text" id="input-crud-customer-email{{$customerId}}" name="email" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" class="form-control" value="{{$customerEmail}}">
                    <label class="form-label" for="input-crud-customer-email{{$customerId}}" >Email</label>
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
                        <input type="text" id="input-crud-customer-price-weekly{{$customerId}}" name="price-weekly" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" class="form-control" value="{{$customerPriceWeekly}}">
                        <label class="form-label " for="input-crud-customer-price-weekly{{$customerId}}">Price for weekly.</label>
                    </div>
                </div>
              </li>
              <li class="collection-item">
                 <div class="form-group" style="margin:0;padding: 0;">
                    <div class="form-line success">
                        <input type="text" id="input-crud-customer-price-biweekly{{$customerId}}" name="price-biweekly" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" class="form-control" value="{{$customerPriceBiweekly}}">
                        <label class="form-label " for="input-crud-customer-price-biweekly{{$customerId}}">Price for biweekly.</label>
                    </div>
                 </div>
              </li>
              <li class="collection-item">
                <div class="form-group" style="margin:0;padding: 0;">
                    <div class="form-line success">
                        <input type="text" id="input-crud-customer-price-monthly{{$customerId}}" name="price-monthly" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" class="form-control" value="{{$customerPriceMonthly}}">
                        <label class="form-label " for="input-crud-customer-price-monthly{{$customerId}}">Price for monthly.</label>
                    </div>
                </div>

              </li>
            </ul>
        </div>
        <div class="col s6 m4">
            <label for="textarea-crud-costumer-other-services{{$customerId}}">Other Services</label>
            <div class="form-group" >
                <div class="form-line success " >
                    <textarea id="textarea-crud-costumer-other-services{{$customerId}}"
                              name="other-services"
                              class="form-control custom-textarea"
                              rows="4"
                              placeholder="Other services here..."
                              onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')"
                    >{{$customerOtherServices}}</textarea>
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
                    <select id="select-customer-status{{$customerId}}" class="form-control" name="status" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')">
                        <option disabled>select status of customer</option>
                        <option selected value="{{ $customerStatus }}">{{ $customerStatus }}</option>
                        <option value="{{$customerStatus2}}">{{$customerStatus2}}</option>
                    </select>
                </div>
                <div class="help-info">select status of customer.</div>
            </div>
            <div class="form-group">
                <div class="form-line success">
                    <input type="text"  name="justify-inatctive" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" id="input-crud-customer-justify-inatctive{{$customerId}}" class="form-control" value="{!!  $customerJustifyInactive !!}"/>
                    <label class="form-label" for="input-crud-customer-justify-inatctive{{$customerId}}">why change customer status ?</label>
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
                 @php if($customerKeys === 1) {$customerKeysString = "checked='checked'"; }else{$customerKeysString = ""; }@endphp
                 <label for="med-checkbox-keys{{$customerId}}{{ $count }}">
                     <input type="checkbox" id="med-checkbox-keys{{$customerId}}{{ $count }}" name="key" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" {{ $customerKeysString }} class="filled-in chk-col-teal"  />
                     <span>Keys in office ?</span>
                 </label>
             </div>
            <div class="checkbox-float">
                @php
                    if($customerDriveLicence === 1){$customerDriveLicenceString= "checked='checked'";}else{$customerDriveLicenceString='';}
                @endphp
                <label for="med-checkbox-drive-licence{{$customerId}}{{ $count }}" >
                    <input type="checkbox" id="med-checkbox-drive-licence{{$customerId}}{{ $count }}" name="drive_licence" value="0" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" {{$customerDriveLicenceString}} class="filled-in chk-col-teal"   />
                    <span> need driver licence ?</span>
                </label>
                <br>
            </div>
            <div class="checkbox-float">
                @php if($customerGateCode  === 1) {$customerGateCodeString = "checked='checked'"; }else{$customerGateCodeString = ""; }@endphp
                <label for="med-checkbox-gate-code{{$customerId}}{{ $count }}" >
                    <input type="checkbox" id="med-checkbox-gate-code{{$customerId}}{{ $count }}" name="gate_code" value="0" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" {{$customerGateCodeString}} class="filled-in chk-col-teal" />
                    <span>need door or gate code ?</span>
                </label>
            </div>
            <div class="checkbox-float">
                @php if($customerMoreGirl  === 1) {$customerMoreGirlString = "checked='checked'"; }else{$customerMoreGirlString = ""; }@endphp
                <label for="med-checkbox-moregirl{{$customerId}}{{ $count }}" style="margin-right: 20px;">
                    <input type="checkbox" id="med-checkbox-moregirl{{$customerId}}{{ $count }}" name="more_girl" value="0" onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')" {{$customerMoreGirlString}} class="filled-in chk-col-teal" />
                    <span>more then one girl ?</span>
                </label>
            </div>
        </div>
        <div class="col s12 m7">
            <label for="textarea-crud-house-description{{$customerId}}" >house description</label>
            <div class="form-group">
                <div class="form-line success">
                    <textarea style="padding: 10px; height: 200px"
                              id="textarea-crud-house-description{{$customerId}}"
                              name="house_description"
                              class="form-control custom-textarea"
                              placeholder="Please type customer house description here..."
                              onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')"
                    >{{$customerHouseDescription}}</textarea>
                </div>
                <div class="help-info">Type house description</div>
            </div>

        </div>
    </div>
    <div class="row clearfix">
        <div class="col s12">
            <label for="textarea-crud-costumer-note{{$customerId}}">Customer notes</label>
            <div class="form-group">
                <div class="form-line success">
                    <textarea style="padding: 10px;"
                              id="textarea-crud-costumer-note{{$customerId}}"
                              name="note"
                              class="form-control custom-textarea"
                              rows="4"
                              placeholder="Please type customer notes here..."
                              onchange="field_change(this,'{{$urlBase}}','{{ csrf_token() }}')"
                    >{{$customerNote}}</textarea>
                </div>
                <div class="help-info">Type customer notes.</div>
            </div>
        </div>
    </div>
</div>

