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
    <div id="edit-fcustomer" class="fixed top-0 left-0 right-0 z-50 p-6 bg-blue-800/30  w-full  overflow-x-hidden overflow-y-auto md:inset-0  h-screen max-h-full flex items-center justify-center"
{{--         x-init="$watch('showCustomerEdit', value => {--}}
{{--                if (value) {--}}
{{--                    document.body.classList.add('overflow-y-hidden');--}}
{{--                    {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}--}}
{{--                } else {--}}
{{--                    document.body.classList.remove('overflow-y-hidden');--}}
{{--                }--}}
{{--            })"--}}

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
        <div class="relative w-full max-w-7xl max-h-full mx-auto my-auto">
                <div class="bg-white rounded-lg shadow-sm dark:bg-gray-700 w-full ">
                    <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <div role="status" wire:loading>
                            <svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white space-x-2">
                            @php
                                if (isset($dataService->customer->type)){
                                $custoType  = $dataService->customer->type === "RENTALHOUSE"? "<i class='fa-solid fa-house-day'></i>":"<i class='fa-solid fa-user-tie text-sm'></i>";
                                }else{$custoType="&nbsp;";}
                            @endphp
                            {{ $dataService->customer->name??"" }}{!! $custoType !!}
                        </h3>
                        <button type="button" @click="showCustomerEdit = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form
                            class="p-2 md:p-5"
                            @if($this->formType === 'CREATE')
                                id="customer-form-create" wire:submit.prevent="saveNewCustomer()"
                            @keydown.ctrl.s.prevent="$wire.saveNewCustomer()"
                            @else
                                id="customer-form-edit" wire:submit.prevent="updateCustomer({{$this->customer->id??0}})"
                            @keydown.ctrl.s.prevent="$wire.updateCustomer({{$this->customer->id??0}})"
                            @endif
                            @if($this->formType === 'EDIT')
                                id="customer-form-edit" wire:submit.prevent="updateCustomer({{$this->customer->id??0}})"
                            @keydown.ctrl.s.prevent="$wire.updateCustomer({{$this->customer->id??0}})"
                            @endif
                    >
                        <div class="p-4 md:p-5 space-y-1">
                            <div class="w-full">
                                <h3 class="text-xl font-medium text-gray-900 dark:text-white space-x-2">
                                        @if($formType === 'CREATE')
                                            New Customer
                                        @endif
                                        @if($formType === 'EDIT')
                                            Edit Customer
                                        @endif
                                </h3>
                            </div>
                            <div class="w-full mb-3">
                                <x-flowbite.label-form>Personal Information</x-flowbite.label-form>
                            </div>
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-8">
                                            <x-flowbite.input
                                                    label="Customer Name"
                                                    id="input-edit-customer-name"
                                                    wire:model="fcustomer.name" type="text"
                                            />

                                        @error('fcustomer.name')
                                        <div class="-no-color text-red-800">{{ $message }}</div>
                                        @enderror
                                        <div class="@error('fcustomer.name') hidden @enderror">&nbsp;</div>
                                </div>

                                <div class="col-span-4">

                                        <x-flowbite.label-std for="select-edit-customer-type">Select customer type</x-flowbite.label-std>

                                            <x-flowbite.select
                                                    wire:model.live="fcustomer.type"
                                                    id="select-edit-customer-type"
                                            >
                                                <option value="">Select an option</option>
                                                <option   value="RESIDENTIAL">Residential</option>
                                                <option   value="COMMERCIAL">Commercial</option>
                                                <option   value="RENTALHOUSE">Rental House</option>
                                            </x-flowbite.select>


                                        @error('fcustomer.type')
                                        <div class=" text-red-800">{{ $message }}</div>
                                        @enderror
                                        <div class=" @error('fcustomer.type') hidden @enderror">&nbsp; </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-7">
                                    <x-flowbite.input
                                            label="Customer Address"
                                            type="text"
                                            wire:model="fcustomer.address"
                                            id="input-edit-customer-address"
                                    />

                                    @error('fcustomer.address')
                                    <div class="-no-color text-red-800">{{ $message }}</div>
                                    @enderror
                                    <div class=" @error('fcustomer.address') hidden @enderror">&nbsp;</div>
                                </div>
                                <div class="col-span-5">
                                            <x-flowbite.input label="Complement" type="text" wire:model="fcustomer.complement" id="input-edit-customer-address-complement" class="form-control"
                                            />
                                        @error('fcustomer.complement')
                                        <div class=" text-red-800">{{ $message }}</div>
                                        @enderror
                                        <div class=" @error('fcustomer.complement') hidden @enderror">&nbsp;</div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <div>
                                    <x-flowbite.input
                                            label="Phone"
                                            type="text"
                                            wire:model="fcustomer.phone"
                                            id="input-edit-customer-phone"
                                            class="form-control"
                                    />
                                    @error('fcustomer.phone')
                                    <div class=" text-red-800 ">{{ $message }}</div>
                                    @enderror
                                    <div class=" @error('fcustomer.phone') hidden @enderror">&nbsp;</div>

                                </div>
                                <div>
                                        <x-flowbite.input
                                                label="Email"
                                                type="text"
                                                wire:model="fcustomer.email"
                                                id="input-edit-customer-email"
                                                class="form-control"
                                        />
                                        @error('fcustomer.email')
                                        <div class=" text-red-800">{{ $message }}</div>
                                        @enderror
                                        <div class=" @error('fcustomer.email') hidden @enderror">Insert customer email</div>
                                </div>
                            </div>
                            @isset($this->fcustomer->type)
                                @if(strtoupper($this->fcustomer->type) == "COMMERCIAL" )
                                    <div class="w-full">
                                        <div>
                                            <x-flowbite.label-std>Other Emails</x-flowbite.label-std>
                                            <x-flowbite.textarea wire:model="fcustomer.others_emails" id="textarea-edit-customer-note" class="form-control custom-textarea" rows="4" placeholder="Type customer other_emails here..."></x-flowbite.textarea>
                                            @error('fcustomer.others_emails')
                                            <div class=" text-red-800">{{ $message }}</div>
                                            @enderror
                                            <div class=" @error('fcustomer.others_emails') hidden @enderror">&nbsp;</div>
                                        </div>
                                    </div>

                                @endif

                                @if( strtoupper($this->fcustomer->type)  === "RESIDENTIAL" or strtoupper($this->fcustomer->type)  === "RENTALHOUSE")
                                    <x-flowbite.label-form>Billing Price</x-flowbite.label-form>
                                    <div class="row clearfix">
                                                <x-flowbite.label-std class=" mb-5" for="id-customer-billing-edit">Select billing prices</x-flowbite.label-std>
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
                                                    <div class="max-w-md mx-auto" x-data="multiSelectAlpine">
                                                        <div class="relative">
                                                            {{--                                                    <label for="multi-select" class="block text-sm font-medium text-gray-700 mb-1">Select options:</label>--}}

                                                            <div class="mt-1 relative">
                                                                <button type="button" @click="selectOpen = !selectOpen" class="relative w-full h-45 bg-white border border-gray-300  shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-blue-800 focus:border-blue-800 sm:text-sm">
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
                                                                             class="cursor-pointer select-none relative py-2 pl-3 pr-9 text-gray-600 hover:bg-blue-800 hover:text-white">
                                                                            <span x-text="option.label+' / '+option.value" :class="{ 'font-semibold': selectedOptions.includes(option.id) }" class="block truncate"></span>
                                                                            <span x-show="selectedOptions.includes(option.id)" class="absolute inset-y-0 right-0 flex items-center pr-4 text-blue-800 hover:text-white">
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

{{--                                                    <x-javascript-select-alpine />--}}

                                                </div>

                                                @error('fcustomer.billing_values_selected')
                                                <div class=" text-red-800">{{ $message }}</div>
                                                @enderror
                                                <div class=" @error('fcustomer.billing_values_selected') hidden @enderror">List of billing options</div>
                                    </div>
                                @endif
                            @endisset
                            <x-flowbite.label-form>Service Information</x-flowbite.label-form>
                            <div class="grid grid-cols-12 gap-2">
                                <div class="col-span-7">
                                    <x-flowbite.label-std for="textarea-edit-customer-other-services">Other Services</x-flowbite.label-std>
                                            <x-flowbite.textarea wire:model="fcustomer.other_services" id="textarea-edit-customer-other-services" class="form-control custom-textarea" rows="4" placeholder="Other services here..."></x-flowbite.textarea>
                                        @error('fcustomer.other_services')
                                        <div class=" text-red-800">{{ $message }}</div>
                                        @enderror
                                        <div class=" @error('fcustomer.other_services') hidden @enderror">&nbsp;</div>
                                </div>
                                <div class="col-span-5">
                                        <x-flowbite.label-std class="form-label" for="select-edit-service-frequency">Service Frequency</x-flowbite.label-std>
                                        <x-flowbite.select wire:model="fcustomer.frequency"  id="select-edit-service-frequency">
                                            <option @if(isset($this->customer->frequency) and $this->customer->frequency === "ONE" ) selected="selected" @endif value="ONE">Eventual</option>
                                            <option @if(isset($this->customer->frequency) and $this->customer->frequency === "WEK") selected="selected" @endif value="WEK">Weekly</option>
                                            <option @if(isset($this->customer->frequency) and $this->customer->frequency === "BIW") selected="selected" @endif value="BIW">Biweekly</option>
                                            <option @if(isset($this->customer->frequency) and $this->customer->frequency === "TRH") selected="selected" @endif value="TRH">Three-weekly</option>
                                            <option @if(isset($this->customer->frequency) and $this->customer->frequency === "MON") selected="selected" @endif value="MON">Monthly</option>
                                        </x-flowbite.select>
                                        @error('fcustomer.frequency')
                                        <div class=" text-red-800">{{ $message }}</div>
                                        @enderror
                                        <div class=" @error('fcustomer.frequency') hidden @enderror">Select service frequency</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-12">
                                <div class="col-span-5 grid grid-cols-2 gap-2">
                                    <div class="checkbox-float">
                                        <label for="md-checkbox-keys{{$this->customer->id??"$$1"}}">
                                            <input type="checkbox" wire:model="fcustomer.key" id="md-checkbox-keys{{$this->customer->id??"$$1"}}" class="accent-blue-800" >
                                            <span class="'block font-medium text-sm text-gray-700" >Keys in office?</span>
                                        </label>
                                    </div>

                                    <div class="checkbox-float">
                                        <label for="md-checkbox-drive-licence">
                                            <input type="checkbox" wire:model="fcustomer.drive_licence" id="md-checkbox-drive-licence" class=" accent-blue-800" >
                                            <span class="'block font-medium text-sm text-gray-700">Need driver licence?</span>
                                        </label>
                                    </div>

                                    <div class="checkbox-float">
                                        <label for="md-checkbox-gate-code">
                                            <input type="checkbox" wire:model="fcustomer.gate_code" id="md-checkbox-gate-code" class="accent-blue-800" >
                                            <span class="'block font-medium text-sm text-gray-700">Need door or gate code?</span>
                                        </label>
                                    </div>

                                    <div class="checkbox-float">
                                        <label for="md-checkbox-more-girl">
                                            <input type="checkbox" wire:model="fcustomer.more_girl" id="md-checkbox-more-girl" class="accent-blue-800"  >
                                            <span class="'block font-medium text-sm text-gray-700">More than one girl?</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-span-7">
                                    <x-flowbite.label-std for="textarea-edit-customer-house-description">House Description</x-flowbite.label-std>
                                    <x-flowbite.textarea wire:model="fcustomer.house_description" id="textarea-edit-customer-house-description" class="form-control custom-textarea" rows="4" placeholder="Describe the customer's house here..."></x-flowbite.textarea>
                                    @error('fcustomer.house_description')
                                    <div class="font-medium text-sm  text-red-800">{{ $message }}</div>
                                    @enderror
                                    <div class="font-medium text-sm text-gray-700 @error('fcustomer.house_description') hidden @enderror">&nbsp;</div>

                                </div>
                            </div>
                            <div class="w-full">
                                    <x-flowbite.label-std for="textarea-edit-customer-note">Customer Notes</x-flowbite.label-std>
                                    <x-flowbite.textarea wire:model="fcustomer.note" id="textarea-edit-customer-note" class="form-control custom-textarea" rows="4" placeholder="Type customer notes here..."></x-flowbite.textarea>
                                    @error('fcustomer.note')
                                    <div class="font-medium text-sm  text-red-800">{{ $message }}</div>
                                    @enderror
                                    <div class="font-medium text-sm text-gray-700 @error('fcustomer.note') hidden @enderror">&nbsp;</div>
                            </div>
                            <div class="w-full">
                                <x-flowbite.label-std for="textarea-edit-customer-info">Customer info</x-flowbite.label-std>
                                <x-flowbite.textarea wire:model="fcustomer.info" id="textarea-edit-customer-info" class="form-control custom-textarea" rows="4" placeholder="Type customer info here..."></x-flowbite.textarea>
                                @error('fcustomer.info')
                                <div class=" text-red-800">{{ $message }}</div>
                                @enderror
                                <div class=" @error('fcustomer.info') hidden @enderror">&nbsp;</div>
                            </div>


                        <div class="modal-footer">
                            <x-flowbite.btn-blue type="submit" @click="selectTab('tabCustomer');">Save Changes</x-flowbite.btn-blue>
                            <x-flowbite.btn-red  @click="showCustomerEdit = false;selectTab('tabCustomer');" >Cancel</x-flowbite.btn-red>
                        </div>
                    </form>
                </div>
        </div>
    </div>

</div>