<div class="container-fluid" x-data="{
        open: $wire.entangle('showModal'),
        cadOpen: $wire.entangle('showCadModal')
    }">
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
                <x-commercial-cad :employees="$selectOptionsEmployees" :customers="$selectOptionsCustomers" :$numWeek :$year>

                </x-commercial-cad>
                <div class="body">
                    <x-btn-week-navigator  :$selectedWeek>
                        <x-standard-btn class="btn-small" @click="cadOpen = true">   New schedule  </x-standard-btn>
                    </x-btn-week-navigator>
                    <div class="row grid-schedules" id="htmlContent">

                            {!! $this->dataCard() !!}

                    </div> <!--grid system row-->
                </div> <!--card body-->
            </div> <!--card -->


        </div><!-- col -->
        {{--            {{$this->modalData->id??'vazio'}}--}}
    </div>  <!-- row -->
    <x-modal-alphine   :id="$this->modalData->id??'0'">
        <x-slot:title>
            <span wire:loading.remove> {{$this->modalData->customer->name??'Loading...'}} </span>
            <span wire:loading>Loading...</span>
            @foreach ($errors->all() as $error)
                <span class="red-text text-darken-4">{{ $error }}</span>
            @endforeach
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
        <table wire:loading.remove class="table-modal-services-details ">
            <tr>
                <th colspan="1" class="green">Employee:</th>
                <td colspan="3" >
                    <x-livewire-select-modal
                            wire:model="employee1_id"
                            wire:change="field_change('employee1_id')"
                            id="selectServiceEmployee"
                            class="p-l-0"
                            :data="$selectOptionsEmployees"
                            :selected="$this->modalData->employee->id??''"
                    />
                </td>
            </tr>
            <tr>
                <th colspan="1" class="green h-30 w-20p">Customer:</th>
                <td class="w-30p">
                    <x-livewire-select-modal
                            wire:model="customer_id"
                            wire:change="field_change('customer_id')"
                            class="p-l-0"
                            id="selectServiceCustomer"
                            :data="$selectOptionsCustomers"
                            :selected="$this->modalData->customer->id??''"
                    />
                </td>
                <th class="green h-30">Denomination:</th>
                <td class="w-30p">
                    <x-text-input
                            wire:model.blur="denomination"
                            wire:change="field_change('denomination')"
                            class="p-l-2 h-30 font-12 grey-text text-darken-4"
                            id="denomination"
                    />
                </td>

            </tr>
            <tr>
                <th colspan="1" class="green font-12 h-30">Address:</th>
                <td colspan="3"  >
                    <x-text-input
                            wire:model.blur="address"
                            wire:change="field_change('address')"
                            class="p-l-2 h-30 font-12 grey-text text-darken-4"
                            id="ScheduleAddress"
                            type="text"
                    />
                </td>
            </tr>
            <tr>
                <th colspan="1" class="green h-30">Phone:</th>
                <td  colspan="3"  >
                    <x-text-input
                            wire:model="phone"
                            wire:change.blur="field_change('phone')"
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
                            wire:model.blur="service_date"
                            wire:change="field_change('schedule_date')"
                            id="scheduleDate"
                            class="p-l-2 modal-residential-change h-30 font-12 grey-text text-darken-4"
                    />
                </td>
            </tr>
            <tr>
                <th class="green h-30">In:</th>
                <td>
                    <x-time-flat-pickr

                            wire:model.blur="checkin_datetime"
                            wire:change="field_change('checkin_datetime')"
                            id="scheduleInTime"
                            class="p-l-2 modal-residential-change h-30 font-12 grey-text darken-4"
                    />
                </td>
                <th class="green h-30">Out:</th>
                <td>
                    <x-time-flat-pickr
                            wire:model.blur="checkout_datetime"
                            wire:change="field_change('checkout_datetime')"
                            class="p-l-2 modal-residential-change h-30 font-12 grey-text darken-4"
                            id="scheduleOutTime"
                    />
                </td>
            </tr>

            <tr class="hide"><th colspan="4"  class="green  center-align">Info:</th></tr>
            <tr class="hide">
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
                                    id="scheduleNotes"
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
                                    id="scheduleInstructions"
                                    class="modal-residential-change"
                                    cols="30" rows="10">

                            </textarea>
                </td>
            </tr>
        </table>
    <x-slot name="footer">
        <div>
            <button type="button"
                    wire:click="delete"
                    @click="open = false"
                    class=" btn-custom btn-link btn-small red darken-3  z-depth-3"
                    id="btnDeleteSchedule"
            >
                <span class="material-symbols-outlined">
                    delete
                </span>
            </button>
        </div>
        <div>
            <button type="button"  @click="open = false" class=" btn-custom btn-link btn-small green darken-3  z-depth-3" data-dismiss="modal">CLOSE</button>
        </div>
    </x-slot>
    </x-modal-alphine>
    <x-custom-events />


</div>

