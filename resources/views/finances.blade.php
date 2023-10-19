@extends("layouts.main")
@section('title')
    <title>Customers - main - JJL System 2</title>
@endsection
{{--css links para o head--}}
@section('css-style')
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    {{--    <link href="web-resources/bootstrap/bootstrap.min.css" rel="stylesheet">--}}
    <!-- Materialize Core Css -->
    <link href="web-resources/materialize/css/materialize.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    {{--    <link href="web-resources/systheme/plugins/node-waves/waves.css" rel="stylesheet" />--}}

    <!-- Animation Css -->
    <link href="web-resources/systheme/plugins/animate-css/animate.css" rel="stylesheet" />
    <!-- Sweet Alert Css -->
    <link href="web-resources/systheme/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
{{--<link href="../../public/web-resources/systheme/plugins/morrisjs/morris.css" rel="stylesheet" />--}}

    <!-- Custom Css -->
    <link href="web-resources/systheme/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="web-resources/systheme/css/themes/all-themes.css" rel="stylesheet" />


    <style>
        input.form-control {
            margin-bottom: 0!important;
            border-bottom: none!important;
        }
        textarea.form-control {
            margin-bottom: 0!important;
            border-bottom: none!important;
        }
        input.select-dropdown {
            margin-bottom: 0!important;
            border-bottom: none!important;
        }
        .red:hover{
            background-color: #ef9a9a!important;
        }

    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                <small>FINANCES</small>
            </h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col s12 m12">
                <div class="card">
                    <div class="header" style="padding-bottom: 0px;">
                        <div class="row">
                            <div class="col s12 m12">
                                <span id="list-of-customer" class="m-l-35">FINANCES</span>
                            </div>
                        </div>
                    </div>

                    <div class="header" style="padding-bottom: 0px;">
                        <div class="row">
                            <div class="col s6 m6">
                                        <div class="panel panel-default ">
                                            <div class="panel-heading">
                                                <small>Seach paid</small>
                                            </div>
                                            <div class="panel-body p-l-3 p-r-3">
                                                <div class="row">
                                                    <div class="input-field col s12 m12">
                                                        <div class="form-group">
                                                            <div class="form-line success">
                                                                <select id="select-finance-employee" class="form-control" name="finance-employee" >
                                                                    <option selected value=""></option>
                                                                    @foreach($employees as $employee)
                                                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                            <div class="help-info">Select employee.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                        <div class="input-field col s12 m6 ">
                                                            <div class="form-group">
                                                                <div class="form-line success">
                                                                    <input id="input-finance-from" name="finance-from" type="text" class="form-control date" value="">
                                                                    <label class="form-label" for="input-finance-from">From</label>
                                                                </div>
                                                                <div class="help-info">Insert date from.</div>
                                                            </div>
                                                        </div>
                                                        <div class="input-field col s12 m6">
                                                            <div class="form-group">
                                                                <div class="form-line success">
                                                                    <input id="input-finance-till" name="finance-till" type="text" class="form-control date" value="">
                                                                    <label class="form-label" for="input-finance-till">Till</label>
                                                                </div>
                                                                <div class="help-info">Insert date till.</div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="panel-footer">
                                                <div class="row">
                                                    <div class="col s1"></div>
                                                    <div class="col s11" >
                                                        <button class="teal waves-effect waves-classic waves-light white-text btn btn-small">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                            <div class="col s60 m6" >
                                        <div class="panel panel-default ">
                                            <div class="panel-heading">
                                                <small>Seach paid</small>
                                            </div>
                                            <div class="panel-body p-l-3 p-r-3">
                                                 <div style="width:800px;"><canvas id="acquisitions"></canvas></div>
                                            </div>
                                            <div class="panel-footer">
                                                <div class="row">
                                                    <div class="col s1"></div>
                                                    <div class="col s11" >

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
                    <!-- tratando variáveis -->

@endsection

{{-- inclusção de scripts  no final no corpo--}}
@section('script-botton')
    <!-- Jquery Core Js -->
    {{--    <script src="web-resources/systheme/plugins/jquery/jquery.min.js"></script>--}}
    <script src="{{asset('web-resources/jquery/jquery-3.7.0.min.js')}}"></script>
    <!-- Bootstrap Core Js -->
    {{--    <script src="web-resources/bootstrap/bootstrap.min.js"></script>--}}
    <script src="{{ asset('web-resources/materialize/js/materialize.min.js') }}"></script>

    <!-- Select Plugin Js -->
    {{--    <script src="web-resources/systheme/plugins/bootstrap-select/js/bootstrap-select.js"></script>--}}

    <!-- Slimscroll Plugin Js -->
    <script src="{{asset('web-resources/systheme/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{asset('web-resources/systheme/plugins/node-waves/waves.js')}}"></script>
    <!-- Jquery Validation Plugin Css -->
    <script src="{{ asset('web-resources/systheme/plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="{{asset('web-resources/systheme/plugins/jquery-steps/jquery.steps.js')}}"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="{{asset('web-resources/systheme/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <!-- chart Plugin Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.js" integrity="sha512-6LKCH7i2+zMNczKuCT9ciXgFCKFp3MevWTZUXDlk7azIYZ2wF5LRsrwZqO7Flt00enUI+HwzzT5uhOvy6MNPiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('web-resources/systheme/js/chartjs.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('web-resources/systheme/js/admin.js') }}"></script>

    <script src="{{ asset('web-resources/systheme/js/pages/index.js') }}"></script>
    <script src="{{ asset('web-resources/systheme/js/pages/forms/form-validation.js') }}"></script>
    <!-- Demo Js -->
    <script src="{{asset('web-resources/systheme/js/demo.js')}}"></script>
    <script src="{{ asset('web-resources/systheme/js/systheme.js') }}"></script>

@endsection


