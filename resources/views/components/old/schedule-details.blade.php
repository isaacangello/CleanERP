@php
    $style='style=margin-bottom:0;';
@endphp

<div class="modal fade in" id="scheduleModal" tabindex="-1" role="dialog" style="display: block;">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-teal">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Modal title</h5>
            </div>
            <div class="modal-body bg-white green-text text-darken-4">
                <span class="hide" id="scheduleId"></span>

                <table class="table-modal-details">
                    <tr>
                        <th colspan="1" class="light-green lighten-4">Employee:</th>
                        <td colspan="3" class="p-l-2">
                            <x-select-actors id="selectScheduleEmployee" name="employee1_id" :employees="$employees" class="modal-commercial-change" data-token="{{ csrf_token() }}" data-db-model="schedule"  />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" class="light-green lighten-4">Customer:</th>
                        <td colspan="3" class=" p-l-2">
                            <x-select-actors  id="selectScheduleCustomer" name="customer_id" :customers="$customers" class="modal-commercial-change" data-token="{{ csrf_token() }}" data-db-model="schedule"/>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" class="light-green lighten-4 ">Address:</th>
                        <td colspan="3"  class="p-l-2">
                            <x-text-input id="scheduleAddress" name="address" :formGroupStyle="$style"   class="modal-commercial-change" data-token="{{ csrf_token() }}" data-db-model="customers" />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" class="light-green lighten-4">Phone:</th>
                        <td  colspan="3"  class="">
                            <x-text-input id="schedulePhone" name="phone" :formGroupStyle="$style" class="modal-commercial-change" data-token="{{ csrf_token() }}" data-db-model="customers"  />
                        </td>
                    </tr>
                    <tr>
                        <th class="light-green lighten-4">Date:</th><td><x-date-flat-pickr :formGroupStyle="$style"  id="scheduleDate" name="schedule_date" class="modal-commercial-change font-12 h-30" data-token="{{ csrf_token() }}" data-db-model="schedule"  /></td>
                        <th class="light-green lighten-4">Period:</th><td>
{{--                            <select name="schedule_time" id="schedulePeriod" class="materialize-select browser-default modal-commercial-change h-30" data-token="{{ csrf_token() }}" data-db-model="schedule">--}}
{{--                                <option value="08:00">First</option>--}}
{{--                                <option value="13:00">Second</option>--}}
{{--                                <option value="18:01">Third</option>--}}
{{--                            </select>--}}
                            <x-text-input  :formGroupStyle="$style"  id="schedulePeriod" name="period" class="modal-commercial-change" data-token="{{ csrf_token() }}" data-db-model="schedule" />
                        </td>
                    </tr>
                    <tr>
                        <th class="light-green lighten-4">In:</th><td><x-time-flat-pickr :formGroupStyle="$style"  id="scheduleInTime"  name="in" class="modal-commercial-change font-12 h-30" data-token="{{ csrf_token() }}" data-db-model="control" /> </td>
                        <th class="light-green lighten-4">Out:</th><td> <x-time-flat-pickr :formGroupStyle="$style"  id="scheduleOutTime" name="out" class="modal-commercial-change font-12 h-30" data-token="{{ csrf_token() }}" data-db-model="control" /> </td>
                    </tr>

{{--                    <tr><th colspan="4"  class="light-green lighten-4 center-align">Info:</th></tr>--}}
{{--                    <tr>--}}
{{--                        <td  colspan="4"   class="p-1">--}}
{{--                            <textarea name="info" id="scheduleInformation" cols="30" rows="10" class="modal-commercial-change" data-token="{{ csrf_token() }}" data-db-model="schedule">--}}

{{--                            </textarea>--}}
{{--                        </td>--}}
{{--                    </tr>--}}

                    <tr>
                        <th colspan="4" class="light-green lighten-4 center-align">notes:</th>
                    </tr>
                    <tr>
                        <td  colspan="4" class="p-1">
                            <textarea  name="notes" id="scheduleNotes" cols="30" rows="10" class="modal-commercial-change" data-token="{{ csrf_token() }}" data-db-model="schedule">

                            </textarea>
                        </td>
                    </tr>

                    <tr><th colspan="4" class="light-green lighten-4 center-align">instructions for employees:</th></tr>
                    <tr>
                        <td  colspan="4" class="grey-text text-darken-3 p-1">
                            <textarea name="instructions" id="scheduleInstructions" class="modal-commercial-change" data-token="{{ csrf_token() }}" data-db-model="schedule" >

                            </textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnDelete" class="btn btn-link btn-small btn-danger "
                        data-schedule-id=""
                        data-token="{{ csrf_token() }}"
                        data-db-model="schedule.delete"
                        data-nun-week="{{ $numWeek }}"
                        data-year="{{ $year }}"
                >
                    <span class="material-symbols-outlined">
                    delete
                    </span>
                </button>
                <button type="button" class="modal-close btn btn-link btn-small" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>