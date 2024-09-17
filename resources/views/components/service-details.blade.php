@php
    $style='style=margin-bottom:0;';

@endphp

<div class="modal fade in" id="largeModal" tabindex="-1" role="dialog" style="display: block;">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-white">
            <div class="modal-header">
                <h4 class="modal-title green-text text-darken-4" id="defaultModalLabel">Modal title</h4>
            </div>
            <div class="modal-body bg-white green-text text-darken-4">
                <span class="hide" id="serviceId"></span>

                <table class="table-modal-services-details">
                    <tr>
                        <th colspan="1" class="green ">Employee:</th>
                        <td colspan="3" class="p-l-2">
                            <x-select-actors id="selectServiceEmployee" name="employee1_id"  :employees="$employees" class="modal-residential-change" data-token="{{ csrf_token() }}" data-db-model="services"  />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" class="green ">Customer:</th>
                        <td colspan="3" class=" p-l-2">
                            <x-select-actors class="" id="selectServiceCustomer" name="customer_id" class="modal-residential-change" :customers="$customers" data-token="{{ csrf_token() }}" data-db-model="services" />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" class="green  h-45">Address:</th>
                        <td colspan="3"  class="p-l-2">
                            <x-text-input id="serviceAddress" name="address" :formGroupStyle="$style" class="modal-residential-change" data-token="{{ csrf_token() }}" data-db-model="customers"   />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" class="green ">Phone:</th>
                        <td  colspan="3"  class="">
                            <x-text-input id="servicePhone" name="phone" :formGroupStyle="$style" class="modal-residential-change" data-token="{{ csrf_token() }}" data-db-model="customers"  />
                        </td>
                    </tr>
                    <tr>
                        <th class="green ">Date:</th><td><x-text-input :formGroupStyle="$style"  id="serviceDate" name="service_date" class="datepicker modal-residential-change" data-token="{{ csrf_token() }}" data-db-model="services" /></td>
                        <th class="green ">Time:</th><td><x-text-input  :formGroupStyle="$style"  id="serviceTime" name="service_time" class="timepicker modal-residential-change" data-token="{{ csrf_token() }}"  data-db-model="services" /></td>
                    </tr>
                    <tr>
                        <th class="green ">In:</th><td><x-text-input :formGroupStyle="$style" class="modal-residential-change" id="serviceInTime"  name="in" data-token="{{ csrf_token() }}"  data-db-model="control" /> </td>
                        <th class="green ">Out:</th><td> <x-text-input :formGroupStyle="$style"  class="modal-residential-change" id="serviceOutTime" name="out" data-token="{{ csrf_token() }}"  data-db-model="control" /> </td>
                    </tr>

                    <tr><th colspan="4"  class="green  center-align">Info:</th></tr>
                    <tr>
                        <td  colspan="4"   class="p-1">
                            <textarea name="info" id="serviceInformation" class="modal-residential-change" data-token="{{ csrf_token() }}"  data-db-model="customers"  cols="30" rows="10">

                            </textarea>
                        </td>
                    </tr>

                    <tr><th colspan="4" class="green  center-align">notes:</th></tr>
                    <tr>
                        <td  colspan="4" class="p-1">
                            <textarea  name="notes" id="ServiceNotes" cols="30" rows="10" class="modal-residential-change" data-token="{{ csrf_token() }}"  data-db-model="customers"  cols="30" rows="10" >

                            </textarea>
                        </td>
                    </tr>

                    <tr><th colspan="4" class="green  center-align">instructions for employees:</th></tr>
                    <tr>
                        <td  colspan="4" class="grey-text text-darken-3 p-1">
                            <textarea name="instructions" id="ServiceInstructions" class="modal-residential-change" data-token="{{ csrf_token() }}"  data-db-model="customers"  cols="30" rows="10">

                            </textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <div>
                    <button
                            class="btn btn-link orange darken-3 z-depth-3 btnFeeService"
                            id="btnFeeService"
                            data-service-id=""
                            data-num-week=""
                            data-year=""
                    >
                        <span class="material-symbols-outlined">
                            cancel
                        </span>
                    </button>
                    <button type="button" class=" btn-custom btn-link red darken-3   z-depth-3 btnDeleteService" id="btnDeleteService" data-service-id="">
                        <span class="material-symbols-outlined">
                            delete
                        </span>
                    </button>
                    <button type="button" class="modal-close btn-custom btn-link green darken-3  z-depth-3" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
</div>

