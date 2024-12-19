<div
        x-data="{
                    showCustomerEdit: $wire.entangle('showCustomerEdit'),
                    selectTab: ()=> console.log('Provide Compatibility')

                }
                "
>
    <div wire:loading.class.remove="hidden" class="hidden fixed w-full h-full">
        <div>
            <img src="{{asset('img/loading.gif')}}" alt="loading" class="w-36 " style="margin-left: 40vw; margin-top: 10vh">
        </div>
    </div>

    <div class="panel panel-default" >
        <div class="panel-heading p-l-15 p-t-2 p-r-2 p-b-2">
            Search customer
        </div>

        <div class="panel-body " >
            <div class="clearfix row m-b-0">
                <div class="col s12 m3">
                    <div class="form-group">
                        <div class="form-line success form-line-customer_id flex gap-3">
                            <x-standard-btn wire:click="createCustomerEvent">
                                <span class="material-symbols-outlined">person_add </span>
                            </x-standard-btn>
                        </div>
                    </div>
                </div>
                <div class="col s12 m3 ">
                    <div class="form-group">
                        <div class="form-line success form-line-customer_id flex gap-3">
                            <span class="text-sm material-symbols-outlined">search</span>
                            <x-text-input

                                    label="Search Customer"
                                    placeholder="Search Customer"
                                    wire:model.live.debounce="search"
                                    wire:keydown.enter="searchedCustomers"
                                    class="text-sm h-30"
                            />

                        </div>

                    </div>
                </div>
                <div class="col s12 m3">
                    <div class="form-group">
                        <div class="form-line success">
                            <select wire:model="searchFilterType" title="select type of customer to search"
                                    class="block text-gray-600  bg-white  border-t-0 border-b border-x-0 border-gray-300  shadow-sm h-30  text-left cursor-default
                                    focus:outline-none focus:ring-0  focus:border-t-0 focus:border-b focus:border-x-0  focus:border-green-800 sm:text-sm"
                            >
                                <option value="ALL"> All </option>
                                <option value="COMMERCIAL">Commercial</option>
                                <option value="RESIDENTIAL">Residential</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <table>

                        @if($this->data)
                            <tr>
                                <th>Created At</th>
                                <th>customer</th>
                                <th class="hidden md:block">Type</th>
                                <th>Status</th>
                            </tr>

                            @php $counter = 0; @endphp
                            @foreach($this->data as $key => $data)
                                @php

                                        @endphp

                                <tr wire:key="cust{{$key}}"  class="{{ \App\Helpers\Funcs::altClass($counter,['bg-gray-100','bg-white text-gray-600']) }}">
                                    <td class="p-0">{{Carbon\Carbon::create($data->created_at)->format('l, m/d/Y h:i A')}}</td>
                                    <td class="p-0"><a title="Click to Edit customer information." class="btn-link-underline pointer waves-effect waves-grey" wire:click="editCustomerEvent({{ $data->id }})">{{$data->name}}</a></td>
                                    <td class="p-0 hidden md:block"><span class=" @if($data->type == "COMMERCIAL") text-gray-700 @else text-green-700 @endif ">{{$data->type}}</span> </td>
                                    <td class="p-0" colspan="2">
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
                        @empty($this->data)
                            <div class="text-center text-gray-600">No data found</div>
                        {{ $this->data->links() }}
                        @endempty
                    </div>
                </div>
        </div>
    </div>
    <x-customer-edit-bs :$billings  />
</div>

