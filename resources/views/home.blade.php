@extends("layouts.main")

@section('title')
    <title>Home - main - JJL System 2</title>
@endsection

{{--css links para o head--}}
@section('css-style')
    @include('layouts.generic_css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="header p-10">
                    <h2 class="uppercase uppercase-text">welcome, {{ Auth::user()->name }}</h2>
                </div>
                <div class="body align-center">
                        <p class="font-16">{{ now()->timezone('America/New_York')->format('l jS \\of F Y ') }}</p>
                    <p class="font-14"><b>Brasil:<span class="label bg-cyan p-5" id="brazil_time"></span> / <b>Florida:</b> <span class="label bg-teal p-5" id="florida_time"></span> </b></p>
                </div>
        </div>
    </div>
    <div class="row">
                <div class="col s12 m12">
                    <div class="card">
                        <div class="header">
                            <h2 class="p-0">CALLS</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive ">
                                <table class="table table-hover dashboard-task-infos highlight">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Link</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!--
                                        Chamada Principal
                                        https://meet.google.com/pbx-ngck-evi
                                        Chamada Residencial
                                        https://meet.google.com/vvh-zxmn-cjc
                                        Chamada Comercial
                                        https://meet.google.com/cot-jkcr-dgw
                                        Chamada Extra
                                        https://meet.google.com/mec-cngi-feo
                                    -->
                                    <tr>
                                        <td>1</td>
                                        <td>Call</td>
                                        <td><a target="_blank" href="https://meet.google.com/pbx-ngck-evi"><span class="label bg-green p-5">Chamada Principal</span></a></td>
                                        <td>Unknown</td>
                                        <td>
                                            <span>https://meet.google.com/pbx-ngck-evi</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Call</td>
                                        <td><a target="_blank" href="https://meet.google.com/vvh-zxmn-cjc"><span class="label bg-blue p-5">Chamada Residencial</span></a></td>
                                        <td>Unknown</td>
                                        <td>
                                            <span>https://meet.google.com/vvh-zxmn-cjc</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Call</td>
                                        <td><a target="_blank" href="https://meet.google.com/cot-jkcr-dgw"><span class="label bg-light-blue p-5">Chamada Comercial</span></a></td>
                                        <td>Unknown</td>
                                        <td>
                                            <span>https://meet.google.com/cot-jkcr-dgw</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Call</td>
                                        <td><a target="_blank" href="https://meet.google.com/mec-cngi-feo"><span class="label bg-orange p-5">Chamada Extra</span></a></td>
                                        <td>Unknown</td>
                                        <td>
                                            <span>https://meet.google.com/mec-cngi-feo</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
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
{{--                        <iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=America%2FNew_York&bgcolor=%230B8043&showPrint=0&src=ampsY2xlYW5zZXJ2aWNlc0BnbWFpbC5jb20&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=ZW4uY2hyaXN0aWFuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=cHQuYnJhemlsaWFuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=ZW4udXNhI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&color=%23EF6C00&color=%2333B679&color=%230B8043&color=%230B8043&color=%230B8043" style="border:solid 1px #777" width="100%" height="600px"  frameborder="0" scrolling="no"></iframe>--}}
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