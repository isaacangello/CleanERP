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
                    <span>
                        @if(isset($currentEmployee->name)) EMPLOYEE @endif

                              <b>{{ $currentEmployee->name??'' }}</b> </span>
                    <span>
                          Week Number <span class="yellow-text text-darken-4">{{ $numWeek }}</span> / From <span
                            class="label-date-home">{{ $from }}</span> - Till <span
                            class="label-date-home">{{ $till }} </span><div class="displaytest">Iphone</div>
                    </span>
                </div>

                <div class="body">
                    <x-layout.week-navigator :$numWeek :$year :$selectedWeek :$selectedYear   />

                    <div class="clearfix row">
                        <div class="col s12 ">
                            <x-finance-panel-search :employees="$this->allEmployees()" :$from :$till :id="$currentEmployee->id" />
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <table class="table table-striped highlight">
                                    <thead>
                                    <tr class="green darken-3 white-text">
                                        <th class="center-align">Paid</th>
                                        <th class="center-align">Customer</th>
                                        <th>Frequency</th>
                                        <th>Price</th>
                                        <th>70%</th>
                                        <th>30%</th>
                                        <th>Plus</th>
                                        <th>Minus</th>
                                        <th>Total</th>
                                        <th>Payment</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($this->Data->isNotEmpty())
                                        @php
                                            $i=0;
                                        @endphp
                                        {{--                                        {{dd($employees_services)}}--}}
                                        @foreach($this->Data as $key =>  $data)
{{--                                            @php dd($data); @endphp--}}
                                            <livewire:finance.detailer-tr wire:key="tr{{$key}}" :i="$i" :$data />
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


    </script>
    @endscript
</div> {{-- end of container fluid --}}
