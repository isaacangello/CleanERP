@extends("layouts.main")

@section('title')
    <title>WEEK - main - JJL System 2</title>
@endsection

{{--css links para o head--}}
@section('css-style')
    @include('layouts.generic_css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                <small>COMMERCIAL SCHEDULE</small>
            </h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="col s12 m2 offset-m5">
                              <span>Today </span><span class="yellow-text text-darken-4">{{ $day }}</span>
                        </div>
                    </div>
                    <x-msgs :$msg />
                    <x-service-cad :employees="$employeesCol" :customers="$customersCol">

                    </x-service-cad>
                    <div class="body">
                        <div class="row">
                            <div class="col s12 m2 input-field">
                                <div class="form-group">

                                    <button class="btn h-45 modal-trigger" href="#new-service">
                                        New Schedule
                                    </button>
                                </div>
                            </div>
                            <div class="col s12 m2 input-field">
                                <div class="form-group">
                                    <form action="{{ route('commercial.schedule', ['page' => 1]) }}">
                                        <button class="btn h-45">
                                            This day
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="col s12 m1 input-field">
                                <div class="form-group">
                                    <form action="{{ route('commercial.schedule',) }}">
                                            <x-text-input type="hidden" name="day" value="{{ $previous }}" />
                                            <button class="btn h-45">
                                            <span class="material-symbols-outlined">
                                                arrow_back
                                            </span>
                                            </button>
                                        </form>
                                </div>
                            </div>
                            <form action="{{ route('commercial.schedule') }}">
                                <div class="col s12 m2 input-field" >
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <input type="text" name="day" class="form-control datepicker">
                                        </div>
                                    </div>
                                </div>

                                <div class="col s12 m1 input-field">
                                    <button class="btn h-45">
                                        go
                                    </button>
                                </div>
                            </form>
                            <div class="col s12 m1 input-field text-start">
                                <div class="form-group">
                                    <form action="{{ route('commercial.schedule')}}">
                                        <x-text-input type="hidden" name="day" value="{{ $next }}" />
                                        <button class="btn h-45">
                                            <span class="material-symbols-outlined">
                                                arrow_forward
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <x-commercial-card />
                        </div> <!--grid system row-->
                    </div> <!--card body-->
                </div> <!--card -->


            </div><!-- col -->
        </div>  <!-- row -->
    </div>
    @php
        if(isset($employeesCol)){$employeesItems = $employeesCol;}else{$employeesItems = false;}
        if(isset($customersCol)){$customersItems = $customersCol;}else{$customersItems = false;}
//        dd($employeesCol);
    @endphp
    <x-service-details :employees="$employeesItems" :customers="$customersItems" />
@endsection

{{-- inclusção de scripts  no final no corpo--}}
@section('script-botton')
    @include('layouts.generic_js')

@endsection

