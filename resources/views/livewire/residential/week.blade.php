    <div class="container-fluid" x-data="{
        open: $wire.entangle('showModal'),
        cadOpen: $wire.entangle('showCadModal'),
        focusables() {
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)]
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 }    }">
        <div wire:loading wire:target="thisWeek, backWeek, selectWeek, forwardWeek"  class="absolute top-1/2" style="z-index:1060">
            <div>
                <img src="{{asset('img/loading.gif')}}" alt="loading" class="w-36 " style="margin-left: 40vw; margin-top: 10vh;">
            </div>
        </div>


        <div class="block-header">
            <h2>
                <small>EMPLOYEES SERVICES</small>
            </h2>

        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                            <span>
                              Week Number <span class="yellow-text text-darken-4 font-bold">{{ $numWeek }}</span> / From <span
                                        class="label-date-home">{{ $from }}</span> - Till <span
                                        class="label-date-home">{{ $till }} </span><div class="displaytest">Iphone</div>
                            </span>
                            <span>
                            </span>
                    </div>
                    <x-service-cad :employees="$selectOptionsEmployees" :customers="$selectOptionsCustomers" :num-week="$numWeek" :$year :$populateBillings :emp-from-open="$this->empFromOpen">

                    </x-service-cad>
                    <div class="body">
                        <x-btn-week-navigator :$route :$selectedWeek>
                            <x-slot:btn>
                                <x-link-btn title="Print weekly report" href="{{route('week.pdf.export',[\Carbon\Carbon::create($from)->format('Y-m-d'),\Carbon\Carbon::create($till)->format('Y-m-d')])}}" class="btn-small z-depth-3" >
                                    Print
                                </x-link-btn>
                            </x-slot>

                                <x-standard-btn class="btn-small" @click="cadOpen = true" title="New Service">New</x-standard-btn>


                        </x-btn-week-navigator>
                        <x-btn-week-mobile-navigator :$route :$selectedWeek>
                            <x-standard-btn class="btn-small" @click="cadOpen = true" title="New Service">   New  </x-standard-btn>
                        </x-btn-week-mobile-navigator>

                        <div class="grid grid-cols-4 gap-4 hide-on-small-and-down" >

                            @foreach($this->dataCard() as $empName => $data )
                                @if(Collect($data['Monday'])->isNotEmpty() || Collect($data['Tuesday'])->isNotEmpty() || Collect($data['Wednesday'])->isNotEmpty() || Collect($data['Thursday'])->isNotEmpty() || Collect($data['Friday'])->isNotEmpty() || Collect($data['Saturday'])->isNotEmpty() || Collect($data['Sunday'])->isNotEmpty())

                                    <x-home-cards  :emp-name="$empName" :$data :$week :employee-id="$this->employeesIds[$empName]" />

                                @endif
                            @endforeach

                        </div> <!--grid system row-->
                        <div class="grid grid-cols-1 gap-1 hide-on-med-and-up" >

                            @foreach($this->dataCard() as $empName => $data )
                                @if(Collect($data['Monday'])->isNotEmpty() || Collect($data['Tuesday'])->isNotEmpty() || Collect($data['Wednesday'])->isNotEmpty() || Collect($data['Thursday'])->isNotEmpty() || Collect($data['Friday'])->isNotEmpty() || Collect($data['Saturday'])->isNotEmpty() || Collect($data['Sunday'])->isNotEmpty())

                                    <x-home-cards  :emp-name="$empName" :$data :$week :employee-id="$this->employeesIds[$empName]" />

                                @endif
                            @endforeach

                        </div> <!--grid system row-->
                    </div> <!--card body-->
                </div> <!--card -->


            </div><!-- col -->
{{--            {{$this->modalData->id??'vazio'}}--}}
        </div>  <!-- row -->
        <x-service-details   :id="$this->modalData->id??'0'" :showModal="$this->showModal" >
            <x-slot:title>
                <span wire:loading.remove> {{$this->modalData->customer->name??'Loading...'}}</span> {!! $this->customer_type !!}
                    <span wire:loading>Loading...</span>
            </x-slot>
            <table  wire:loading style="width: 100%; border-collapse: collapse;  height:40vh; ">
                <tbody>
                <tr>

                    <td style="width: 40vw; border-bottom:none!important;">


                         <div  wire:loading.flex  style="margin-left: 22vw; margin-top: 10vh" >

                                <div style="width: 25vw;">
                                    <div class="preloader pl-size-xl">
                                        <div class="spinner-layer pl-teal">
                                            <div class="circle-clipper left">
                                                <div class="circle"></div>
                                            </div>
                                            <div class="circle-clipper right">
                                                <div class="circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <p>Please wait...</p>
                                </div>

                         </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table wire:loading.remove class="table-modal-services-details">
                <tr>
                    <th colspan="1" class="green">Employee:</th>
                    <td colspan="3" >
                        <x-livewire-select-modal
                                wire:model.="employee1_id"
                                wire:change="field_change('employee1_id')"
                                id="selectServiceEmployee"
                                class="p-l-0"
                                :data="$selectOptionsEmployees"
                                :selected="$this->modalData->employee->id??''"
                        />
                    </td>
                </tr>
                <tr>
                    <th colspan="1" class="green h-30">Customer:</th>
                    <td colspan="3" class=" ">
                        <x-livewire-select-modal
                                wire:model="customer_id"
                                wire:change="field_change('customer_id')"
                                class="p-l-0"
                                id="selectServiceCustomer"
                                :data="$selectOptionsCustomers"
                                :selected="$this->modalData->customer->id??''"
                        />
                    </td>
                </tr>
                <tr>
                    <th colspan="1" class="green font-12 h-30">Address:</th>
                    <td colspan="3"  >
                        <x-text-input
                                wire:model="address"
                                wire:change="field_change('address')"
                                class="p-l-2 h-30 font-12 grey-text text-darken-4"
                                id="serviceAddress"
                                type="text"
                        />
                    </td>
                </tr>
                <tr>
                    <th colspan="1" class="green h-30">Phone:</th>
                    <td  colspan="3"  >
                        <x-text-input
                                wire:model="phone"
                                wire:change="field_change('phone')"
                                class="p-l-2 h-30 font-12 grey-text text-darken-4"
                                id="servicePhone"
                                type="text"
                        />
                    </td>
                </tr>
                <tr>
                    <th class="green h-30">Date:</th>
                    <td colspan="3">
                        <x-date-flat-pickr
                                wire:model="service_date"
                                wire:change.debounce.3000ms="field_change('service_date')"
                                id="serviceDate"
                                class="p-l-2 modal-residential-change h-30 font-12 grey-text text-darken-4"
                        />
                    </td>
                </tr>
                <tr>
                    <th class="green h-30">In:</th>
                    <td>
                        <x-time-flat-pickr

                                wire:model="checkin_datetime"
                                wire:change.debounce.3000ms="field_change('checkin_datetime')"
                                id="serviceInTime"
                                class="p-l-2 modal-residential-change h-30 font-12 grey-text darken-4"
                        />
                    </td>
                    <th class="green h-30">Out:</th>
                    <td>
                        <x-time-flat-pickr
                                wire:model="checkout_datetime"
                                wire:change.debounce.3000ms="field_change('checkout_datetime')"
                                class="p-l-2 modal-residential-change h-30 font-12 grey-text darken-4"
                                id="serviceOutTime"
                        />
                    </td>
                </tr>

                <tr><th colspan="4"  class="green  center-align">Info:</th></tr>
                <tr>
                    <td  colspan="4"   class="p-1">
                            <textarea wire:model.blur="info"
                                      wire:change="field_change('info')"
                                      id="serviceInformation"
                                      class="p-l-2 modal-residential-change" cols="30" rows="10"
                            >

                            </textarea>
                    </td>
                </tr>

                <tr><th colspan="4" class="green  center-align">notes:</th></tr>
                <tr>
                    <td  colspan="4" class="p-1">
                            <textarea
                                    wire:model.blur="notes"
                                    wire:change="field_change('notes')"
                                    id="ServiceNotes"
                                    class="p-l-2 modal-residential-change"  cols="30" rows="10"
                            >

                            </textarea>
                    </td>
                </tr>

                <tr><th colspan="4" class="green  center-align">instructions for employees:</th></tr>
                <tr>
                    <td  colspan="4" class="grey-text text-darken-3 p-1">
                            <textarea
                                    wire:model="instructions"
                                    wire:change.blur="field_change('instructions')"
                                    id="ServiceInstructions"
                                    class="modal-residential-change"
                                    cols="30" rows="10">

                            </textarea>
                    </td>
                </tr>
            </table>

        </x-service-details>
        <x-custom-events />


    </div>

