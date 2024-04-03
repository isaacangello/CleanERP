@extends("layouts.main")

    @section('title')
         <title>Home - main - JJL System 2</title>
    @endsection

{{--css links para o head--}}
@section('css-style')
     <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
{{--    <link href="web-resources/bootstrap/bootstrap.min.css" rel="stylesheet">--}}
    <!-- Materialize Core Css -->
    <link href="{{ Vite::asset('resources/web-resources/materialize/css/materialize.css') }}" rel="stylesheet">
    <!-- jquery ui  Css -->
     <link href="{{Vite::asset('resources/web-resources/jquery-ui/jquery-ui.css')}}" rel="stylesheet" />
    <!-- Waves Effect Css -->
    <link href="{{Vite::asset('resources/web-resources/systheme/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{Vite::asset('resources/web-resources/systheme/plugins/animate-css/animate.css')}}" rel="stylesheet" />


    <!-- Custom Css -->
    <link href="{{Vite::asset('resources/web-resources/systheme/css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{Vite::asset('resources/web-resources/systheme/css/themes/all-themes.css')}}" rel="stylesheet" />
@endsection

@section('content')
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
                    <button class="btn waves-classic waves-light btn-small  btn-small modal-trigger"  href="#new-service" >New service</button>
                    <span class="p-l-10">
                          Week Number <span class="yellow-text text-darken-4">{{ $numWeek }}</span> / From <span class="label-date-home">{{ $weekArr['Monday'] }}</span> - Till <span class="label-date-home">{{ $weekArr['Saturday'] }} </span><div class="displaytest">Iphone</div>
                    </span>
                </div>
                <x-service-cad :employees="$employeesCol" :customers="$customersCol">

                </x-service-cad>
                <div class="body">
                        <x-msgs />
                        <div class="row">
                            @php
                                    $c=0;
                            @endphp
                            
                            @foreach($dataArr as $key => $row)
                                <x-home-cards :emp-name="$key" :data="$row" />
                                @php
                                    $c++;
                                    if($c >= 4){
                                        $c=0;
                                        echo "</div><div class='row'>";
                                    }
                                @endphp

                            @endforeach
                            
                        </div> <!--grid system row-->
                </div> <!--card body-->
            </div> <!--card -->


        </div><!-- col -->
    </div>  <!-- row -->
</div>
@endsection

{{-- inclusção de scripts  no final no corpo--}}
@section('script-botton')

{{--    <script src="web-resources/systheme/plugins/jquery/jquery.min.js"></script>--}}
    <!-- Jquery core js -->
    <script src="{{Vite::asset('resources/web-resources/jquery/jquery-3.7.0.min.js')}}"></script>
    <!-- Jquery-ui Js -->
    <script src="{{Vite::asset('resources/web-resources/jquery-ui/jquery-ui.js')}}"></script>
<!-- Bootstrap Core Js -->
{{--    <script src="web-resources/bootstrap/bootstrap.min.js"></script>--}}
    <script src="{{ Vite::asset('resources/web-resources/materialize/js/materialize.min.js') }}"></script>

    <!-- Select Plugin Js -->
{{--    <script src="web-resources/systheme/plugins/bootstrap-select/js/bootstrap-select.js"></script>--}}

    <!-- Slimscroll Plugin Js -->
    <script src="{{Vite::asset('resources/web-resources/systheme/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{Vite::asset('resources/web-resources/systheme/plugins/node-waves/waves.js')}}"></script>
    <!-- Jquery Validation Plugin Css -->
{{--    <script src="{{ Vite::asset('resources/web-resources/systheme/plugins/jquery-validation/jquery.validate.js') }}"></script>--}}

    <!-- JQuery Steps Plugin Js -->
    <script src="{{Vite::asset('resources/web-resources/systheme/plugins/jquery-steps/jquery.steps.js')}}"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="{{Vite::asset('resources/web-resources/systheme/plugins/sweetalert/sweetalert.min.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{ Vite::asset('resources/web-resources/systheme/js/admin.js') }}"></script>
{{--    <script src="web-resources/systheme/js/pages/tables/jquery-datatable.js"></script>--}}
    <script src="{{ Vite::asset('resources/web-resources/systheme/js/pages/index.js') }}"></script>
<script src="{{ Vite::asset('resources/web-resources/systheme/js/pages/forms/form-validation.js') }}"></script>
    <!-- Demo Js -->
    <script src="{{Vite::asset('resources/web-resources/systheme/js/demo.js')}}"></script>
    <script src="{{ Vite::asset('resources/web-resources/systheme/js/systheme.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ Vite::asset('resources/web-resources/custom/service_cad.js') }}"></script>
@endsection

