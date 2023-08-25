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
    <link href="web-resources/materialize/css/materialize.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="web-resources/systheme/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="web-resources/systheme/plugins/animate-css/animate.css" rel="stylesheet" />


    <!-- Custom Css -->
    <link href="web-resources/systheme/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="web-resources/systheme/css/themes/all-themes.css" rel="stylesheet" />
@endsection

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>
            <small>EMPLOYEES SERVICES TODAY</small>
        </h2>
    </div>
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Day of week 12 <div class="displaytest">Iphone</div>
                    </h2>
                </div>
                <div class="body">
                        <div class="row">
                            @for($i=0;$i<16;$i++)
                                <x-home-cards />
                            @endfor
                        </div> <!--grid system row-->
                </div> <!--card body-->
            </div> <!--card -->


        </div><!-- col -->
    </div>  <!-- row -->
</div>
@endsection
{{-- inclusção de scripts  no final no corpo--}}
@section('script-botton')
    <!-- Jquery Core Js -->
{{--    <script src="web-resources/systheme/plugins/jquery/jquery.min.js"></script>--}}
    <script src="web-resources/jquery/jquery-3.7.0.min.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="web-resources/bootstrap/bootstrap.min.js"></script>
    <script src="web-resources/materialize/js/materialize.js"></script>

    <!-- Select Plugin Js -->
    <script src="web-resources/systheme/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="web-resources/systheme/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="web-resources/systheme/plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
{{--    <script src="web-resources/systheme/plugins/jquery-datatable/jquery.dataTables.js"></script>--}}
{{--    <script src="web-resources/systheme/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>--}}
{{--    <script src="web-resources/systheme/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>--}}
{{--    <script src="web-resources/systheme/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>--}}
    <script src="web-resources/systheme/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="web-resources/systheme/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="web-resources/systheme/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
{{--    <script src="web-resources/systheme/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>--}}
{{--    <script src="web-resources/systheme/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>--}}

    <!-- Custom Js -->
    <script src="web-resources/systheme/js/admin.js"></script>
{{--    <script src="web-resources/systheme/js/pages/tables/jquery-datatable.js"></script>--}}
    <script src="web-resources/systheme/js/pages/index.js"></script>

    <!-- Demo Js -->
    <script src="web-resources/systheme/js/demo.js"></script>
    <script src="web-resources/systheme/js/systheme.js"></script>
@endsection
