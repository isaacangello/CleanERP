<div>
    <div class="panel panel-default" >
        <div class="panel-heading p-l-15 p-t-2 p-r-2 p-b-2">
            Search customer
        </div>

        <div class="panel-body " >
            <div class="clearfix row m-b-0">
                <div class="col s12 m6 offset-m3">
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
            </div>
            <div class="row">
                <div class="col s12">
                    <table>
                        @if($this->data)
                        <tr>
                            <th>Created At</th>
                            <th>customer</th>
                            <th>Status</th>
                            <th></th>
                        </tr>

                            @php $counter = 0; @endphp
                        @foreach($this->data as $key => $data)


                            <tr wire:key="cust{{$key}}"  class="{{ \App\Helpers\Funcs::altClass($counter,['bg-gray-100','bg-white text-gray-600']) }}">
                                <td class="p-0">{{Carbon\Carbon::create($data->created_at)->format('l, m/d/Y h:i A')}}</td>
                                <td class="p-0"><a class="btn-link-underline pointer waves-effect waves-grey" wire:click="editCustomerEvent({{ $data->id }})">{{$data->name}}</a></td>
                                <td class="p-0" colspan="2">
                                    <select class="block text-gray-600  {{ \App\Helpers\Funcs::altClass($counter,['bg-gray-100','bg-white']) }} border border-gray-300  shadow-sm m-0  text-left cursor-default focus:outline-none focus:ring-1 focus:ring-green-800 focus:border-green-800 sm:text-sm" wire:model="status" wire:change="changeStatus({{$data->id}})">
                                        <option value="active" @if($data->status == 'ACTIVE') selected @endif>Active</option>
                                        <option value="inactive" @if($data->status == 'INACTIVE') selected @endif>Inactive</option>
                                    </select>
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
        </div>
    </div>

</div>
