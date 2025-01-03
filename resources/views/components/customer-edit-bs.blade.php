@props(['showCustomerEdit' => false , 'formType' => "EDIT", 'customer', 'billings' , 'name' => 'EditCustomer', ])
<div>
@php
    if($this->formType === 'CREATE'){
        $formType = 'CREATE';
    }
    elseif($this->formType === 'EDIT'){
        $formType = 'EDIT';
    }
@endphp
    <div id="edit-fcustomer" class="modal-default bottom-sheet"
                 x-init="$watch('showCustomerEdit', value => {
                if (value) {
                    document.body.classList.add('overflow-y-hidden');
                    {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
                } else {
                    document.body.classList.remove('overflow-y-hidden');
                }
            })"

         x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
         x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
         x-on:close.stop="showCustomerEdit = false"
         x-on:keydown.escape.window="showCustomerEdit = false"
         x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
         x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
         style="display: {{ $showCustomerEdit ? 'block' : 'none' }};"
         x-show="showCustomerEdit"
         x-transition:enter="animate__animated animate__slideInUp animate__faster"
         x-transition:leave="animate__animated animate__slideOutDown animate__faster"

    >
        <div class="modal-content modal-content-bs modal-col-white">
            <div class="container">

                <div class="modal-content">
                    <form

                            @if($formType === 'CREATE')
                                id="customer-form-create" wire:submit.prevent="saveNewCustomer()"
                            @keydown.enter.prevent="$wire.saveNewCustomer()"
                            @else
                                id="customer-form-edit" wire:submit.prevent="updateCustomer({{$this->customer->id??0}})"
                                @keydown.enter.prevent="$wire.updateCustomer({{$this->customer->id??0}})"
                            @endif
                            @if($formType === 'EDIT')
                                id="customer-form-edit" wire:submit.prevent="updateCustomer({{$this->customer->id??0}})"
                                @keydown.enter.prevent="$wire.updateCustomer({{$this->customer->id??0}})"
                            @endif
                    >
                        <div class="container " style="width: 95%">
                            <div class="row">
                                <div class="col s12 text-start ">
                                    <h5 class="m-0 p-0 text-start font-bold relative right-2">
                                        @if($formType === 'CREATE')
                                            New Customer
                                        @endif
                                        @if($formType === 'EDIT')
                                            Edit Customer
                                        @endif
                                    </h5>
                                </div>
                            </div>

                            <div class="row label-employee-view-edit">
                                <span class="label label-padding">Personal Information</span>
                            </div>
                            <div class="row clearfix">
                                <div class="col s12 m8">
                                    <div class="form-group">
                                        <label class="form-label" for="input-edit-customer-name">Customer Name</label>
                                        <div class="form-line success form-line-name">
                                            <input id="input-edit-customer-name" wire:model="fcustomer.name" type="text" class="form-control @error('fcustomer.name') bg-red-100 @enderror"/>

                                        </div>
                                        @error('fcustomer.name')
                                        <div class="help-info-no-color text-red-800">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('fcustomer.name') hide @enderror">Insert customer name</div>
                                    </div>
                                </div>
                                <div class="col s12 m4">
                                    <div class="form-group">
                                        <label class="form-label" for="select-edit-customer-type">Customer Type</label>
                                        <div class="form-line success form-line-type">
                                            <select
                                                    class="block text-gray-600    border-t-0 border-b border-x-0 border-gray-300  shadow-sm h-45  text-left cursor-default @error('fcustomer.type') bg-red-100   @enderror
                                                    focus:outline-none focus:ring-0  focus:border-t-0 focus:border-b focus:border-x-0  focus:border-green-800 sm:text-sm"
                                                    wire:model="fcustomer.type"
                                                    id="select-edit-customer-type"
                                            >
                                                <option value="">Select an option</option>
                                                <option   value="RESIDENTIAL">Residential</option>
                                                <option   value="COMMERCIAL">Commercial</option>
                                                <option   value="RENTALHOUSE">Rental House</option>
                                            </select>

                                        </div>
                                        @error('fcustomer.type')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('fcustomer.type') hide @enderror">Select customer type</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col s12 m7">
                                    <div class="form-group">
                                        <div class="form-line success form-line-address">
                                            <input type="text" wire:model="fcustomer.address" id="input-edit-customer-address" class="form-control @error('fcustomer.address') bg-red-100 @enderror">
                                            <label class="form-label" for="input-edit-customer-address">Customer Address</label>
                                        </div>
                                        @error('fcustomer.address')
                                        <div class="help-info-no-color text-red-800">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('fcustomer.address') hide @enderror">Insert customer address</div>
                                    </div>
                                </div>
                                <div class="col s12 m5">
                                    <div class="form-group">
                                        <div class="form-line success form-line-complement">
                                            <input type="text" wire:model="fcustomer.complement" id="input-edit-customer-address-complement" class="form-control">
                                            <label class="form-label" for="input-edit-customer-address-complement">Complement</label>
                                        </div>
                                        @error('fcustomer.complement')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('fcustomer.complement') hide @enderror">Insert address complement</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col s12 m6">
                                    <div class="form-group">
                                        <div class="form-line success form-line-phone">
                                            <input type="text" wire:model="fcustomer.phone" id="input-edit-customer-phone" class="form-control">
                                            <label class="form-label" for="input-edit-customer-phone">Phone</label>
                                        </div>
                                        @error('fcustomer.phone')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('fcustomer.phone') hide @enderror">Insert customer phone</div>
                                    </div>
                                </div>
                                <div class="col s12 m6">
                                    <div class="form-group">
                                        <div class="form-line success form-line-email">
                                            <input type="text" wire:model="fcustomer.email" id="input-edit-customer-email" class="form-control">
                                            <label class="form-label" for="input-edit-customer-email">Email</label>
                                        </div>
                                        @error('fcustomer.email')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('fcustomer.email') hide @enderror">Insert customer email</div>
                                    </div>
                                </div>
                            </div>
                            @isset($this->customer->type)
                            @if($this->customer->type == "COMMERCIAL" )
                                <div class="row clearfix">
                                    <div class="col s12">
                                        <label for="textarea-edit-customer-note">Other Emails</label>
                                        <div class="form-group">
                                            <div class="form-line success">
                                                <textarea wire:model="fcustomer.others_emails" id="textarea-edit-customer-note" class="form-control custom-textarea" rows="4" placeholder="Type customer other_emails here..."></textarea>
                                            </div>
                                            @error('fcustomer.others_emails')
                                            <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                            @enderror
                                            <div class="help-info @error('fcustomer.others_emails') hide @enderror">Type customer notes</div>
                                        </div>
                                    </div>
                                </div>

                            @endif

                            @if( $this->customer->type  === "RESIDENTIAL" or $this->customer->type  === "RENTALHOUSE")
                            <div class="row label-employee-view-edit">
                                <span class="label label-padding">Billing Price</span>
                            </div>
                            <div class="row clearfix">
                                <div class="col s12 m6 offset-m3">
                                    <div class="form-group">
                                        <label class="form-label mb-5" for="id-customer-billing-edit">Select billing prices</label>
                                        <div>

