    <div x-data="weekScreen"   class="mt-5">
        <div wire:loading wire:target="thisWeek, backWeek, selectWeek, forwardWeek"  class="absolute top-1/2" style="z-index:1060">
            <div>
                <img src="{{asset('img/loading.gif')}}" alt="loading" class="w-36 " style="margin-left: 40vw; margin-top: 10vh;">
            </div>
        </div>

        <!-- Basic Examples -->

                <div class="card bg-white/60">
                    <div class="w-full header mb-2 justify-center text-center">
                            <span>
                              Week Number <span class="text-gray-900">{{ $numWeek }}</span> / From <span
                                        class="label-date-home">{{ $from }}</span> - Till <span
                                        class="label-date-home">{{ $till }} </span>
                            </span>
                    </div>
                    <div class="body" >
                        <x-flowbite.week-navigation :$route :selected-week="$selectedWeek"  >
                            <x-slot name="btns">
                                <div>
                                    <x-flowbite.btn-blue id="btnNew" title="New Service" x-on:click="openModal()">
                                        New
                                    </x-flowbite.btn-blue>
                                </div>
                                <div class="pt-1">
                                    <x-flowbite.btn-link title="Print weekly report" href="{{route('week.pdf.export',[\Carbon\Carbon::create($from)->format('Y-m-d'),\Carbon\Carbon::create($till)->format('Y-m-d')])}}"
                                        target="_blank"
                                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2 text-center "
                                    >
                                        <i class="fa-duotone fa-print"></i>
                                    </x-flowbite.btn-link >
                                </div>
                            </x-slot>
                        </x-flowbite.week-navigation>
{{--                        {{$this->selectOptionsCustomers}}--}}
                        <x-flowbite.modal-create :cad-open="$showCadModal" :employees="$this->selectOptionsEmployees" :customers="$this->selectOptionsCustomers" :num-week="$numWeek" :$year  :emp-from-open="$this->empFromOpen" />


                        <div >
                            <div class="grid grid-cols-4 gap-4 " >

                                @foreach($this->dataCard() as $empName => $data )
                                    @if(Collect($data['Monday'])->isNotEmpty() || Collect($data['Tuesday'])->isNotEmpty() || Collect($data['Wednesday'])->isNotEmpty() || Collect($data['Thursday'])->isNotEmpty() || Collect($data['Friday'])->isNotEmpty() || Collect($data['Saturday'])->isNotEmpty() || Collect($data['Sunday'])->isNotEmpty())

                                        <x-home-cards  :emp-name="$empName" :$data :$week :employee-id="$this->employeesIds[$empName]" />

                                    @endif
                                @endforeach

                            </div> <!--grid system row-->
                            <div class="grid grid-cols-1 gap-1 md:hidden" >

                                @foreach($this->dataCard() as $empName => $data )
                                    @if(Collect($data['Monday'])->isNotEmpty() || Collect($data['Tuesday'])->isNotEmpty() || Collect($data['Wednesday'])->isNotEmpty() || Collect($data['Thursday'])->isNotEmpty() || Collect($data['Friday'])->isNotEmpty() || Collect($data['Saturday'])->isNotEmpty() || Collect($data['Sunday'])->isNotEmpty())

                                        <x-home-cards  :emp-name="$empName" :$data :$week :employee-id="$this->employeesIds[$empName]" />

                                    @endif
                                @endforeach

                            </div> <!--grid system row-->

                            <x-flowbite.modal-show :open="$showModal" :data-service="$this->modalData??''" :all-customers="$this->selectOptionsCustomers" :all-employees="$this->selectOptionsEmployees" />
                        </div>
                    </div> <!--card body-->
                </div> <!--card -->

<!-- row -->



    </div>

