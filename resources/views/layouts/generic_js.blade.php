@use(Illuminate\Support\Facades\Vite)
{{--    <script src="web/systheme/plugins/jquery/jquery.min.js"></script>--}}
<!-- Jquery core js -->
<script src="{{Vite::asset('resources/web/jquery/jquery-3.7.1.min.js')}}"></script>
<!-- Jquery-ui Js -->
<script src="{{Vite::asset('resources/web/jquery-ui/jquery-ui.js')}}"></script>

<!-- Materialize Core Js -->
{{--    <script src="web/bootstrap/bootstrap.min.js"></script>--}}
<script src="{{ Vite::asset('resources/web/materialize/js/materialize.min.js') }}"></script>

<!-- Waves Effect Plugin Js -->
{{--<script src="{{Vite::asset('resources/web/systheme/plugins/node-waves/waves.js')}}"></script>--}}
<script src="{{Vite::asset('node_modules/node-waves/dist/waves.min.js')}}"></script>

<!-- Select Plugin Js -->
{{--    <script src="web/systheme/plugins/bootstrap-select/js/bootstrap-select.js"></script>--}}

<!-- Slimscroll Plugin Js -->
<script src="{{Vite::asset('resources/web/systheme/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

<!-- Jquery Validation Plugin Css -->
{{--    <script src="{{ Vite::asset('web/systheme/plugins/jquery-validation/jquery.validate.js') }}"></script>--}}

<!-- JQuery Steps Plugin Js -->
<script src="{{Vite::asset('resources/web/systheme/plugins/jquery-steps/jquery.steps.js')}}"></script>

<!-- Sweet Alert Plugin Js -->
<!--Added version 2 -->
{{--<script src="{{Vite::asset('resources/web/systheme/plugins/sweetalert/sweetalert.min.js')}}"></script>--}}
<script src="{{ Vite::asset('node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<!-- Custom Js -->
<script src="{{ Vite::asset('resources/web/systheme/js/admin.js') }}"></script>
{{--    <script src="resources/web/systheme/js/pages/tables/jquery-datatable.js"></script>--}}
<script src="{{ Vite::asset('resources/web/systheme/js/pages/index.js') }}"></script>
<script src="{{ Vite::asset('resources/web/systheme/js/pages/forms/form-validation.js') }}"></script>
<!-- Demo Js -->
<script src="{{Vite::asset('resources/web/systheme/js/demo.js')}}"></script>
<script src="{{ Vite::asset('resources/web/systheme/js/systheme.js') }}"></script>

<script src="{{ Vite::asset('node_modules/moment/min/moment.min.js') }}"></script>
<script src="{{ Vite::asset('node_modules/axios/dist/axios.min.js') }}"></script>
<script src="{{ Vite::asset('resources/web/custom/service_cad.js') }}"></script>
<script src="{{ Vite::asset('resources/web/custom/field_change.js') }}"></script>
<script src="{{ Vite::asset('resources/web/custom/modal_push.js') }}"></script>

