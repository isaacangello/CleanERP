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
                              Reference Week Number <span class="yellow-text text-darken-4">{{ $numWeek }}</span> / From <span
                                        class="label-date-home">{{ $from }}</span> - Till <span
                                        class="label-date-home">{{ $till }} </span>

                            </span>


                </div>

                <div class="body">
                    <x-layout.week-navigator :$numWeek :$year :$selectedWeek :$selectedYear :$previousWeek :$nextWeek  />

                    <div class="clearfix row m-b-0">
                        <div class="col s12 ">
                            @php $id='1'; @endphp
                            <x-finance-panel-search :id="$id" :employees="$this->populate->allEmployees" :from="now()->startOfWeek()->format('Y-m-d')" :till="now()->endOfWeek()->format('Y-m-d')"  />
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
{{--                                @php dd($this->populate) @endphp--}}
                                @if($this->populate->employees_services != null)
                                    @php
                                        $i=0;
//                                    dd($this->populate['employees_services']);
                                    @endphp
                                    {{--                                        {{dd($employees_services)}}--}}
                                    @foreach($this->populate->employees_services as $key =>  $data)
                                        @php
                                            //                                                    dd($row);
                                        @endphp
                                        <tr class="{{ \App\Helpers\Funcs::altClass($i,['grey lighten-2','']) }}" >
                                            <td>
                                                <a
                                                    href="{{ route('finances.detailer',[
                                                        'id' => $data['employee_id'],
                                                        'from' =>Carbon\Carbon::create($data['from'])->format('Y-m-d'),
                                                        'till' =>Carbon\Carbon::create($data['till'])->format('Y-m-d'),
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
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col s12">
                                        <div class="btn-group">

                                        </div>
                                    </div>
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
        window.addEventListener('toast-alert', event =>{
            // console.log(event)
            toastAlert.fire({
                icon: event.detail.icon,
                title: event.detail.message
            })
            //console.log(window)
        })
        window.addEventListener('toast-btn-alert', event =>{
            // console.log(event)
            window.Swal.fire({
                icon: event.detail.icon,
                title: event.detail.title,
                text: event.detail.text
            })
            //console.log(window)
        })



        window.addEventListener('triggerRefresh',()=>{
            $wire.$refresh()
        })
    </script>
    @endscript
    </div> {{-- end of container fluid --}}
