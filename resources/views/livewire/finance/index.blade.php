<div class="container-fluid">
    <div class="block-header">
        <h2>
            <small>FINANCES</small>
        </h2>
    </div>
    <!-- Basic Examples -->

    <div class="clearfix row">
        <div class="col s12 m12">
            <div class="card">
                <div class="header">
                            <span>RESIDENTIAL  </span>
                            <span>
                              Week Number <span class="yellow-text text-darken-4">{{ $numWeek }}</span> / From <span
                                        class="label-date-home">{{ $from }}</span> - Till <span
                                        class="label-date-home">{{ $till }} </span><div class="displaytest">Iphone</div>
                            </span>


                </div>

                <div class="body">
                    <x-layout.week-navigator :$numWeek :$year :$selectedWeek :$selectedYear :$previousWeek :$nextWeek  />

                    <div class="clearfix row m-b-0">
                        <div class="col s12 ">
                            <x-finance-panel-search :employees="$this->populate['allEmployees']" />
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-body">

                            <table class="table table-striped highlight">
                                <thead>
                                <tr class="green darken-3 white-text">
                                    <th>Employee</th>
                                    <th>Total</th>
                                    <th>70%</th>
                                    <th>30%</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($this->populate['employees_services'] != null)
                                    @php
                                        $i=0;
                                    @endphp
                                    {{--                                        {{dd($employees_services)}}--}}
                                    @foreach($this->populate['employees_services'] as $key =>  $data)
                                        @php
                                            //                                                    dd($row);
                                        @endphp
                                        <tr class="{{ \App\Helpers\Funcs::altClass($i,['grey lighten-2','']) }}" >
                                            <td>
                                                <a
                                                    href="{{ route('finances.detailer',[
                                                        'id' => $data['employee_id'],
                                                        'from' =>$data['from'],
                                                        'till' =>$data['till'],
                                                    ] ) }}"
                                                    class="btn-link-underline grey-text text-darken-2 pointer"
                                                >
                                                    {{$data['emp_name']}}
                                                </a>
                                            </td>
                                            <td>{{$data['cem']}}</td>
                                            <td>{{$data['setenta']}}</td>
                                            <td>{{$data['trinta']}}</td>
                                            <td></td>
                                        </tr>
                                            @php($i++)

                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" style="padding: 10px"><p>Services not found in this week</p></td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            </div>
                        </div>
                        </div>{{--panel--}}

                </div>

            </div>
        </div>
        </div>
    @script
    <script>
        console.log(window)


             M.FormSelect.init($wire.$el.querySelector('.livewire-select'), {});

                 M.Datepicker.init($wire.$el.querySelector('.livewire-datepicker'), {
                    autoClose: true,
                    showClearBtn: true,
                    yearRange: 50,
                    format:'mm/dd/yyyy',
                });


                 M.Timepicker.init($wire.$el.querySelector('.livewire-timepicker'), {})


            // time picker


        window.addEventListener('triggerRefresh',()=>{
            $wire.$refresh()
        })
    </script>
    @endscript
    </div> {{-- end of container fluid --}}
