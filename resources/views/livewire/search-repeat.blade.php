<div>
    <div wire:loading class="fixed w-full h-full">
        <div>
            <img src="{{asset('img/loading.gif')}}" alt="loading" class="w-36 " style="margin-left: 40vw; margin-top: 10vh">
        </div>
    </div>

    <div class="w-full">
        <div class="panel panel-default" >
            <div class="panel-heading p-l-15 p-t-2 p-r-2 p-b-2">
                Search repetition
            </div>

            <div class="panel-body " >
                <div class="clearfix row m-b-0">
                    <form wire:submit.prevent="searchCycles()">
                        <div class="input-field col s12 m3 offset-m3">
                            <div class="form-group">
                                <div class="form-line success">
                                    <select id="select-repeat-customer"
                                            class="block text-gray-600  bg-white  border-t-0 border-b border-x-0 border-gray-300  shadow-sm h-30  text-left cursor-default
                                            focus:outline-none focus:ring-0  focus:border-t-0 focus:border-b focus:border-x-0  focus:border-green-800 sm:text-sm"
                                            wire:model="selectedCustomer"

                                    >
                                        <option  value="-1">No Customers</option>
                                        <option  value="-1">All</option>
                                        @if(isset($this->filteredCustomers) and !empty($this->filteredCustomers))
                                            @foreach($this->filteredCustomers as $customer)
                                                <option wire:key="custKey{{$customer['id']}}"  value="{{$customer['id']}}" @if($id === $customer['id']) selected @endif >{{ $customer['name'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('selectedCustomer')
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
                                    <select
                                            wire:model="searchFilterType"
                                            wire:change="$refresh"
                                            title="select type of customer to search"
                                            class="block text-gray-600  bg-white  border-t-0 border-b border-x-0 border-gray-300  shadow-sm h-30  text-left cursor-default
                                                    focus:outline-none focus:ring-0  focus:border-t-0 focus:border-b focus:border-x-0  focus:border-green-800 sm:text-sm"
                                    >
                                        <option value="ALL"> All </option>
                                        <option value="COMMERCIAL">Commercial</option>
                                        <option value="RESIDENTIAL">Residential</option>
                                    </select>
                                </div>
                                <div class="help-info">Select Type.</div>
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

                    @if($this->searchedCycles)
                        <table wire:loading.remove>
                            <tr>

                                <th>Created At</th>
                                <th>customer</th>
                                <th>frequency</th>
                                <th class="text-center">Dates</th>
                                <th class="p-0">&nbsp;</th>
                            </tr>
                            @php
                                $counter = 1;
                            @endphp
                        @foreach($this->searchedCycles as $cycle)
                                <tr wire:key="tr{{ $counter }}"  class="{{ \App\Helpers\Funcs::altClass($counter,['bg-gray-100',' ']) }}">

                                    <td class="p-0" >{{ Carbon\Carbon::create($cycle->created_at )->format('l, m/d/Y h:i A')  }}</td>
                                    <td class="p-0 @if($cycle->origin === "scheduleCycle") text-indigo-800 @else text-green-800 @endif" @if($cycle->origin === "scheduleCycle") title="COMMERCIAL" @else title="RESIDENTIAL" @endif>{{$cycle->customer_name}}</td>
                                    <td class="p-0">{{$cycle->frequency}}</td>
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

                                    <td class="p-0" title="{{$title}}">
                                        {{ $datesStr }}
                                        ...
                                    </td>
                                    <td class="p-0 text-end">
{{--                                        <input  wire:model.live.debounce="selectedCycles" value="{{ $cycle->id }}" type="checkbox"  class=" w-4 h-4 accent-emerald-800 bg-green-800 text-green-800  border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">--}}
                                        <x-danger-button  wire:click="$dispatch('confirm-del-cycles',{ icon:'question', title:'confirm ?', text:'you want to remove this cycle?',id:{{$cycle->id}},origin: '{{$cycle->origin??false}}' })" >
                                            <span class="material-symbols-outlined relative right-2">delete</span>
                                        </x-danger-button>

                                    </td>
                                </tr>
                            @php($counter++)
                            @endforeach
                            <tr>
                                <td colspan="7" class="p-0 text-center">
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
