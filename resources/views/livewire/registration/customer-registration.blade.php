<div
        x-data="{
                    showCustomerEdit: $wire.entangle('showCustomerEdit'),
                    selectTab: ()=> console.log('Provide Compatibility'),
                    focusables() {
                        // All focusable element types...
                        let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
                        return [...$el.querySelectorAll(selector)]
                            // All non-disabled elements...
                            .filter(el => ! el.hasAttribute('disabled'))
                    },
                    firstFocusable() { return this.focusables()[0] },
                    lastFocusable() { return this.focusables().slice(-1)[0] },
                    nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
                    prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
                    nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
                    prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
                }"


>
    <div wire:loading.class.remove="hidden" class="hidden fixed w-full h-full">
        <div>
            <img src="{{asset('img/loading.gif')}}" alt="loading" class="w-36 " style="margin-left: 40vw; margin-top: 10vh">
        </div>
    </div>

    <div class="w-full" >
        <div class="header w-full p-4">
            Search customer
        </div>

        <div class="w-full" >
            <div class="flex space-x-2 items-end justify-center p-2 mb-3 border border-gray-300">
                <div >
                    <x-flowbite.btn-blue wire:click="createCustomerEvent">
                        <i class="fa-duotone fa-regular fa-user-plus"></i>
                    </x-flowbite.btn-blue>
                </div>
                <div>
                        <span class="text-sm material-symbols-outlined">search</span>
                        <x-flowbite.input
                                label="Search Customer"
                                placeholder="Search Customer"
                                wire:model.live.debounce="search"
                                wire:keydown.enter="searchedCustomers"
                        />
                </div>
                <div>
                    <x-flowbite.select
                            wire:model.live="searchFilterType"
                            title="select type of customer to search"
                    >
                        <option value="ALL"> ALL </option>
                        <option value="COMMERCIAL">COMMERCIAL</option>
                        <option value="RESIDENTIAL">RESIDENTIAL</option>
                    </x-flowbite.select>
                </div>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                        @if($this->data)
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Created At</th>
                                <th scope="col" class="px-6 py-3">customer</th>
                                <th scope="col" class="px-6 py-3 hidden md:block">Type</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                            </tr>
                            </thead>
                            @php $counter = 0; @endphp
                            @foreach($this->data as $key => $data)
                                @php

                                        @endphp

                                <tr wire:key="cust{{$key}}"  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-3">
                                        <span class="hidden md:block">{{Carbon\Carbon::create($data->created_at)->format('l, m/d/Y h:i A')}}</span>
                                        <span class="block md:hidden text-sm">{{Carbon\Carbon::create($data->created_at)->format('m/d/Y')}}</span>
                                    </td>
                                    <td class="px-6 py-3"><a title="Click to Edit customer information." class="btn-link-underline pointer waves-effect waves-grey text-green-950" wire:click="editCustomerEvent({{ $data->id }})">{{$data->name}}</a></td>
                                    <td class="px-6 py-3 hidden md:block"><span class=" @if($data->type == "COMMERCIAL") text-gray-700 @else text-green-700 @endif ">{{$data->type}}</span> </td>
                                    <td class="px-6 py-3" colspan="2">
                                        <a class="btn-link-underline pointer" wire:click="changeStatus({{$data->id}})"
                                           title="Click to change status."
                                        >
                                            <span>{{$data->status}}</span>
                                        </a>
                                    </td>
                                </tr>
                                @php $counter++; @endphp
                            @endforeach


                        @else
                            <tr>
                                <td colspan="3"> Not found </td>
                            </tr>
                        @endif
                    </table>

                </div>

            </div>
            <div class="row">
                <div class="col s12 m12">
                    <div class="flex justify-center">

                        @if(!is_array($this->data))
                            {{ $this->data->links() }}
                        @endif


                    </div>
                </div>
        </div>
    </div>
    <x-flowbite.customer-html-form :$billings :$showCustomerEdit :$filterType />
</div>