{{--                                            <select x-data="multiselect" multiple  wire:model="fcustomer.billing_values_selected" id="id-customer-billing-edit">--}}
{{--                                                @foreach($billings as $billing)--}}
{{--                                                    <option value="{{ $billing->id }}" data-search="{{ $billing->label."-".$billing->value }} " title="{{ $billing->label }}">{{ $billing->label }} / {{ $billing->value }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
                                            @php
//                                                $billings = $billings->toArray();
//                                                $billings = array_map(function($billing){
//                                                    return $billing['label']."-".$billing['value'];
//                                                }, $billings);
//                                                dd($billings);
                                            @endphp
                                            <div class="max-w-md mx-auto" x-data="multiSelectAlpine()">
                                                <div class="relative">
{{--                                                    <label for="multi-select" class="block text-sm font-medium text-gray-700 mb-1">Select options:</label>--}}

                                                    <div class="mt-1 relative">
                                                        <button type="button" @click="selectOpen = !selectOpen" class="relative w-full h-45 bg-white border border-gray-300  shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-green-800 focus:border-green-800 sm:text-sm">
                                                            <span class="block truncate text-gray-600"
                                                                  x-text="selectedOptions.length ? joinSelectedValues() : 'Select options'"
                                                            >
                                                            </span>
                                                            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                     fill="currentColor" aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                          d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                                          clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        </button>

                                                        <div x-show="selectOpen" @click.away="selectOpen = false"
                                                             class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60  py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                                                             style="display: none;">
                                                            <template x-for="option in options" :key="option.id">
                                                                <div @click="toggleOption(option.id);toggleValues(option.value)"
                                                                     class="cursor-pointer select-none relative py-2 pl-3 pr-9 text-gray-600 hover:bg-green-800 hover:text-white">
                                                                    <span x-text="option.label+' / '+option.value" :class="{ 'font-semibold': selectedOptions.includes(option.id) }" class="block truncate"></span>
                                                                    <span x-show="selectedOptions.includes(option.id)" class="absolute inset-y-0 right-0 flex items-center pr-4 text-green-800 hover:text-white">
                                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                         fill="currentColor">
                                                                        <path fill-rule="evenodd"
                                                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                              clip-rule="evenodd" />
                                                                    </svg>
                                                                    </span>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <x-javascript-select-alpine />

                                        </div>

                                        @error('fcustomer.billing_values_selected')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('fcustomer.billing_values_selected') hide @enderror">List of billing options</div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endisset
                            <div class="row label-employee-view-edit">
                                <span class="label label-padding">Service Information</span>
                            </div>

                            <div class="row clearfix">
                                <div class="col s12 m7">
                                    <label for="textarea-edit-customer-other-services">Other Services</label>
                                    <div class="form-group">
                                        <div class="form-line success form-line-other-services">
                                            <textarea wire:model="fcustomer.other_services" id="textarea-edit-customer-other-services" class="form-control custom-textarea" rows="4" placeholder="Other services here..."></textarea>
                                        </div>
                                        @error('fcustomer.other_services')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('fcustomer.other_services') hide @enderror">Other services</div>
                                    </div>
                                </div>
                                <div class="col s12 m5">
                                    <div class="form-group">
                                        <label class="form-label" for="select-edit-service-frequency">Service Frequency</label>
                                        <div class="form-line success form-line-frequency">
                                            <select wire:model="fcustomer.frequency" class="block text-gray-600  bg-white border border-gray-300  shadow-sm h-45  text-left cursor-default focus:outline-none focus:ring-1 focus:ring-green-800 focus:border-green-800 sm:text-sm" id="select-edit-service-frequency">
                                                <option @if(isset($this->customer->frequency) and $this->customer->frequency === "ONE" ) selected="selected" @endif value="ONE">Eventual</option>
                                                <option @if(isset($this->customer->frequency) and $this->customer->frequency === "WEK") selected="selected" @endif value="WEK">Weekly</option>
                                                <option @if(isset($this->customer->frequency) and $this->customer->frequency === "BIW") selected="selected" @endif value="BIW">Biweekly</option>
                                                <option @if(isset($this->customer->frequency) and $this->customer->frequency === "TRH") selected="selected" @endif value="TRH">Three-weekly</option>
                                                <option @if(isset($this->customer->frequency) and $this->customer->frequency === "MON") selected="selected" @endif value="MON">Monthly</option>
                                            </select>

                                        </div>
                                        @error('fcustomer.frequency')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('fcustomer.frequency') hide @enderror">Select service frequency</div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col s12 m5">
                                    <div class="checkbox-float">
                                        <label for="md-checkbox-keys{{$this->customer->id??"$$1"}}">
                                            <input type="checkbox" wire:model="fcustomer.key" id="md-checkbox-keys{{$this->customer->id??"$$1"}}" class="accent-green-800" >
                                            <span>Keys in office?</span>
                                        </label>
                                    </div>

                                    <div class="checkbox-float">
                                        <label for="md-checkbox-drive-licence">
                                            <input type="checkbox" wire:model="fcustomer.drive_licence" id="md-checkbox-drive-licence" class=" accent-green-800" >
                                            <span>Need driver licence?</span>
                                        </label>
                                    </div>

                                    <div class="checkbox-float">
                                        <label for="md-checkbox-gate-code">
                                            <input type="checkbox" wire:model="fcustomer.gate_code" id="md-checkbox-gate-code" class="accent-green-800" >
                                            <span>Need door or gate code?</span>
                                        </label>
                                    </div>

                                    <div class="checkbox-float">
                                        <label for="md-checkbox-more-girl">
                                            <input type="checkbox" wire:model="fcustomer.more_girl" id="md-checkbox-more-girl" class="accent-green-800"  >
                                            <span>More than one girl?</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col s12 m7">
                                    <label for="textarea-edit-customer-house-description">House Description</label>
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <textarea wire:model="fcustomer.house_description" id="textarea-edit-customer-house-description" class="form-control custom-textarea" rows="4" placeholder="Describe the customer's house here..."></textarea>
                                        </div>
                                        @error('fcustomer.house_description')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('fcustomer.house_description') hide @enderror">Describe the house</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col s12">
                                    <label for="textarea-edit-customer-note">Customer Notes</label>
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <textarea wire:model="fcustomer.note" id="textarea-edit-customer-note" class="form-control custom-textarea" rows="4" placeholder="Type customer notes here..."></textarea>
                                        </div>
                                        @error('fcustomer.note')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('fcustomer.note') hide @enderror">Type customer notes</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col s12">
                                    <label for="textarea-edit-customer-info">Customer info</label>
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <textarea wire:model="fcustomer.info" id="textarea-edit-customer-info" class="form-control custom-textarea" rows="4" placeholder="Type customer info here..."></textarea>
                                        </div>
                                        @error('fcustomer.info')
                                        <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                        @enderror
                                        <div class="help-info @error('fcustomer.info') hide @enderror">Type customer info</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="modal-footer">
                        <button class="btn btn-link btn-small waves-effect waves-green" type="submit">Save Changes</button>
                        <a  @click="showCustomerEdit = false;selectTab('tabCustomer');" class="btn btn-link red darken-4 waves-effect waves-red">Cancel</a>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>