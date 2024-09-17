
<div>
    <form id="form-customer-crud-{{$customer->id}}">
    @php $urlBase = "api/customer/".$customer->id; @endphp

            <!-- ################################################################################################################################-->
    <div class="row label-employee-view-edit" >
        <span class="label bg-light-green  label-padding">Personal information</span>
    </div>
    <!-- ################################################################################################################################-->
    <div class="row clearfix">
        <div class="col s12 m8">
            <div class="form-group">
                <div class="form-line success">
                    <input
                            id="input-crud-customer-name{{$customer->id}}"
                            name="name" type="text"
                            class="form-control listenerChanges"
                            value="{{ $customer->name }}"
                            data-customer-id="{{$customer->id}}"
                            data-url-base="{{ $urlBase }}"
                            data-token="{{ csrf_token() }}"
                    >
                    <label class="form-label" for="input-crud-customer-name{{$customer->id}}">Name Customer</label>
                </div>
                <div class="help-info">Insert name customer.</div>
            </div>
        </div>
        <div class=" col s12 m4">
            <div class="form-group">
                <div class="form-line success">
                    <select
                            class="materialize-select listenerChanges"
                            id="select-crud-customer-type{{$customer->id}}"
                            name="type"
                            data-customer-id="{{$customer->id}}"
                            data-url-base="{{ $urlBase }}"
                            data-token="{{ csrf_token() }}"
                    >
                        <option selected value="{{ $customer->type }}">{{ $customer->type }}</option>
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
                    <input
                            type="text"
                            id="input-crud-customer-address{{$customer->id}}"
                            name="address"
                            class="form-control listenerChanges"
                            value="{{$customer->address}}"
                            data-customer-id="{{$customer->id}}"
                            data-url-base="{{ $urlBase }}"
                            data-token="{{ csrf_token() }}"

                    >
                    <label class="form-label" for="input-crud-customer-address{{$customer->id}}">Address Customer</label>
                </div>
                <div class="help-info">Insert address Customer.</div>
            </div>
        </div>
        <div class="col s12 m5">

            <div class="form-group">
                <div class="form-line success">
                    <input
                            type="text"
                            id="input-crud-customer-address-complement{{$customer->id}}"
                            name="complement"
                            class="form-control listenerChanges"
                            value="{{$customer->complement}}"
                            data-customer-id="{{$customer->id}}"
                            data-url-base="{{ $urlBase }}"
                            data-token="{{ csrf_token() }}"
                    >
                    <label class="form-label" for="input-crud-customer-address-complement{{$customer->id}}">Complement</label>
                </div>
                <div class="help-info">Insert address complement.</div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <input
                            type="text"
                            id="input-crud-customer-phone{{$customer->id}}"
                            name="phone"
                            class="form-control listenerChanges"
                            value="{{$customer->phone}}"
                            data-customer-id="{{$customer->id}}"
                            data-url-base="{{ $urlBase }}"
                            data-token="{{ csrf_token() }}"

                    >
                    <label class="form-label" for="input-crud-customer-phone{{$customer->id}}">Phone</label>
                </div>
                <div class="help-info">Insert customer phone.</div>
            </div>
        </div>

        <div class="col s12 m6">
            <div class="form-group">
                <div class="form-line success">
                    <input
                            type="text"
                            id="input-crud-customer-email{{$customer->id}}"
                            name="email"
                            class="form-control listenerChanges"
                            value="{{$customer->email}}"
                            data-customer-id="{{$customer->id}}"
                            data-url-base="{{ $urlBase }}"
                            data-token="{{ csrf_token() }}"
                    >
                    <label class="form-label" for="input-crud-customer-email{{$customer->id}}" >Email</label>
                </div>
                <div class="help-info">Insert customer email.</div>
            </div>
        </div>
    </div>
    <!-- ################################################################################################################################-->
    <div class="row label-employee-view-edit" >
        <span class="label bg-light-green  label-padding">Billing price</span>
    </div>
    <!-- ################################################################################################################################-->
    <div class="row clearfix">
        <div class="col s12 m12">
            <div class="form-group">
                <div class="form-line-billing-values-selected[]">
                    <label class="form-label m-b-5" for="id-customer-billing{{$customer->id}}">Select billing Prices</label>
                    <select
                            multiple
                            id="id-customer-billing{{$customer->id}}"
                            class="form-control customer-billing"
                            name="billing-values-selected[]"
                            data-customer-id="{{$customer->id}}"
                            data-form-id="form-customer-crud-{{$customer->id}}"
                            data-token="{{ csrf_token() }}"
                    >
                        @php $checked = false; @endphp
                        @foreach($billingsAll as $billings_one)
                            @foreach($customer->billings as $key => $billing)
                                @php
                                    if($billings_one->id == $billing->id){
                                        $checked = true;
                                    }
                                @endphp
                            @endforeach
                                <option @if($checked) {{'selected="selected'}} @endif value='{{$billings_one->id}}'>{{ $billings_one->label.' / '.$billings_one->value }}</option>
                                @php $checked = false; @endphp
                        @endforeach
                    </select>

                <div class="help-info">List of billing options</div>
            </div>
        </div>
        </div>
    </div>
    <!--################################################################################################################################-->
    <div class="row label-employee-view-edit" >
        <span class="label bg-light-green  label-padding">Services information</span>
    </div>
    <!--################################################################################################################################-->
