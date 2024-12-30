<div class="modal-content modal-content-bs modal-col-white w-full ">
    <div class="container-fluid ">
        <div class="modal-content">
            <form id="customer-form-create" wire:submit.prevent="saveNewCustomer()">
                <div class="container">
                    <div class="row">
                        <div class="col s12 text-start">
                            <h5 class="m-0 p-0 text-start font-bold relative right-2">
                                New Customer
                            </h5>
                        </div>
                    </div>

                    <div class="row label-employee-view-edit">
                        <span class="label label-padding">Personal Information</span>
                    </div>
                    <div class="row clearfix">
                        <div class="col s12 m8">
                            <div class="form-group">
                                <label class="form-label" for="input-create-customer-name">Customer Name</label>
                                <div class="form-line success form-line-name">
                                    <input id="input-create-customer-name" wire:model="fcustomer.name" type="text" class="form-control"/>
                                </div>
                                @error('fcustomer.name')
                                <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                @enderror
                                <div class="help-info @error('fcustomer.name') hide @enderror">Enter the customer's name</div>
                            </div>
                        </div>
                        <div class="col s12 m4">
                            <div class="form-group">
                                <label class="form-label" for="select-create-customer-type">Customer Type</label>
                                <div class="form-line success form-line-type">
                                    <select wire:model.live="fcustomer.type" id="select-create-customer-type" class="block text-gray-600 bg-white border-t-0 border-b border-x-0 border-gray-300 shadow-sm h-45 text-left cursor-default focus:outline-none focus:ring-0 focus:border-t-0 focus:border-b focus:border-x-0 focus:border-green-800 sm:text-sm">
                                        <option value="">Select an option</option>
                                        <option value="RESIDENTIAL">Residential</option>
                                        <option value="COMMERCIAL">Commercial</option>
                                        <option value="RENTALHOUSE">Rental House</option>
                                    </select>
                                </div>
                                @error('fcustomer.type')
                                <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                @enderror
                                <div class="help-info @error('fcustomer.type') hide @enderror">Select the customer type</div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col s12 m7">
                            <div class="form-group">
                                <div class="form-line success form-line-address">
                                    <input type="text" wire:model="fcustomer.address" id="input-create-customer-address" class="form-control">
                                    <label class="form-label" for="input-create-customer-address">Customer Address</label>
                                </div>
                                @error('fcustomer.address')
                                <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                @enderror
                                <div class="help-info @error('fcustomer.address') hide @enderror">Enter the customer's address</div>
                            </div>
                        </div>
                        <div class="col s12 m5">
                            <div class="form-group">
                                <div class="form-line success form-line-complement">
                                    <input type="text" wire:model="fcustomer.complement" id="input-create-customer-address-complement" class="form-control">
                                    <label class="form-label" for="input-create-customer-address-complement">Complement</label>
                                </div>
                                @error('fcustomer.complement')
                                <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                @enderror
                                <div class="help-info @error('fcustomer.complement') hide @enderror">Enter the address complement</div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col s12 m6">
                            <div class="form-group">
                                <div class="form-line success form-line-phone">
                                    <input type="text" wire:model="fcustomer.phone" id="input-create-customer-phone" class="form-control">
                                    <label class="form-label" for="input-create-customer-phone">Phone</label>
                                </div>
                                @error('fcustomer.phone')
                                <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                @enderror
                                <div class="help-info @error('fcustomer.phone') hide @enderror">Enter the customer's phone</div>
                            </div>
                        </div>
                        <div class="col s12 m6">
                            <div class="form-group">
                                <div class="form-line success form-line-email">
                                    <input type="text" wire:model="fcustomer.email" id="input-create-customer-email" class="form-control">
                                    <label class="form-label" for="input-create-customer-email">Email</label>
                                </div>
                                @error('fcustomer.email')
                                <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                @enderror
                                <div class="help-info @error('fcustomer.email') hide @enderror">Enter the customer's email</div>
                            </div>
                        </div>
                    </div>
                @if($this->fcustomer->type === "RESIDENTIAL")
                        <div class="row label-employee-view-edit">
                            <span class="label label-padding">Billing Price</span>
                        </div>
                        <div class="row clearfix">
                            <div class="col s12 m6 offset-m3">
                                <div class="form-group">
                                    <label class="form-label mb-5" for="id-customer-billing-create">Select billing prices</label>
                                    <div>
                                        <div class="max-w-md mx-auto" x-data="multiSelectAlpine()">
                                            <div class="relative">
                                                <button type="button" @click="selectOpen = !selectOpen" class="relative w-full h-45 bg-white border border-gray-300 shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-green-800 focus:border-green-800 sm:text-sm">
                                                    <span class="block truncate text-gray-600" x-text="selectedOptions.length ? joinSelectedValues() : 'Select options'"></span>
                                                    <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </button>
                                                <div x-show="selectOpen" @click.away="selectOpen = false" class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm" style="display: none;">
                                                    <template x-for="option in options" :key="option.id">
                                                        <div @click="toggleOption(option.id);toggleValues(option.value)" class="cursor-pointer select-none relative py-2 pl-3 pr-9 text-gray-600 hover:bg-green-800 hover:text-white">
                                                            <span x-text="option.label+' / '+option.value" :class="{ 'font-semibold': selectedOptions.includes(option.id) }" class="block truncate"></span>
                                                            <span x-show="selectedOptions.includes(option.id)" class="absolute inset-y-0 right-0 flex items-center pr-4 text-green-800 hover:text-white">
                                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 0 01-1.414 0l-4-4a1 0 011.414-1.414L8 12.586l7.293-7.293a1 0 011.414 0z" clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                        <x-javascript-select-alpine />
                                    </div>
                                    @error('fcustomer.billing_values_selected')
                                    <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                    @enderror
                                    <div class="help-info @error('fcustomer.billing_values_selected') hide @enderror">Billing options list</div>
                                </div>
                            </div>
                        </div>
                @endif
                @if($this->fcustomer->type === "COMMERCIAL")
                        <div class="row label-employee-view-edit">
                            <span class="label label-padding">Others email</span>
                        </div>
                        <div class="row clearfix">
                            <div class="col s12 ">
                                <div class="form-group">
                                    <div class="form-line success form-line-phone">
                                        <textarea wire:model="fcustomer.others_email" id="textarea-create-customer-others-email" class="form-control custom-textarea" rows="4" placeholder="Enter other emails here..."></textarea>
                                    </div>
                                    @error('fcustomer.others_email')
                                    <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                    @enderror
                                    <div class="help-info @error('fcustomer.others_email') hide @enderror">Enter other emails</div>

                                </div>
                            </div>

                        </div>
                @endif
                    <div class="row label-employee-view-edit">
                        <span class="label label-padding">Service Information</span>
                    </div>
                    <div class="row clearfix">
                        <div class="col s12 m7">
                            <label for="textarea-create-customer-other-services">Other Services</label>
                            <div class="form-group">
                                <div class="form-line success form-line-other-services">
                                    <textarea wire:model="fcustomer.other_services" id="textarea-create-customer-other-services" class="form-control custom-textarea" rows="4" placeholder="Other services here..."></textarea>
                                </div>
                                @error('fcustomer.other_services')
                                <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                @enderror
                                <div class="help-info @error('fcustomer.other_services') hide @enderror">Other services</div>
                            </div>
                        </div>
                        <div class="col s12 m5">
                            <div class="form-group">
                                <label class="form-label" for="select-create-service-frequency">Service Frequency</label>
                                <div class="form-line success form-line-frequency">
                                    <select wire:model="fcustomer.frequency" class="block text-gray-600 bg-white border border-gray-300 shadow-sm h-45 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-green-800 focus:border-green-800 sm:text-sm" id="select-create-service-frequency">
                                        <option value="ONE">Occasional</option>
                                        <option value="WEK">Weekly</option>
                                        <option value="BIW">Biweekly</option>
                                        <option value="TRH">Three Weeks</option>
                                        <option value="MON">Monthly</option>
                                    </select>
                                </div>
                                @error('fcustomer.frequency')
                                <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                @enderror
                                <div class="help-info @error('fcustomer.frequency') hide @enderror">Select the service frequency</div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col s12 m5">
                            <div class="checkbox-float">
                                <label for="md-checkbox-keys-create">
                                    <input type="checkbox" wire:model="fcustomer.key" id="md-checkbox-keys-create" class="accent-green-800">
                                    <span>Keys in the office?</span>
                                </label>
                            </div>
                            <div class="checkbox-float">
                                <label for="md-checkbox-drive-licence-create">
                                    <input type="checkbox" wire:model="fcustomer.drive_licence" id="md-checkbox-drive-licence-create" class="accent-green-800">
                                    <span>Requires driver's license?</span>
                                </label>
                            </div>
                            <div class="checkbox-float">
                                <label for="md-checkbox-gate-code-create">
                                    <input type="checkbox" wire:model="fcustomer.gate_code" id="md-checkbox-gate-code-create" class="accent-green-800">
                                    <span>Requires gate code?</span>
                                </label>
                            </div>
                            <div class="checkbox-float">
                                <label for="md-checkbox-more-girl-create">
                                    <input type="checkbox" wire:model="fcustomer.more_girl" id="md-checkbox-more-girl-create" class="accent-green-800">
                                    <span>More than one girl?</span>
                                </label>
                            </div>
                        </div>
                        <div class="col s12 m7">
                            <label for="textarea-create-customer-house-description">House Description</label>
                            <div class="form-group">
                                <div class="form-line success">
                                    <textarea wire:model="fcustomer.house_description" id="textarea-create-customer-house-description" class="form-control custom-textarea" rows="4" placeholder="Describe the customer's house here..."></textarea>
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
                            <label for="textarea-create-customer-note">Customer Notes</label>
                            <div class="form-group">
                                <div class="form-line success">
                                    <textarea wire:model="fcustomer.note" id="textarea-create-customer-note" class="form-control custom-textarea" rows="4" placeholder="Enter customer notes here..."></textarea>
                                </div>
                                @error('fcustomer.note')
                                <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                @enderror
                                <div class="help-info @error('fcustomer.note') hide @enderror">Enter customer notes</div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col s12">
                            <label for="textarea-create-customer-info">Customer Information</label>
                            <div class="form-group">
                                <div class="form-line success">
                                    <textarea wire:model="fcustomer.info" id="textarea-create-customer-info" class="form-control custom-textarea" rows="4" placeholder="Enter customer information here..."></textarea>
                                </div>
                                @error('fcustomer.info')
                                <div class="help-info red-text text-darken-4">{{ $message }}</div>
                                @enderror
                                <div class="help-info @error('fcustomer.info') hide @enderror">Enter customer information</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-link btn-small waves-effect waves-green" type="submit">Save</button>
                        <a @click="show = false;selectTab('tabCustomer');" class="btn btn-link red darken-4 waves-effect waves-red">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>