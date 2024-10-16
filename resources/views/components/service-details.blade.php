@php
    $style='style=margin-bottom:0;';

@endphp

<div class="modal fade in" id="largeModal" tabindex="-1" role="dialog" style="display: block;">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-white">
            <div class="modal-header">
                <h5 class="modal-title green-text text-darken-4" id="defaultModalLabel">Modal title</h5>
            </div>
            <div class="modal-body bg-white green-text text-darken-4">
                <span class="hide" id="serviceId"></span>

                <table class="table-modal-services-details">
                    <tr>
                        <th colspan="1" class="green">Employee:</th>
                        <td colspan="3" class="p-l-2">
                            <x-select-actors id="selectServiceEmployee" name="employee1_id"  :employees="$employees" class="modal-residential-change" data-token="{{ csrf_token() }}" data-db-model="services"  />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" class="green h-30">Customer:</th>
                        <td colspan="3" class=" ">
                            <x-select-actors class="p-l-2" id="selectServiceCustomer" name="customer_id" class="modal-residential-change" :customers="$customers" data-token="{{ csrf_token() }}" data-db-model="services" />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" class="green  h-30">Address:</th>
                        <td colspan="3"  class="p-l-2">
                            <x-text-input id="serviceAddress" name="address" :formGroupStyle="$style" class="modal-residential-change h-30" data-token="{{ csrf_token() }}" data-db-model="customers"   />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" class="green h-30">Phone:</th>
                        <td  colspan="3"  class="p-l-2">
                            <x-text-input id="servicePhone" name="phone" :formGroupStyle="$style" class="modal-residential-change" data-token="{{ csrf_token() }}" data-db-model="customers"  />
                        </td>
                    </tr>
                    <tr>
                        <th class="green h-30">Date:</th><td><x-date-flat-pickr :formGroupStyle="$style"  id="serviceDate" name="service_date" class="modal-residential-change h-30 font-12 grey-text text-darken-4" data-token="{{ csrf_token() }}" data-db-model="services"/></td>
                        <th class="green h-30">Time:</th><td><x-time-flat-pickr :formGroupStyle="$style"  id="serviceTime" name="service_time" class="modal-residential-change h-30 font-12 grey-text text-darken-4" data-token="{{ csrf_token() }}"  data-db-model="services" /></td>
                    </tr>
                    <tr>
                        <th class="green h-30">In:</th><td><x-time-flat-pickr :formGroupStyle="$style" class="modal-residential-change h-30 font-12 grey-text darken-4" id="serviceInTime"  name="in" data-token="{{ csrf_token() }}"  data-db-model="control"  /></td>
                        <th class="green h-30">Out:</th><td><x-time-flat-pickr :formGroupStyle="$style"  class="modal-residential-change h-30 font-12 grey-text darken-4" id="serviceOutTime" name="out" data-token="{{ csrf_token() }}"  data-db-model="control" /> </td>
                    </tr>

                    <tr class="hide"><th colspan="4"  class="green  center-align">Info:</th></tr>
                    <tr class="hide">
                        <td  colspan="4"   class="p-1">
                            <textarea name="info" id="serviceInformation" class="modal-residential-change" data-token="{{ csrf_token() }}"  data-db-model="services"  cols="30" rows="10">

                            </textarea>
                        </td>
                    </tr>

                    <tr><th colspan="4" class="green  center-align">notes:</th></tr>
                    <tr>
                        <td  colspan="4" class="p-1">
                            <textarea  name="notes" id="ServiceNotes" class="modal-residential-change" data-token="{{ csrf_token() }}"  data-db-model="services"  cols="30" rows="10" >

                            </textarea>
                        </td>
                    </tr>

                    <tr><th colspan="4" class="green  center-align">instructions for employees:</th></tr>
                    <tr>
                        <td  colspan="4" class="grey-text text-darken-3 p-1">
                            <textarea name="instructions" id="ServiceInstructions" class="modal-residential-change" data-token="{{ csrf_token() }}"  data-db-model="services"  cols="30" rows="10">

                            </textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <div>
                    <button
                            class="btn btn-link btn-small orange darken-3 font-small z-depth-3 btnFeeService"
                            id="btnFeeService"
                            data-service-id=""
                            data-num-week=""
                            data-year=""
                    >
                        <span class="material-symbols-outlined">
                            cancel
                        </span>
                    </button>
                    <button type="button" class=" btn-custom btn-link btn-small red darken-3   z-depth-3 btnDeleteService" id="btnDeleteService" data-service-id="">
                        <span class="material-symbols-outlined">
                            delete
                        </span>
                    </button>
                    <button type="button" class="modal-close btn-custom btn-link btn-small green darken-3  z-depth-3" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
</div>

