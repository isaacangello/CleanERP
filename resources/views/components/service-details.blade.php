
<!-- Modal Structure -->
{{--<div id="largeModal" class="modal modal-fixed-footer" tabindex="-1" role="dialog">--}}
{{--    <div class="modal-content">--}}
{{--        <h4>Modal Header</h4>--}}
{{--        <p>A bunch of text</p>--}}
{{--    </div>--}}
{{--    <div class="modal-footer">--}}
{{--        <a href="#" class="modal-close waves-effect waves-green btn-flat">Agree</a>--}}
{{--    </div>--}}
{{--</div>--}}
{{--
Address: 2777 NE 24th Street, The Lighthouse Point, 33064
Phone: 6465461182
Date: 06/14/2024
--}}
<div class="modal fade in" id="largeModal" tabindex="-1" role="dialog" style="display: block;">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-col-teal">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Modal title</h4>
            </div>
            <div class="modal-body bg-white green-text text-darken-4">
                <table class="table-modal-services-details">
                    <tr>
                        <th colspan="1" class="light-green lighten-4">Employee:</th>
                        <td colspan="3" class="p-l-2">
                            <x-select-actors :employees="$employees" />
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1" class="light-green lighten-4">Customer:</th>
                        <td colspan="3" class=" p-l-2">
                            <x-select-actors  :customers="$customers" />
                        </td>
                    </tr>
                    <tr><th colspan="1" class="light-green lighten-4 h-45">Address:</th><td colspan="3" id="serviceAddress" class="p-l-2"> dado</td></tr>
                    <tr><th colspan="1" class="light-green lighten-4">Phone:</th><td  colspan="3" id="servicePhone" class=""> dado</td></tr>
                    <tr>
                        <th class="light-green lighten-4">Date:</th><td id="serviceDate" class=""> dado</td>
                        <th class="light-green lighten-4">Time:</th><td id="serviceTime" class=""> dado</td>
                    </tr>
                    <tr>
                        <th class="light-green lighten-4">In:</th><td id="serviceInTime" class=""> dado</td>
                        <th class="light-green lighten-4">Out:</th><td id="serviceOutTime" class=""> dado</td>
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
                            <textarea name="" id="ServiceNotes" cols="30" rows="10">

                            </textarea>
                        </td>
                    </tr>

                    <tr><th colspan="4" class="light-green lighten-4 center-align">instructions for employees:</th></tr>
                    <tr>
                        <td  colspan="4" class="grey-text text-darken-3 p-1">
                            <textarea name="" id="ServiceInstructions" cols="30" rows="10">

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