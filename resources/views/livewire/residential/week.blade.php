    <div class="container-fluid">
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
                              Week Number <span class="yellow-text text-darken-4">{{ $numWeek }}</span> / From <span
                                        class="label-date-home">{{ $from }}</span> - Till <span
                                        class="label-date-home">{{ $till }} </span><div class="displaytest">Iphone</div>
                            </span>
                            <span> erro no servidor contornado Tela sendo Refeita porem ao cancelar o serviço a janela de exibição é desativada, volta recarregando a página. é preciso revisar 12 arquvos .
                            </span>
                    </div>
                    <x-service-cad :employees="$selectOptionsEmployees" :customers="$selectOptionsCustomers" :num-week="$numWeek" :$year>

                    </x-service-cad>
                    <div class="body">
                        <x-btn-week-navigator :$route :$selectedWeek>
                            <x-standard-btn >   New service  </x-standard-btn>
                        </x-btn-week-navigator>
                        <div class="row" id="htmlContent">
                            {!! $this->dataCard() !!}
                        </div> <!--grid system row-->
                    </div> <!--card body-->
                </div> <!--card -->


            </div><!-- col -->
            {{$this->modalData->id??'vazio'}}
        </div>  <!-- row -->
        <x-service-details  :id="$this->modalData->id??'0'">
            <x-slot:title>
                {{$this->modalData->customer->name??''}}
            </x-slot>
            <table class="table-modal-services-details">
                <tr>
                    <th colspan="1" class="green">Employee:</th>
                    <td colspan="3" >
                        <x-livewire-select-modal
                                wire:model="employee1_id"
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
                                class="p-l-2 h-30 font-12 grey-text text-darken-4"
                                id="serviceAddress"
                                type="text"
                        />
                    </td>
                </tr>
                <tr>
                    <th colspan="1" class="green h-30">Phone:</th>
                    <td  colspan="3"  >
                        <x-text-input wire:model="phone" class="p-l-2 h-30 font-12 grey-text text-darken-4" id="servicePhone" type="text" />
                    </td>
                </tr>
                <tr>
                    <th class="green h-30">Date:</th>
                    <td>

                        <x-date-flat-pickr
                                wire:model="service_date"
                                id="serviceDate"
                                class="p-l-2 modal-residential-change h-30 font-12 grey-text text-darken-4"
                        />
                    </td>
                    <th class="green h-30">Time:</th>

                    <td><x-time-flat-pickr
                                wire:model="service_time"
                                id="serviceTime"
                                class="p-l-2 modal-residential-change h-30 font-12 grey-text text-darken-4"
                        />
                    </td>
                </tr>
                <tr>
                    <th class="green h-30">In:</th>
                    <td>
                        <x-time-flat-pickr
                                wire:model="checkin_datetime"
                                id="serviceInTime"
                                class="p-l-2 modal-residential-change h-30 font-12 grey-text darken-4"
                        />
                    </td>
                    <th class="green h-30">Out:</th>
                    <td>
                        <x-time-flat-pickr
                                wire:model="checkout_datetime"
                                class="p-l-2 modal-residential-change h-30 font-12 grey-text darken-4"
                                id="serviceOutTime"
                        />
                    </td>
                </tr>

                <tr class="hide"><th colspan="4"  class="green  center-align">Info:</th></tr>
                <tr class="hide">
                    <td  colspan="4"   class="p-1">
                            <textarea wire:model="info"
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
                                    wire:model="notes"
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

