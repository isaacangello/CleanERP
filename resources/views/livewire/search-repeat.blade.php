<div>
    <div class="w-full">
        <div class="panel panel-default" >
            <div class="panel-heading p-l-15 p-t-2 p-r-2 p-b-2">
                Search repetition
            </div>

            <div class="panel-body " >
                <div class="clearfix row m-b-0">
                    <form wire:submit.prevent="searchedCycles()">
                        <div class="input-field col s12 m3 offset-m3">
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

                        <div class="input-field col s12 m3 valign-wrapper">
                            <div class="form-group valign-wrapper">
                                <button type="submit" class="btn btn-link btn-small waves-effect waves-teal">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    @if($this->cycles)
                        <table>
                            <tr>

                                <th>Created At</th>
                                <th>customer</th>
                                <th>frequency</th>
                                <th class="text-center">Dates</th>
                                <th><input id="default-checkbox" type="checkbox" wire:model.live="selectAll"  class=" w-4 h-4 accent-emerald-800 bg-green-800 text-green-800  border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"> </th>
                            </tr>
                            @php
                                $counter = 0;
                            @endphp
                        @foreach($this->cycles['data'] as $cycle)
                                <tr wire:key="tr{{ $cycle->id }}"  class="{{ \App\Helpers\Funcs::altClass($counter,['bg-gray-100',' ']) }}">

                                    <td>{{ Carbon\Carbon::create($cycle->created_at )->format('l, m/d/Y h:i A')  }}</td>
                                    <td>{{$cycle->customer_name}}</td>
                                    <td>{{$cycle->frequency}}</td>
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

                                    <td title="{{$title}}">
                                        {{ $datesStr }}
                                        ...
                                    </td>
                                    <td>
                                        <input id="default-checkbox" wire:model.live.debounce="selectedCycles" value="{{ $cycle->id }}" type="checkbox"  class=" w-4 h-4 accent-emerald-800 bg-green-800 text-green-800  border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    </td>
                                </tr>
                            @php($counter++)
                            @endforeach
                            <tr>
                                <td colspan="7" class="text-end">
                                    <x-danger-button wire:click="deletedCycles" >
                                        Delete
                                    </x-danger-button>
                                </td>
                            </tr>
                        </table>
                    @endif
                </div>

            </div>
        </div>
    </div>

</div>
