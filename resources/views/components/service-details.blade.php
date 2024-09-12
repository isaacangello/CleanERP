@php
    $style='style=margin-bottom:0;';


@endphp

<div class="modal fade in" id="largeModal" tabindex="-1" role="dialog" style="display: block;">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-teal">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Modal title</h4>
            </div>
            <div class="modal-body bg-white green-text text-darken-4">
                <span class="hide" id="serviceId"></span>

                <table class="table-modal-services-details">
                    <tr>
                        <th colspan="1" class="light-green lighten-4">Employee:</th>
                        <td colspan="3" class="p-l-2">
                            <x-select-actors id="selectServiceEmployee" name="employee1_id"  :employees="$employees" class="modal-residential-change" data-token="{{ csrf_token() }}" data-db-model="services"  />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" class="light-green lighten-4">Customer:</th>
                        <td colspan="3" class=" p-l-2">
                            <x-select-actors class="" id="selectServiceCustomer" name="customer_id" class="modal-residential-change" :customers="$customers" data-token="{{ csrf_token() }}" data-db-model="services" />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" class="light-green lighten-4 h-45">Address:</th>
                        <td colspan="3"  class="p-l-2">
                            <x-text-input id="serviceAddress" name="address" :formGroupStyle="$style" class="modal-residential-change" data-token="{{ csrf_token() }}" data-db-model="customers"   />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" class="light-green lighten-4">Phone:</th>
                        <td  colspan="3"  class="">
                            <x-text-input id="servicePhone" name="phone" :formGroupStyle="$style" class="modal-residential-change" data-token="{{ csrf_token() }}" data-db-model="customers"  />
                        </td>
                    </tr>
                    <tr>
                        <th class="light-green lighten-4">Date:</th><td><x-text-input :formGroupStyle="$style"  id="serviceDate" name="service_date" class="datepicker modal-residential-change" data-token="{{ csrf_token() }}" data-db-model="services" /></td>
                        <th class="light-green lighten-4">Time:</th><td><x-text-input  :formGroupStyle="$style"  id="serviceTime" name="service_time" class="timepicker modal-residential-change" data-token="{{ csrf_token() }}"  data-db-model="services" /></td>
                    </tr>
                    <tr>
                        <th class="light-green lighten-4">In:</th><td><x-text-input :formGroupStyle="$style" class="modal-residential-change" id="serviceInTime"  name="in" data-token="{{ csrf_token() }}"  data-db-model="control" /> </td>
                        <th class="light-green lighten-4">Out:</th><td> <x-text-input :formGroupStyle="$style"  class="modal-residential-change" id="serviceOutTime" name="out" data-token="{{ csrf_token() }}"  data-db-model="control" /> </td>
                    </tr>

                    <tr><th colspan="4"  class="light-green lighten-4 center-align">Info:</th></tr>
                    <tr>
                        <td  colspan="4"   class="p-1">
                            <textarea name="info" id="serviceInformation" class="modal-residential-change" data-token="{{ csrf_token() }}"  data-db-model="customers"  cols="30" rows="10">

                            </textarea>
                        </td>
                    </tr>

                    <tr><th colspan="4" class="light-green lighten-4 center-align">notes:</th></tr>
                    <tr>
                        <td  colspan="4" class="p-1">
                            <textarea  name="notes" id="ServiceNotes" cols="30" rows="10" class="modal-residential-change" data-token="{{ csrf_token() }}"  data-db-model="customers"  cols="30" rows="10" >

                            </textarea>
                        </td>
                    </tr>

                    <tr><th colspan="4" class="light-green lighten-4 center-align">instructions for employees:</th></tr>
                    <tr>
                        <td  colspan="4" class="grey-text text-darken-3 p-1">
                            <textarea name="instructions" id="ServiceInstructions" class="modal-residential-change" data-token="{{ csrf_token() }}"  data-db-model="customers"  cols="30" rows="10">

                            </textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-link btnDeleteService" id="btnDeleteService" data-service-id="">
                    <span class="material-symbols-outlined">
                    delete
                    </span>
                </button>
                <button type="button" class="modal-close btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>