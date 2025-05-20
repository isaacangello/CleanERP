<div class="card bg-white/40  mt-5 rounded-xl shadow-lg ">
    <div class="card-header p-4 border-b">
        <h2>
            FINANCES
        </h2>
    </div>
    <!-- Basic Examples -->

    <div class="card-body">
        <div class="w-full">
            <div class="card bg-white  mt-5 rounded-xl shadow-lg ">
                <h2 class="card-header p-4 border-b">
                            <span class="hidden md:block">RESIDENTIAL  </span>
                            <span>
                              <span class="hidden md:block">Reference</span> Week Number <span class="yellow-text text-darken-4">{{ $numWeek }}</span> / From <span
                                        class="label-date-home">{{ $from }}</span> - Till <span
                                        class="label-date-home">{{ $till }} </span>

                            </span>
                </h2>

                <div class="mt-4">
                    <x-layout.week-navigator :$numWeek :$year :$selectedWeek :$selectedYear :$previousWeek :$nextWeek  />

                    <div class="clearfix row m-b-0">
                        <div class="col s12 ">
                            @php $id='1'; @endphp
                            <x-old.finance-panel-search :id="$id" :employees="$this->allEmployees" :from="now()->startOfWeek()->format('Y-m-d')" :till="now()->endOfWeek()->format('Y-m-d')"  />
                        </div>

                        <div class="card bg-gray-100 rounded-xl shadow-lg ">
                            <div class="w-full">

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
                                @if($this->populate != null)
                                    @php
                                        $i=0;
//                                    dd($this->populate['employees_services']);
                                    @endphp
                                    {{--                                        {{dd($employees_services)}}--}}
                                    @foreach($this->populate as $key =>  $data)
                                        @php
                                            //                                                    dd($row);
                                        @endphp
                                        <tr class="{{ \App\Helpers\Funcs::altClass($i,['grey lighten-2','']) }} flex-wrap" >
                                            <td>
                                                <a
                                                    href="{{ route('finances.detailer',[
                                                        'id' => $data->id,
                                                        'from' =>Carbon\Carbon::create($from)->format('Y-m-d'),
                                                        'till' =>Carbon\Carbon::create($till)->format('Y-m-d'),
                                                    ] ) }}"
                                                    class="btn-link-underline grey-text text-darken-2 pointer"
                                                >
                                                    <span class="hidden md:block">{{$data->name}}</span>
                                                    <span class="block md:hidden">{{Funcs::nameShort($data->name,' ',2)}}</span>
                                                </a>
                                            </td>
                                            <td>{{$data->total_price}}</td>
                                            <td>{{($data->total_price*0.7)}}</td>
                                            <td>{{($data->total_price*0.3)}}</td>
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
                                                {{ $this->populate->links() }}
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
