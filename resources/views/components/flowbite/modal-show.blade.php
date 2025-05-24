@props(['showModal' => false,'open' =>false, 'title' => 'Service Details','name' => 'Service Details'])
<!-- Extra Large Modal -->
<div id="modal-show" tabindex="-1" class="fixed top-0 left-0 right-0 z-50  bg-blue-800/30  w-full  overflow-x-hidden overflow-y-auto md:inset-0  h-screen max-h-full flex items-center justify-center"
     x-on:open-modal.window="$event.detail == '{{ $name }}' ? open = true : null"
     x-on:close-modal.window="$event.detail == '{{ $name }}' ? open = false : null"
     x-on:close.stop="open = false"
     x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
     x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
     style="display: {{ $showModal ? 'block' : 'none' }};"

     x-show="open"
     x-transition:enter="animate__animated animate__backInDown animate__faster"
     x-transition:leave="animate__animated animate__backOutUp animate__faster"

     x-on:keydown.escape.window="open = false"

>


    <div class="relative  max-w-7xl max-h-full mx-auto my-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
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
                <button type="button" @click="open = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-1">
                <div class="grid grid-cols-4 gap-2">
                    <div>
                        <label>Curtomer:</label>
                        <x-flowbite.select-modal :data="$allCustomers" :selected="$dataService->customer->id??''"
                             wire:model="customer_id"
                             wire:change="field_change('customer_id')"
                             wire:loading.attr="disabled"
                             class="p-l-0"
                             id="selectServiceCustomer"
                        />
                    </div>
                    <div>
                        <label>employee:</label>
                        <x-flowbite.select-modal :data="$allEmployees" :selected="$dataService->employee->id??''"
                             wire:model="employee1_id"
                             wire:change="field_change('employee1_id')"
                            wire:loading.attr="disabled"
                             id="selectServiceEmployee"
                        />
                    </div>
                </div>
                <div>
                    <x-flowbite.input
                            wire:model="address"
                            wire:change="field_change('address')"
                            wire:loading.attr="disabled"
                            label="{{'Address:'}}"
                            id="serviceAddress"
                            type="text"
                    />
                </div>
                <div>
                    <x-flowbite.input
                            label="Phone:"
                            wire:model="phone"
                            wire:change="field_change('phone')"
                            wire:loading.attr="disabled"
                            id="servicePhone"
                            type="text"
                    />
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <label for="serviceDate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date:</label>
                        <x-flowbite.flatpickr-date-time

                                wire:model="service_date"
                                wire:change.debounce.3000ms="field_change('service_date')"
                                wire:loading.attr="disabled"
                                id="serviceDate"
                                class="modal-residential-change"
                        />
                    </div>
                    <div>
                        <label for="serviceInTime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Check In:</label>
                        <x-flowbite.flatpickr-date-time
                                wire:model="checkin_datetime"
                                wire:change.debounce.3000ms="field_change('checkin_datetime')"
                                wire:loading.attr="disabled"
                                id="serviceInTime"
                                class="modal-residential-change"
                        />
                    </div>
                    <div>
                        <label for="serviceOutTime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Check Out:</label>
                        <x-flowbite.flatpickr-date-time
                                wire:model="checkout_datetime"
                                wire:change.debounce.3000ms="field_change('checkout_datetime')"
                                wire:loading.attr="disabled"
                                id="serviceOutTime"
                                class="modal-residential-change"
                        />
                    </div>
                </div>
                <div>
                    <label for="serviceInformation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Info:</label>
                    <x-flowbite.textarea
                            wire:model.blur="info"
                            wire:change="field_change('info')"
                            wire:loading.attr="disabled"
                            id="serviceInformation"
                            class="modal-residential-change" cols="30" rows="4"
                    />
                </div>
                <div>
                    <label for="ServiceNotes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notes:</label>
                    <x-flowbite.textarea

                            wire:model.blur="notes"
                            wire:change="field_change('notes')"
                            wire:loading.attr="disabled"
                            id="ServiceNotes"
                            class="modal-residential-change" cols="30" rows="4"
                    />
                </div>
                <div>
                    <label for="ServiceInstructions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">instructions for employees:</label>
                    <x-flowbite.textarea
                            wire:model="instructions"
                            wire:change.blur="field_change('instructions')"
                            wire:loading.attr="disabled"
                            id="ServiceInstructions"
                            class="modal-residential-change" cols="30" rows="4"
                    />
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex  items-center p-4 md:p-5 space-x-3  border-t border-gray-200 rounded-b dark:border-gray-600">
                <x-flowbite.btn-orange
                        wire:click="$dispatch('trigger-confirm-fee')"
                        @click="open = false"
                        class="btnFeeService"
                        id="btnFeeService"
                >
                    <i class="fa-duotone fa-rectangle-xmark"></i>
                </x-flowbite.btn-orange>
                <x-flowbite.btn-red
                        wire:click="$dispatch('trigger-confirm-delete')"
                        @click="open = false"
                        id="btnDeleteService"
                >
                    <i class="fa-duotone fa-trash"></i>
                </x-flowbite.btn-red>
                <x-flowbite.btn-blue class="text-base py-2.5" @click="open = false">
                    Close
                </x-flowbite.btn-blue>
            </div>
        </div>
    </div>
</div>