<div class="w-full">
    <div class="panel panel-default" >
        <div class="panel-heading p-l-15 p-t-2 p-r-2 p-b-2">
            Search
        </div>

        <div class="panel-body " >
            <div class="clearfix row m-b-0">
                <form wire:submit.prevent="searchedServices()">
                    <div class="input-field col s12 m3">
                        <div class="form-group">
                            <div class="form-line success">
                                <select id="select-finance-employee" class="form-control browser-default livewire-select font-12 h-30" wire:model="selectedCustomer" >
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
                                <select id="select-finance-employee" class="form-control browser-default livewire-select font-12 h-30" wire:model="selectedEmployee" >
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
                                <x-date-flat-pickr id="input-finance-from" options="{!! $options !!}" class="font-12 h-30" wire:model="from" value="{{$this->from}}"   />
                                <label class="form-label" for="input-finance-from">From</label>
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
                                            monthSelectorType:'static',
                                            dateFormat:'Y-m-d',
                                            altFormat:'F j, Y',
                                            altInput:true,
                                            defaultDate: '$till'
                                        }
                                        ";
                                @endphp
                                <x-date-flat-pickr id="input-finance-from" options="{!! $options !!}"  class="font-12 h-30" wire:model="till" />
                                <label class="form-label" for="input-finance-till">Till</label>
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
                    @if($this->services)
                    <table>
                        <tr>

                            <th>Date</th>
                            <th>customer</th>
                            <th>employee</th>
                            <th>frequency</th>
                            <th class="text-center">Confirmed</th>
                            <th class="text-center">Canceled</th>
                            <th><input id="default-checkbox" type="checkbox" wire:model.live="selectAll"  class=" w-4 h-4 accent-emerald-800 bg-green-800 text-green-800  border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"> </th>
                        </tr>
                        @foreach($this->services['data'] as $service)
                            <tr wire:key="tr{{ $service['id'] }}">

                                <td>{{ Carbon\Carbon::create($service['service_date'] )->format('l, m/d/Y h:i A')  }}</td>
                                <td>{{$service['customer']['name']}}</td>
                                <td>{{$service['employee']['name']}}</td>
                                <td>{{$service['frequency']}}</td>
                                <td class="text-center">{!! $service['confirmed']===1?"<span class='material-symbols-outlined text-teal-700 text-sm'>verified</span>":"" !!}</td>
                                <td class="text-center">{!! $service['fee']===1?"<span class='material-symbols-outlined text-amber-700 text-sm'>verified</span>":"" !!}</td>
                                <td>
                                    <input id="default-checkbox" wire:model="selectedServices" value="{{ $service['id'] }}" type="checkbox" checked="checked" class=" w-4 h-4 accent-emerald-800 bg-green-800 text-green-800  border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
{{--                                    <label>--}}
{{--                                        <input type="checkbox" class="materialize-checkbox filled-in" checked="checked"  />--}}
{{--                                        <span></span>--}}
{{--                                    </label>--}}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @endif
            </div>

        </div>
    </div>
</div>
