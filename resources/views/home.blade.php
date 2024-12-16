@extends("layouts.main")

@section('title')
    <title>Home - main - JJL System 2</title>
@endsection

{{--css links para o head--}}
@section('css-style')
    @include('layouts.generic_css')
{{--    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}
@endsection

@section('content')
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="header p-2">
                    <h2 class="uppercase uppercase-text">welcome, {{ Auth::user()->name }}</h2>
                </div>
                <div class="body align-center">
                        <p class="font-12 padding-0">{{ now()->timezone('America/New_York')->format('l jS \\of F Y ') }}</p>
                    <p class="font-14 padding-0"><b>Florida: <span class="label bg-teal p-5" id="florida_time"></span> / Brasil:<span class="label bg-cyan p-5" id="brazil_time"></span> </b></p>
                </div>
        </div>
    </div>
    <div class="row">
                <div class="col s12 m12">
                    <div class="card">
                        <div class="header">
                            <h2 class="p-0">CALLS</h2>
                        </div>
                        <div class="body center-align">
                            <a target="_blank" href="https://meet.google.com/pbx-ngck-evi"><span class="label bg-green text-white p-5  font-13">Chamada Principal</span></a>
                            <a target="_blank" href="https://meet.google.com/vvh-zxmn-cjc"><span class="label bg-blue text-white p-5  font-13">Chamada Residencial</span></a>
                            <a target="_blank" href="https://meet.google.com/cot-jkcr-dgw"><span class="label bg-gray-500 text-white p-5 font-13">Chamada Comercial</span></a>
                            <a target="_blank" href="https://meet.google.com/mec-cngi-feo"><span class="label bg-amber-600 text-white p-5 font-13">Chamada Extra</span></a>
                        </div>
                    </div>
                </div>
    </div>
    <div class="row">
            <div class="col s12 m12">
                <div class="card">
                    <div class="header">
                        <h2 class="p-0">CALENDAR</h2>
                    </div>
                    <div class="body">
                        <div id="cal-view"></div>
                    </div>
                </div>
            </div>
    </div>
                    @endsection

{{-- inclusção de scripts  no final no corpo--}}
@section('script-botton')
    @include('layouts.generic_js')
            <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.14/index.global.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.14/index.global.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/list@6.1.14/index.global.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/google-calendar@6.1.14/index.global.min.js"></script>

            <script type="module" src="{{ asset('web/custom/home/calendar-init.js') }}"></script>

@endsection