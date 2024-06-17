<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
@use('Illuminate\Support\Facades\Vite')
<!-- Bootstrap Core Css -->
{{--    <link href="web/bootstrap/bootstrap.min.css" rel="stylesheet">--}}
<!-- Waves Effect Css -->
<link href="{{Vite::asset('node_modules/node-waves/dist/waves.min.css')}}" rel="stylesheet" />

<!-- Materialize Core Css -->
<link href="{{ Vite::asset('resources/web/materialize/css/materialize.css') }}" rel="stylesheet">
<!-- jquery ui  Css -->
<link href="{{Vite::asset('resources/web/jquery-ui/jquery-ui.css')}}" rel="stylesheet" />
<!-- Animation Css -->
<link href="{{Vite::asset('node_modules/animate.css/animate.css')}}" rel="stylesheet" />


<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="{{Vite::asset('resources/web/systheme/css/themes/all-themes.css')}}" rel="stylesheet" />
<!-- Custom Css -->
<link href="{{ Vite::asset('resources/web/custom/mobile.css') }} " rel="stylesheet">

<link href="{{Vite::asset('resources/web/systheme/css/style.css')}}" rel="stylesheet">
