<div class="w-full">
    <div wire:loading class="fixed w-full h-full">
        <div>
            <img src="{{asset('img/loading.gif')}}" alt="loading" class="w-36 " style="margin-left: 40vw; margin-top: 10vh">
        </div>
    </div>
    <div class="panel panel-default" >
        <div class="panel-heading p-l-15 p-t-2 p-r-2 p-b-2">
            Search
        </div>

        <div class="panel-body " >
            <div class="clearfix row m-b-0">
                <form wire:submit.prevent="searchServices()">
                    <div class="input-field col s12 m3">
                        <div class="form-group">
                            <div class="form-line success">
                                <select id="select-service-customer" class="form-control browser-default livewire-select font-12 h-30 text-gray-900" wire:model="selectedCustomer" >
                                    <option  value="{{$id??'0'}}">No Customers</option>
                                    @if(isset($customers) and !empty($customers))
                                        @foreach($customers as $customer)
                                            <option wire:key="empKey{{$customer['id']}}"  value="{{$customer['id']}}" @if($id === $customer['id']) selected @endif >{{ $customer['name'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('selectedEmployee')
                                @script
                                <script>
                                    console.log("error in plus")
                                    $wire.dispatch('toast-btn-alert', {icon:'error', title:"Error", text:"{{$message}}"})
                                </script>
                                @endscript
                                @enderror
                            </div>
                            <div class="help-info">Select Customer.</div>
                        </div>
                    </div>

                    <div class="input-field col s12 m3">
                        <div class="form-group">
                            <div class="form-line success">
                                <select id="select-service-employee" class="form-control browser-default livewire-select font-12 h-30 text-gray-900" wire:model="selectedEmployee" >
                                    <option  value="{{$id??'0'}}">No employee</option>
                                    @if(isset($employees) and !empty($employees))
                                    @foreach($employees as $employee)
                                        <option wire:key="empKey{{$employee['id']}}"  value="{{$employee['id']}}" @if($id === $employee['id']) selected @endif >{{ $employee['name'] }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('selectedEmployee')
                                @script
                                <script>
                                    console.log("error in plus")
                                    $wire.dispatch('toast-btn-alert', {icon:'error', title:"Error", text:"{{$message}}"})
                                </script>
                                @endscript
                                @enderror
                            </div>
                            <div class="help-info">Select employee.</div>
                        </div>
                    </div>
                    <div class="input-field col s12 m2 ">
                        <div class="form-group">
                            <div class="form-line success">
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
                                <x-date-flat-pickr id="input-search-service-from" options="{!! $options !!}" class="font-12 h-30" wire:model="from" value="{{$this->from}}"   />
                                <label class="form-label" for="input-search-service-from">From</label>
                            </div>
                            <div class="help-info">Insert date from.</div>
                        </div>
                    </div>
                    <div class="input-field col s12 m2">
                        <div class="form-group">
                            <div class="form-line success">
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
                                <x-date-flat-pickr id="input-search-service-till" options="{!! $options !!}"  class="font-12 h-30" wire:model="till" />
                                <label class="form-label" for="input-search-service-till">Till</label>
                            </div>
                            <div class="help-info">Insert date till.</div>
                        </div>

                    </div>
                    <div class="input-field col s12 m2 valign-wrapper">
                        <div class="form-group valign-wrapper">
                            <button type="submit" class="btn btn-link btn-small waves-effect waves-teal">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                    @if($this->searchedServices)
                        @php
                            $counter = 0;
                        @endphp

                    <table>

                        <tr>

                            <th>Date</th>
                            <th>customer</th>
                            <th>employee</th>
                            <th>frequency</th>
                            <th class="text-center">Confirmed</th>
                            <th class="text-center">Canceled</th>
                            <th class="p-0"><input  type="checkbox"  wire:change="$dispatch('select-all-checkboxes', { checkboxClass: 'services-entries-found' } )"   class=" w-4 h-4 accent-emerald-800 bg-green-800 text-green-800  border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"> </th>
                        </tr>
                        @foreach($this->searchedServices as $service)
                            <tr wire:key="tr{{ $service->id }}" class="{{ \App\Helpers\Funcs::altClass($counter,['bg-gray-100',' ']) }}" >

                                <td class="p-0">{{ Carbon\Carbon::create($service['service_date'] )->format('l, m/d/Y h:i A')  }}</td>
                                <td class="p-0">{{$service->customer->name}}</td>
                                <td class="p-0">{{$service->employee->name}}</td>
                                <td class="p-0">{{$service->frequency}}</td>
                                <td class="p-0 text-center">{!! $service->confirmed===1?"<span class='material-symbols-outlined text-teal-700 text-sm'>verified</span>":"" !!}</td>
                                <td class="p-0 text-center">{!! $service->fee===1?"<span class='material-symbols-outlined text-amber-700 text-sm'>verified</span>":"" !!}</td>
                                <td class="p-0">
                                    <input  wire:model="selectedServices" value="{{ $service->id }}" type="checkbox"  class="services-entries-found w-4 h-4 accent-emerald-800 bg-green-800 text-green-800  border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
{{--                                    <label>--}}
{{--                                        <input type="checkbox" class="materialize-checkbox filled-in" checked="checked"  />--}}
{{--                                        <span></span>--}}
{{--                                    </label>--}}
                                </td>
                            </tr>
                            @php($counter++)
                        @endforeach
                        <tr>
                            <td colspan="6"></td>
                            <td  class="text-start p-0">
                                <x-danger-button wire:click="deleteServices" title="Delete selected services" >
                                    <span class="material-symbols-outlined relative bottom-1 right-2">delete</span>
                                </x-danger-button>
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

