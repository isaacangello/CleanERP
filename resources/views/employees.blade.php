@extends("layouts.main_old")
@section('title')
    <title>employees - main - CleanERP 2</title>
@endsection
{{--css links para o head--}}
@section('css-style')
    @include('layouts.generic_css')
@endsection

@section('content')
    <h4 class="page-title">Employees</h4>
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                <small>EMPLOYEES REGISTER AND VIEW</small>
            </h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col s12 m12">
                <div class="card">
                    <div class="header" style="padding-bottom: 0;">
                        <div class="row">
                            <div class="col s12 m12">
                                <span id="list-of-employees" class="m-l-35">LIST OF EMPLOYEES {{ $type }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- tratando variáveis do componentes employee-viewedit -->

                    <div class="body">
                        <div class="row">
                            <div class="col s12">
                                <livewire:registration.employee-registration :filter-type="$type"/>
                            </div>
                        </div>
                        <!---##################### row pagination ####################################################-->
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- inclusção de scripts  no final no corpo--}}
@section('script-botton')
    @include('layouts.generic_js')

    {{-- <script type="module" src="{{asset('web/custom/field_change.js')}}" ></script>--}}
    {{-- <script type="module" src="{{asset('web/custom/employees/modal_cad.js')}}" ></script>--}}

@endsection


