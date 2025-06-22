<div class="card bg-white/40  mt-5 rounded-xl shadow-lg ">
    <div class=" p-4 border-b">
        <h2>
            RESIDENTIAL FINANCES
        </h2>
    </div>
    <!-- Basic Examples -->

    <div class="card-body">
        <div class="w-full">
            <div class=" bg-white  mt-5 rounded-xl shadow-lg ">
                <h2 class=" p-4 border-b flex w-full">

                            <span class="flex gap-3">
                              <span class="hidden md:block ms-1">Reference</span>  <span> Week Number</span>  <span class="ms-1 me-1 font-bold">{{ $numWeek }}</span> /
                                From <span class="ms-1 font-bold"> {{ $from }}</span> -
                                Till <span class="ms-1 font-bold"> {{ $till }} </span>
                            </span>
                </h2>

                <div class="mt-4">
                    <x-flowbite.week-navigation :$numWeek :$year :$selectedWeek :$selectedYear :$previousWeek :$nextWeek  />

                    <div class="clearfix row m-b-0">
                        <div class="col s12 ">
                            @php $id='1'; @endphp
                            <x-flowbite.finance-panel-search :id="$id" :employees="$this->allEmployees" :from="now()->startOfWeek()->format('Y-m-d')" :till="now()->endOfWeek()->format('Y-m-d')"  />
                        </div>

                        <div class="card bg-gray-100 rounded-xl shadow-lg ">
                            <div class="w-full">

                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Employee</th>
                                    <th scope="col" class="px-6 py-3">Total</th>
                                    <th scope="col" class="px-6 py-3">70%</th>
                                    <th scope="col" class="px-6 py-3">30%</th>
                                    <th scope="col" class="px-6 py-3">&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
{{--                                @php dd($this->populate) @endphp--}}
                                @if($this->populate)
                                    @php
                                        $i=0;
//                                    dd($this->populate['employees_services']);
                                    @endphp
                                    {{--                                        {{dd($employees_services)}}--}}
                                    @foreach($this->populate as $key =>  $data)
                                        @php
                                            //                                                    dd($row);
                                        @endphp
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
                                            </th>
                                            <td class="px-6 py-4">{{$data->total_price}}</td>
                                            <td class="px-6 py-4">{{($data->total_price*0.7)}}</td>
                                            <td class="px-6 py-4">{{($data->total_price*0.3)}}</td>
                                            <td class="px-6 py-4"></td>
                                        </tr>
                                            @php($i++)

                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="px-6 py-4"><p>Services not found in this week</p></td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            </div>
                            <div class="px-6 py-4">
                                                {{ $this->populate->links() }}
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
