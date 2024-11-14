<div>
    <div class="panel panel-default" >
        <div class="panel-heading p-l-15 p-t-2 p-r-2 p-b-2">
            Search Employee
        </div>

        <div class="panel-body " >
            <div class="clearfix row m-b-0">
                <div class="col s12 m6 offset-m3">
                    <div class="form-group">
                        <div class="form-line success form-line-Employee_id flex gap-3">
                            <span class="text-sm material-symbols-outlined">search</span>
                            <x-text-input

                                    label="Search Employee"
                                    placeholder="Search Employee"
                                    wire:model.live.debounce="search"
                                    wire:keydown.enter="searchedEmployee"
                                    class="text-sm h-30"
                            />

                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <table>
                        <tr>
                            <th>Created At</th>
                            <th>Employee</th>
                            <th>Status</th>
                        </tr>
                        @if($this->data)
                            @php $counter = 0; @endphp
                            @foreach($this->data as $key => $data)


                                <tr wire:key="cust{{$key}}"  class="{{ \App\Helpers\Funcs::altClass($counter,['bg-gray-100',' ']) }}">
                                    <td>{{\Carbon\Carbon::create($data->created_at)->format('l, m/d/Y h:i A')}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->status}}</td>
                                </tr>
                                @php $counter++; @endphp
                            @endforeach

                        @endif
                        <tr>
                            <td colspan="3">  </td>
                        </tr>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>
