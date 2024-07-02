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
                            <x-select-actors id="selectServiceEmployee" name="employee1_id" :employees="$employees" onchange="modal_changes(this,'{{ csrf_token() }}','services')" />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" class="light-green lighten-4">Customer:</th>
                        <td colspan="3" class=" p-l-2">
                            <x-select-actors  id="selectServiceCustomer" name="customer_id" :customers="$customers" onchange="modal_changes(this,'{{ csrf_token() }}','services')"/>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" class="light-green lighten-4 h-45">Address:</th>
                        <td colspan="3"  class="p-l-2">
                            <x-text-input id="serviceAddress" name="address" :formGroupStyle="$style"   onchange="modal_changes(this,'{{ csrf_token() }}','customers')" />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" class="light-green lighten-4">Phone:</th>
                        <td  colspan="3"  class="">
                            <x-text-input id="servicePhone" name="phone" :formGroupStyle="$style" onchange="modal_changes(this,'{{ csrf_token() }}','customers')" />
                        </td>
                    </tr>
                    <tr>
                        <th class="light-green lighten-4">Date:</th><td><x-text-input :formGroupStyle="$style"  id="serviceDate" name="service_date" class="datepicker" onchange="dateTime_change('serviceDate','serviceTime','{{ csrf_token() }}')" /></td>
                        <th class="light-green lighten-4">Time:</th><td><x-text-input  :formGroupStyle="$style"  id="serviceTime" name="service_time" class="timepicker" onchange="dateTime_change('serviceDate','serviceTime','{{ csrf_token() }}')" /></td>
                    </tr>
                    <tr>
                        <th class="light-green lighten-4">In:</th><td><x-text-input :formGroupStyle="$style"  id="serviceInTime"  name="" /> </td>
                        <th class="light-green lighten-4">Out:</th><td> <x-text-input :formGroupStyle="$style"  id="serviceOutTime" name="" /> </td>
                    </tr>

                    <tr><th colspan="4"  class="light-green lighten-4 center-align">Info:</th></tr>
                    <tr>
                        <td  colspan="4"   class="p-1">
                            <textarea name="" id="serviceInformation" cols="30" rows="10">

                            </textarea>
                        </td>
                    </tr>

                    <tr><th colspan="4" class="light-green lighten-4 center-align">notes:</th></tr>
                    <tr>
                        <td  colspan="4" class="p-1">
                            <textarea  name="notes" id="ServiceNotes" cols="30" rows="10"  onchange="modal_changes(this,'{{ csrf_token() }}','customers')">

                            </textarea>
                        </td>
                    </tr>

                    <tr><th colspan="4" class="light-green lighten-4 center-align">instructions for employees:</th></tr>
                    <tr>
                        <td  colspan="4" class="grey-text text-darken-3 p-1">
                            <textarea name="instructions" id="ServiceInstructions" onchange="modal_changes(this,'{{ csrf_token() }}','customers')"  cols="30" rows="10">

                            </textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
{{--                <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>--}}
                <button type="button" class="modal-close btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>