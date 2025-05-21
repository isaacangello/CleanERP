<div class="w-full">
    <div wire:loading class="fixed w-full h-full">
        <div>
            <img src="{{asset('img/loading.gif')}}" alt="loading" class="w-36 " style="margin-left: 40vw; margin-top: 10vh">
        </div>
    </div>
    <div>
        <div class="header w-full p-4">
            Search
        </div>

        <div class="w-full" >
            <div class="border  border-gray-300">
                <form wire:submit.prevent="searchServices()" >
                    <div class="flex space-x-2 items-end justify-center p-2 mb-3">
                        <div>

                                <x-old.input-label class="help-info">Select Customer.</x-old.input-label>
                                    <x-flowbite.select
                                            id="select-service-customer"
                                             wire:model="selectedCustomer"
                                    >
                                        <option  value="{{$id??'0'}}">No Customers</option>
                                        @if(isset($customers) and !empty($customers))
                                            @foreach($customers as $customer)
                                                <option wire:key="empKey{{$customer['id']}}"  value="{{$customer['id']}}" @if($id === $customer['id']) selected @endif >{{ $customer['name'] }}</option>
                                            @endforeach
                                        @endif
                                    </x-flowbite.select>
                                    @error('selectedEmployee')
                                    @script
                                    <script>
                                        console.log("error in plus")
                                        $wire.dispatch('toast-btn-alert', {icon:'error', title:"Error", text:"{{$message}}"})
                                    </script>
                                    @endscript
                                    @enderror
                        </div>

                        <div>
                                    <x-old.input-label class="help-info">Select employee.</x-old.input-label>
                                    <x-flowbite.select
                                            id="select-service-employee"
                                            wire:model="selectedEmployee"
                                    >
                                        <option  value="{{$id??'0'}}">No employee</option>
                                        @if(isset($employees) and !empty($employees))
                                        @foreach($employees as $employee)
                                            <option wire:key="empKey{{$employee['id']}}"  value="{{$employee['id']}}" @if($id === $employee['id']) selected @endif >{{ $employee['name'] }}</option>
                                        @endforeach
                                        @endif
                                    </x-flowbite.select>
                                    @error('selectedEmployee')
                                    @script
                                    <script>
                                        console.log("error in plus")
                                        $wire.dispatch('toast-btn-alert', {icon:'error', title:"Error", text:"{{$message}}"})
                                    </script>
                                    @endscript
                                    @enderror

                        </div>
                        <div>

                            @php
                                $from = Carbon\Carbon::create($this->from)->format("Y-m-d");
                                $options = "
                                {
                                    weekNumbers:true,
                                    monthSelectorType:'static',
                                    dateFormat:'Y-m-d',
                                    altFormat:'F j, Y',
                                    altInput:true,
                                    defaultDate:'$from'
                                }
                                ";
                            @endphp
                            <x-old.input-label class="form-label" for="input-search-service-from">From</x-old.input-label>
                            <x-flowbite.flatpickr-date id="input-search-service-from" class="p-1 w-full h-10" options="{!! $options !!}"  wire:model="from" value="{{$this->from}}"   />
                        </div>
                        <div>
                            @php
                                $till = Carbon\Carbon::create($this->till)->format("Y-m-d");
                                    $options = "
                                    {
                                        weekNumbers:true,
                                        monthSelectorType:'dropdown',
                                        dateFormat:'Y-m-d',
                                        altFormat:'F j, Y',
                                        altInput:true,
                                        defaultDate: '$till'
                                    }
                                    ";
                            @endphp
                            <x-old.input-label>Till</x-old.input-label>
                            <x-flowbite.flatpickr-date id="input-search-service-till"  class="h-10 w-full"  options="{!! $options !!}"  wire:model="till" value="{{$this->till}}" />
                        </div>
                        <div>
                            <x-old.input-label class="text-white">Till</x-old.input-label>
                            <x-flowbite.btn-blue type="submit" class="h-10 me-0 mb-0">
                                <i class="fa-duotone fa-regular fa-magnifying-glass-play"></i>
                            </x-flowbite.btn-blue>
                        </div>
                    </div>

                </form>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2">
                    @if($this->searchedServices)
                        @php
                            $counter = 0;
                        @endphp

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>

                            <th  scope="col" class="px-6 py-3">Date</th>
                            <th scope="col" class="px-6 py-3">customer</th>
                            <th scope="col" class="px-6 py-3">employee</th>
                            <th scope="col" class="px-6 py-3">frequency</th>
                            <th scope="col" class="px-6 py-3 text-center">Confirmed</th>
                            <th scope="col" class="px-6 py-3 text-center">Canceled</th>
                            <th scope="col" class="px-6 py-3 flex items-center justify-center"><input  type="checkbox"  wire:change="$dispatch('select-all-checkboxes', { checkboxClass: 'services-entries-found' } )"   class=" w-4 h-4 accent-blue-900-800 bg-blue-800 text-blue-800  border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"> </th>
                        </tr>
                        </thead>
                        @foreach($this->searchedServices as $service)
                            <tr wire:key="tr{{ $service->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600" >

                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ Carbon\Carbon::create($service['service_date'] )->format('l, m/d/Y h:i A')  }}</td>
                                <td class="px-6 py-4">{{$service->customer->name}}</td>
                                <td class="px-6 py-4">{{$service->employee->name}}</td>
                                <td class="px-6 py-4">{{$service->frequency}}</td>
                                <td class="px-6 py-4 text-center">{!! $service->confirmed===1?"<i class='fa-solid fa-badge-check text-blue-950 text-sm mx-auto'></i>":"" !!}</td>
                                <td class="px-6 py-4 text-center">{!! $service->fee===1?"<i class='fa-solid fa-badge-check text-amber-700 text-sm mx-auto'></i>":"" !!}</td>
                                <td class="px-6 py-4 flex items-center justify-center">
                                    <input  wire:model="selectedServices" value="{{ $service->id }}" type="checkbox"  class="services-entries-found w-4 h-4 accent-blue-900 bg-blue-800 text-blue-800  border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                            </tr>
                            @php($counter++)
                        @endforeach
                        <tr>
                            <td colspan="6"></td>
                            <td  class="px-6 py-4 flex items-center justify-center">
                                <x-flowbite.btn-red wire:click="deleteServices" title="Delete selected services" >
                                    <i class="fa-duotone fa-regular fa-trash-xmark"></i>
                                </x-flowbite.btn-red>
                            </td>
                        </tr>
                    </table>
                    @endif
            </div>
            @if($this->searchedServices)
            <div class="row">
                <div class="col s12">
                    <div class="flex justify-center">
                        {{ $this->searchedServices->links() }}
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