<div class=" row clearfix">
        <div class="col s12 m7">
            <label for="textarea-crud-costumer-other-services{{$customer->id}}">Other Services</label>
            <div class="form-group" >
                <div class="form-line success " >
                    <textarea id="textarea-crud-costumer-other-services{{$customer->id}}"
                              name="other-services"
                              class="form-control custom-textarea listenerChanges"
                              rows="4"
                              placeholder="Other services here..."
                              data-customer-id="{{$customer->id}}"
                              data-url-base="{{ $urlBase }}"
                              data-token="{{ csrf_token() }}"
                    >{{$customer->other_services}}</textarea>
                </div>
                <div class="help-info">Other services.</div>
            </div>
        </div>
@php
if (isset($customer->tatus)){
    if($customer->tatus == 'ACTIVE'){
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
                    <select
                            id="select-customer-status{{$customer->id}}"
                            class="form-control materialize-select listenerChanges"
                            name="status"
                            data-customer-id="{{$customer->id}}"
                            data-url-base="{{ $urlBase }}"
                            data-token="{{ csrf_token() }}"
                    >
                        <option disabled>select status of customer</option>
                        <option selected value="{{ $customerStatus }}">{{ $customerStatus }}</option>
                        <option value="{{$customerStatus2}}">{{$customerStatus2}}</option>
                    </select>
                </div>
                <div class="help-info">select status of customer.</div>
            </div>
            <div class="form-group">
                <div class="form-line success">
                    <input
                            type="text"
                            name="justify-inatctive"
                            id="input-crud-customer-justify-inatctive{{$customer->id}}"
                            class="form-control"
                            value="{!!  $customer->justify_inactive??'' !!}"
                            data-customer-id="{{$customer->id}}"
                            data-url-base="{{ $urlBase }}"
                            data-token="{{ csrf_token() }}"
                    >
                    <label class="form-label" for="input-crud-customer-justify-inatctive{{$customer->id}}">why change customer status ?</label>
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
                 @php if($customer->key === 1) {$customerKeysString = "checked='checked'"; }else{$customerKeysString = ""; }@endphp
                 <label for="med-checkbox-keys{{$customer->id}}{{ $count }}">
                     <input
                             type="checkbox"
                             id="med-checkbox-keys{{$customer->id}}{{ $count }}"
                             name="key"
                             {{ $customerKeysString }}
                             class="filled-in chk-col-teal"
                             data-customer-id="{{$customer->id}}"
                             data-url-base="{{ $urlBase }}"
                             data-token="{{ csrf_token() }}"
                     />
                     <span>Keys in office ?</span>
                 </label>
             </div>
            <div class="checkbox-float">
                @php
                    if($customer->drive_licence === 1){$customerDriveLicenceString= "checked='checked'";}else{$customerDriveLicenceString='';}
                @endphp
                <label for="med-checkbox-drive-licence{{$customer->id}}{{ $count }}" >
                    <input
                            type="checkbox"
                            id="med-checkbox-drive-licence{{$customer->id}}{{ $count }}"
                            name="drive_licence" value="0"  {{$customerDriveLicenceString}}
                            class="filled-in chk-col-teal"
                            data-customer-id="{{$customer->id}}"
                            data-url-base="{{ $urlBase }}"
                            data-token="{{ csrf_token() }}"

                    />
                    <span> need driver licence ?</span>
                </label>
                <br>
            </div>
            <div class="checkbox-float">
                @php if($customer->gate_code  === 1) {$customerGateCodeString = "checked='checked'"; }else{$customerGateCodeString = ""; }@endphp
                <label for="med-checkbox-gate-code{{$customer->id}}{{ $count }}" >
                    <input
                            type="checkbox"
                            id="med-checkbox-gate-code{{$customer->id}}{{ $count }}"
                            name="gate_code" value="0"  {{$customerGateCodeString}}
                            class="filled-in chk-col-teal"
                            data-customer-id="{{$customer->id}}"
                            data-url-base="{{ $urlBase }}"
                            data-token="{{ csrf_token() }}"
                    />
                    <span>need door or gate code ?</span>
                </label>
            </div>
            <div class="checkbox-float">
                @php if($customer->more_girl  === 1) {$customerMoreGirlString = "checked='checked'"; }else{$customerMoreGirlString = ""; }@endphp
                <label for="med-checkbox-moregirl{{$customer->id}}{{ $count }}" style="margin-right: 20px;">
                    <input
                            type="checkbox"
                            id="med-checkbox-moregirl{{$customer->id}}{{ $count }}"
                            name="more_girl" value="0"
                            {{$customerMoreGirlString}}
                            class="filled-in chk-col-teal"
                            data-customer-id="{{$customer->id}}"
                            data-url-base="{{ $urlBase }}"
                            data-token="{{ csrf_token() }}"
                    />
                    <span>more then one girl ?</span>
                </label>
            </div>
        </div>
        <div class="col s12 m7">
            <label for="textarea-crud-house-description{{$customer->id}}" >house description</label>
            <div class="form-group">
                <div class="form-line success">
                    <textarea style="padding: 10px; height: 200px"
                              id="textarea-crud-house-description{{$customer->id}}"
                              name="house_description"
                              class="form-control custom-textarea"
                              placeholder="Please type customer house description here..."
                              data-customer-id="{{$customer->id}}"
                              data-url-base="{{ $urlBase }}"
                              data-token="{{ csrf_token() }}"

                    >{{$customer->house_descritpion}}</textarea>
                </div>
                <div class="help-info">Type house description</div>
            </div>

        </div>
    </div>
    <div class="row clearfix">
        <div class="col s12">
            <label for="textarea-crud-costumer-note{{$customer->id}}">Customer notes</label>
            <div class="form-group">
                <div class="form-line success">
                    <textarea style="padding: 10px;"
                              id="textarea-crud-costumer-note{{$customer->id}}"
                              name="note"
                              class="form-control custom-textarea"
                              rows="4"
                              placeholder="Please type customer notes here..."
                              data-customer-id="{{$customer->id}}"
                              data-url-base="{{ $urlBase }}"
                              data-token="{{ csrf_token() }}"
                    >{{$customer->note}}</textarea>
                </div>
                <div class="help-info">Type customer notes.</div>
            </div>
        </div>
    </div>
    </form>
</div>


