@props([  'name' => 'serviceCad'])
@php use  App\Helpers\Funcs; @endphp
<!-- Extra Large Modal -->
<div id="modal-create"  tabindex="-1"  class="fixed top-0 left-0 right-0 z-50   bg-blue-800/30 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full items-center  justify-center"
     x-on:open-modal.window="$event.detail == '{{ $name }}' ? cadOpen = true : null"
     x-on:close-modal.window="$event.detail == '{{ $name }}' ? cadOpen = false : null"
     x-on:close.stop="cadOpen = false"
     x-on:keydown.escape.window="cadOpen = false"
     x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
     x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
     style="display: {{ $cadOpen ? 'block' : 'none' }};"
     x-show="cadOpen"
     x-transition:enter="animate__animated animate__fadeInUpBig animate__faster"
     x-transition:leave="animate__animated animate__fadeOutDownBig animate__faster"

>
{{--    <div--}}
{{--            x-show="cadOpen"--}}
{{--            class="fixed inset-0 transform transition-all"--}}
{{--            x-on:click="cadOpen = false"--}}
{{--            --}}{{--            x-transition:enter="ease-out duration-300"--}}
{{--            x-transition:enter="animate__animated animate__fadeInUpBig "--}}
{{--            x-transition:enter-start="opacity-0"--}}
{{--            x-transition:enter-end="opacity-100"--}}
{{--            --}}{{--            x-transition:leave="ease-in duration-200"--}}
{{--            x-transition:leave="animate__animated animate__fadeOutDownBig "--}}
{{--            x-transition:leave-start="opacity-100"--}}
{{--            x-transition:leave-end="opacity-0"--}}
{{--    >--}}
{{--        <div class="fixed inset-0 bg-blue-800 dark:bg-gray-900 opacity-0"></div>--}}
{{--    </div>--}}


    <!-- Modal content -->
        <div class=" bg-white rounded-lg shadow-sm dark:bg-gray-700 max-w-7xl mx-auto my-auto">
            <div wire:loading class=" bg-black/5 w-full h-full absolute top-0 left-0 flex items-center justify-center">
                <div role="status" class="bg-white rounded-lg w-14 h-14 flex items-center justify-center"  style="margin-left: 48vw; margin-top: 45vh;">
                    <svg aria-hidden="true" class="inline w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <form id="service-form"  method="post" wire:submit.prevent="store">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        New service
                    </h3>
                    <button type="button" id="modalClose" @click="cadOpen = false" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-private function closeModal() {

                    }
                    900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">

                        @csrf
                        <input type="hidden" wire:model="form.who_saved"  value="{{Funcs::replaceSpaces(Auth::user()->name)}}">
                        <input type="hidden" wire:model="form.who_saved_id"  value="{{Auth::user()->id}}">
                    <x-flowbite.label-form>People involved in the service</x-flowbite.label-form>
                    <div class="grid grid-cols-3 gap-4 space-x-4">
{{--                            Customer --}}
                            <div>
                                    <label class="form-label"  for="select-cad-service-customer">Customer</label>

                                    <select
                                            wire:loading.attr="disabled"
                                            wire:model.blur="form.customer_id"
{{--                                            wire:change="price_inject()"--}}
                                            class="w-full py-2.5 font-medium rounded-lg text-sm"
                                            id="select-cad-service-customer"
                                            x-ref="customerId"
                                    >
                                        <option wire:loading.class="opacity-50" >Customer</option>
                                        @foreach($this->selectOptionsCustomers as  $value)
                                            <option wire:loading.class="opacity-50" value="{{$value->id}}">{{$value->name}} </option>
                                        @endforeach

                                    </select>
                                @error('form.customer_id')
                                <div class="help-info text-red-700" id="help-info-title">{{ $message }}</div>
                                @enderror
                                <div class="@error('form.customer_id') hidden @enderror help-info">select the customer for service.</div>
                            </div>
{{--                            Employee 1--}}
                            <div>

                                    <label class="form-label"  for="select-cad-service-employee1">Employee</label>
                                    <select
                                            wire:loading.attr="disabled"
                                            wire:loading.class="opacity-50"
                                            wire:model="form.employee1_id"
                                            id="select-cad-service-employee1"
                                            class="w-full py-2.5 font-medium rounded-lg text-sm"
                                    >

                                        <option  value="none">Employee</option>
                                        @foreach($this->selectOptionsEmployees as $values)
                                            <option   wire:loading.class="opacity-50" value="{{$values->id}}">{{$values->name}} </option>
                                        @endforeach
                                    </select>
                                @error('form.employee1_id')
                                <div class="text-red-700" id="help-info-title">{{ $message }}</div>
                                @enderror
                                <div class=" @error('form.employee1_id') hidden @enderror help-info">select the employee for service.</div>
                            </div>
{{--                             employee 2--}}
                            <div>
                                <label class="form-label"  for="select-cad-service-employee2">Second employee.</label>
                                <select
                                        wire:model="form.employee2_id"
                                        class="w-full py-2.5 font-medium rounded-lg text-sm"
                                        id="select-cad-service-employee2"
                                >
                                    <option selected value="0">Second employee</option>
                                    @foreach($this->selectOptionsEmployees as $values)
                                        @if(old('form.employee2_id') == $values->id)
                                            <option selected  value="{{$values->id}}">{{$values->name}} </option>
                                        @elseif($values->id === $empFromOpen)
                                            <option selected  value="{{$values->id}}">{{$values->name}} </option>
                                        @else
                                            <option  value="{{$values->id}}">{{$values->name}} </option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="help-info">Select the second employee.</div>
                            </div>
                    </div>
                    <x-flowbite.label-form>Service repeat.</x-flowbite.label-form>
                    <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="form-label"  for="cad-schedule-loop">Service frequency.</label>
                                <select
                                        wire:model="form.repeat_frequency"
                                        id="select-cad-service-form.repeat_frequency"
                                        class="w-full py-2.5 font-medium rounded-lg text-sm"
                                >
                                    <option value="ONE">Select one option</option>
                                    <option  value="ONE">Eventual</option>
                                    <option  value="WEK">Weekly</option>
                                    <option  value="BIW">Biweekly</option>
                                    <option  value="THR">Three-weekly</option>
                                    <option  value="MON">Monthly</option>
                                </select>
                                    {{--                                    <label class="form-label"  for="select-cad-service-period">frequency of repetition.</label>--}}


                                @error('form.repeat_frequency')
                                <div class="text-red-700" id="help-info-title">{{ $message }}</div>
                                @enderror

                                <div class="@error('form.repeat_frequency') hidden @enderror help-info" id="help-info-loop">Select the service execution frequency</div>

                            </div>
                        <div>
                            <label class="form-label"  for="cad-schedule-loop">month(s) to repeat</label>
                            <x-flowbite.select
                                    wire:model="form.repeat_months"
                                    id="cad-schedule-team"
                            >
                                @php
                                    $string_0= "";
                                    $string_1= "";
                                    $string_2 = "";
                                    $string_3 = "";
                                    $string_6 = "";
                                    $string_12 = "";
                                    if(!empty(old("form.repeat_months"))){
                                        switch (old("form.repeat_months")){
                                            case'1': $string_1 = "selected" ;break;
                                            case'2': $string_2 = "selected" ;break;
                                            case'3': $string_3 = "selected" ;break;
                                            case'6': $string_6 = "selected" ;break;
                                            case'12': $string_12 = "selected" ;break;
                                        }
                                    }else{
                                        $string_none = "selected";
                                    }

                                @endphp
                                <option  {{ $string_none }} value="0">select month(s) to repeat</option>
                                <option  {{ $string_1 }} value="0">no repeat</option>
                                <option  {{ $string_1 }} value="1">1 month</option>
                                <option  {{ $string_2 }} value="2">2 months</option>
                                <option  {{ $string_3 }} value="3">3 months</option>
                                <option  {{ $string_6 }} value="6">6 months</option>
                                <option  {{ $string_12 }} value="12">12 months</option>
                            </x-flowbite.select>
                            @error('form.repeat_months')
                            <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                            @enderror
                            <div class="@error('form.repeat_months') hidden @enderror help-info" id="help-info-loop">Select month(s) to repeat Service Schedule.</div>
                        </div>
                    </div>
                    <x-flowbite.label-form>Service information</x-flowbite.label-form>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label"  for="input-cad-service-date">Service Date</label>
                                    <x-flowbite.flatpickr-date
                                            wire:model="form.service_date"
                                            id="input-cad-service-date"
                                            value="{{ old('form.service_date') }}"
                                    />
                                @error('form.service_date')
                                <div class="help-info text-red-700" id="help-info-title">{{ $message }}</div>
                                @enderror
                                <div class=" @error('form.service_date') hidden @enderror help-info">Select the service execution date.</div>
                        </div>
                        <div>
                            <label class="form-label"  for="select-cad-service-billings">type of billing.</label>
                                <x-flowbite.select
                                        wire:loading.attr="disabled"
                                        wire:model="form.frequency_payment"
                                >
                                    @if($this->populateBillings)
                                        @foreach($this->populateBillings as $billing)
                                            <option wire:loading.class="opacity-50"  value="{{$billing->id}},{{$billing->value}}">{{$billing->label}} / {{ $billing->value }}</option>
                                        @endforeach
                                    @endif
                                </x-flowbite.select>
                            @error('form.frequency_payment')
                            <div class="help-info red-text text-darken-4" id="help-info-title">{{ $message }}</div>
                            @enderror
                            <div class="@error('form.frequency_payment') hide @enderror help-info">Select type of billing.</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="textarea-cad-service-note">type service notes.</label>
                                        <x-flowbite.textarea
                                                wire:model="form.notes"
                                                id="textarea-cad-service-note"
                                                placeholder="Please type service notes here..."
                                                class="p-2.5"
                                        >{{ old('notes') }}</x-flowbite.textarea>
                            <div class="help-info">Type customer notes </div>
                        </div>
                        <div>
                            <label for="textarea-cad-costumer-instructions">Instructions for employees.</label>
                            <x-flowbite.textarea
                                    wire:model="form.instructions"
                                    id="textarea-cad-costumer-instructions"
                                    class="p-2.5"
                                    rows="4"
                                    placeholder="Please type instructions for employees here..."
                            >
                                {{ old('instructions') }}
                            </x-flowbite.textarea>
                            <div class="help-info">Type instructions for employees. </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button  type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                    <button id="modalClose1"  @click="cadOpen = false" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>

                        <div role="status" wire:loading wire:target="store">
                            <svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>

                </div>
            </form>
        </div>

</div>