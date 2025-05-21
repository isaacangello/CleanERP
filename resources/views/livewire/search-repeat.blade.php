<div>
    <div wire:loading class="fixed w-full h-full z-50">
        <div>
            <img src="{{asset('img/loading.gif')}}" alt="loading" class="w-36 " style="margin-left: 40vw; margin-top: 10vh">
        </div>
    </div>

    <div class="w-full">
        <div>
            <div class="header w-full p-4">
                Search repetition
            </div>

            <div class="panel-body " >
                    <form wire:submit.prevent="searchCycles()">
                        <div class="w-full flex space-x-2 items-end justify-center p2 mb-3">
                                <div>
                                    <x-old.input-label>Select Customer.</x-old.input-label>
                                    <x-flowbite.select
                                            id="select-repeat-customer"
                                            wire:model="selectedCustomer"
                                    >
                                        <option  value="-1">No Customers</option>
                                        <option  value="-1">All</option>
                                        @if(isset($this->filteredCustomers) and !empty($this->filteredCustomers))
                                            @foreach($this->filteredCustomers as $customer)
                                                <option wire:key="custKey{{$customer['id']}}"  value="{{$customer['id']}}" @if($id === $customer['id']) selected @endif >{{ $customer['name'] }}</option>
                                            @endforeach
                                        @endif
                                    </x-flowbite.select>
                                    @error('selectedCustomer')
                                    @script
                                    <script>
                                        console.log("error in plus"+{{$message}})
                                        $wire.dispatch('toast-btn-alert', {icon:'error', title:"Error", text:"{{$message}}"})
                                    </script>
                                    @endscript
                                    @enderror

                                </div>



                                <div>
                                    <x-old.input-label>Select Type.</x-old.input-label>
                                    <x-flowbite.select
                                            wire:model="searchFilterType"
                                            wire:change="$refresh"
                                            title="select type of customer to search"
                                    >
                                        <option value="ALL"> All </option>
                                        <option value="COMMERCIAL">Commercial</option>
                                        <option value="RESIDENTIAL">Residential</option>
                                    </x-flowbite.select>
                                </div>
                            <div>
                                <x-flowbite.btn-blue type="submit" class="h-10 me-0 mb-0">
                                    <i class="fa-duotone fa-regular fa-magnifying-glass-play"></i>
                                </x-flowbite.btn-blue>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2">

                    @if($this->searchedCycles)
                        <table wire:loading.remove class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Created At</th>
                                    <th scope="col" class="px-6 py-3">customer</th>
                                    <th scope="col" class="px-6 py-3">frequency</th>
                                    <th  class="px-6 py-3 text-center">Dates</th>
                                    <th scope="col" class="px-6 py-3">&nbsp;</th>
                                </tr>
                            </thead>
                            @php
                                $counter = 1;
                            @endphp
                        @foreach($this->searchedCycles as $cycle)
                                <tr wire:key="tr{{ $counter }}"  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600" >

                                    <td class="px-6 py-3" >{{ Carbon\Carbon::create($cycle->created_at )->format('l, m/d/Y h:i A')  }}</td>
                                    <td class="px-6 py-3 @if($cycle->origin === "scheduleCycle") text-amber-800 @else text-blue-800 @endif" @if($cycle->origin === "scheduleCycle") title="COMMERCIAL" @else title="RESIDENTIAL" @endif>{{$cycle->customer_name}}</td>
                                    <td class="px-6 py-3">{{$cycle->frequency}}</td>
                                    @php
                                        $dates = explode(',', $cycle->dates);
                                        $title = '';
                                        $datesStr = '';
                                        for ($i = 0; $i < count($dates); $i++) {
                                            $title .= Carbon\Carbon::create($dates[$i])->format('m/d/Y')."\n";
                                            if($i <3){
                                              $datesStr .= Carbon\Carbon::create($dates[$i])->format('m/d/Y').", ";
                                            }
                                        }
                                    @endphp

                                    <td class="px-6 py-3" title="{{$title}}">
                                        {{ $datesStr }}
                                        ...
                                    </td>
                                    <td class="px-6 py-3 text-end">
{{--                                        <input  wire:model.live.debounce="selectedCycles" value="{{ $cycle->id }}" type="checkbox"  class=" w-4 h-4 accent-emerald-800 bg-green-800 text-green-800  border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">--}}
                                        <x-flowbite.btn-red  wire:click="$dispatch('confirm-del-cycles',{ icon:'question', title:'confirm ?', text:'you want to remove this cycle?',id:{{$cycle->id}},origin: '{{$cycle->origin??false}}' })" >
                                            <i class="fa-duotone fa-regular fa-trash-xmark"></i>
                                        </x-flowbite.btn-red>

                                    </td>
                                </tr>
                            @php($counter++)
                            @endforeach
                            <tr>
                                <td colspan="7" class="px-6 py-3 text-center">
                                    {{ $this->searchedCycles->links() }}
                                </td>
                            </tr>
                        </table>
                    @endif
                </div>

            </div>
        </div>
    </div>

</div>
