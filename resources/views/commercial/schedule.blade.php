@extends("layouts.main_old")

@section('title')
    <title>SCHEDULE - main - CleanERP 2</title>
@endsection

{{--css links para o head--}}
@section('css-style')
    @include('layouts.generic_css')
    {{--    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}
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
                    {{--                    @php dd($weekArr); @endphp--}}
                    <div class="header">
                            <span>
                              Week Number   <span class="yellow-text text-darken-4">{{ $numWeek }}</span> / From
                                            <span class="label-date-home">{{ $weekArr["Monday"] }}</span> - Till
                                            <span class="label-date-home">{{ $weekArr['Saturday'] }} </span>
                            </span>
                        <x-msgs :$msg/>

                    </div>
                    <x-commercial-cad :employees="$employeesCol" :customers="$customersCol" :$weekArr :$numWeek :$year>

                    </x-commercial-cad>
                    <div class="body">
                        <div class="row">
                            <div class="col s12 m2 input-field">
                                <div class="form-group">

                                    <button class="btn btn-link btn-small valign-wrapper modal-trigger"
                                            href="#new-schedule">
                                        New schedule
                                    </button>
                                </div>
                            </div>
                            <div class="col s12 m2 input-field">
                                <div class="form-group">
                                    <form action="{{ route('commercial.schedule') }}">
                                        <x-standard-btn type="submit" class="btn btn-link btn-small valign-wrapper">
                                            This week
                                        </x-standard-btn>
                                    </form>
                                </div>
                            </div>
                            <div class="col s12 m1 input-field align-left">
                                <div class="form-group">
                                    @php
                                        //numberweek=28&year=current
                                        if (!isset($year) || $year == "current"){$year=now()->format("Y");}
                                        //dd($numWeek);
                                        if($numWeek >= 52){
                                            $numWeek_arrow_f=1;
                                            $year_arrow_f = $year + 1;
                                        }else{
                                            $numWeek_arrow_f= $numWeek + 1;
                                            $year_arrow_f = $year;
                                        }
                                        if($numWeek <= 1){
                                            $numWeek_arrow_b=52;
                                            $year_arrow_b = $year - 1;

                                        }else{
                                            $numWeek_arrow_b= $numWeek - 1;
                                            $year_arrow_b = $year;
                                        }
                                        //dd($weekArr);
                                    @endphp

                                    <form action="{{ route('commercial.schedule')}}">
                                        <x-text-input type="hidden" value="{{$numWeek_arrow_b}}"
                                                      name="numberweek"></x-text-input>
                                        <x-text-input type="hidden" value="{{$year_arrow_b}}"
                                                      name="year"></x-text-input>
                                        <x-standard-btn type="submit" class="btn btn-link btn-small valign-wrapper">
                                            <span class="material-symbols-outlined">
                                                arrow_back
                                            </span>
                                        </x-standard-btn>
                                    </form>
                                </div>
                            </div>
                            <form action="{{ route('commercial.schedule') }}">
                                <div class="col s12 m2 input-field">
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <select name="numberweek"
                                                    class="form-control  materialize-select browser-default h-30">
                                                <option value="{{ $numWeek?$numWeek:'' }}">
                                                    week {{$numWeek?$numWeek:''}}</option>
                                                @for ($i = 1; $i < 53; $i++)
                                                    <option value="{{$i}}">week {{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m2 input-field">
                                    <div class="form-group">
                                        <div class="form-line success">

                                            <select name="year"
                                                    class="form-control materialize-select browser-default h-30">
                                                <option value="{{$year?$year:now()->format("Y")}}">{{$year?$year:'current year'}}</option>
                                                @for ($i = 2020; $i < 2031; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m1 input-field">
                                    <x-standard-btn type="submit" class="btn btn-link btn-small valign-wrapper">
                                        go
                                    </x-standard-btn>
                                </div>
                            </form>
                            <div class="col s12 m1 input-field align-left">
                                <div class="form-group">
                                    <form action="{{ route('commercial.schedule')}}">
                                        <x-text-input type="hidden" value="{{$numWeek_arrow_f}}"
                                                      name="numberweek"></x-text-input>
                                        <x-text-input type="hidden" value="{{$year_arrow_f}}"
                                                      name="year"></x-text-input>
                                        <x-standard-btn type="submit" class="btn btn-link btn-small valign-wrapper">
                                            <span class="material-symbols-outlined">
                                                arrow_forward
                                            </span>
                                        </x-standard-btn>
                                    </form>
                                </div>
                            </div>

                        </div>

                        <div id="renderSchedule" class="row grid-schedules">


                            {!! $cards !!}


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
    <x-schedule-details :employees="$employeesItems" :customers="$customersItems" :$numWeek :$year/>
@endsection

{{-- inclusção de scripts  no final no corpo--}}
@section('script-botton')
    @include('layouts.generic_js')
    <script type="module" src="{{ asset('web/custom/commercial/modal_cad.js') }}"></script>
    <script type="module" src="{{ asset('web/custom/commercial/modalPush.js') }}"></script>
    <script type="module" src="{{ asset('web/custom/commercial/field_change.js') }}"></script>

@endsection

