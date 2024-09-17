@extends("layouts.main")

@section('title')
    <title>WEEK - main - JJL System 2</title>
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
                <small>EMPLOYEES SERVICES</small>
            </h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                            <span>
                              Week Number <span class="yellow-text text-darken-4">{{ $numWeek }}</span> / From <span
                                        class="label-date-home">{{ $weekArr['Monday'] }}</span> - Till <span
                                        class="label-date-home">{{ $weekArr['Saturday'] }} </span><div class="displaytest">Iphone</div>
                            </span>
                        <x-msgs :$msg />

                    </div>
                    <x-service-cad :employees="$employeesCol" :customers="$customersCol" :num-week="$numWeek" :$year>

                    </x-service-cad>
                    <div class="body">
                        <div class="row">
                            <div class="col s12 m2 input-field">
                                <div class="form-group">

                                    <x-standard-btn type="submit" class="font-15 h-45 modal-trigger" href="#new-service">
                                        New service
                                    </x-standard-btn>
                                </div>
                            </div>
                            <div class="col s12 m2 input-field">
                                <div class="form-group">
                                    <form action="{{ route('week') }}">
                                        <x-standard-btn type="submit" class="font-15 h-45">
                                            This week
                                        </x-standard-btn>
                                    </form>
                                </div>
                            </div>
                            <div class="col s12 m1 input-field">
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

                                    @endphp
                                    <form action="{{ route('week') }}">

                                            <x-text-input type="hidden" value="{{$numWeek_arrow_b}}" name="numberweek"></x-text-input>
                                            <x-text-input type="hidden" value="{{$year_arrow_b}}" name="year"></x-text-input>
                                            <x-standard-btn type="submit" class="font-15 h-45">
                                            <span class="material-symbols-outlined">
                                                arrow_back
                                            </span>
                                            </x-standard-btn>
                                    </form>
                                </div>
                            </div>
                            <form action="{{ route('week') }}">
                                <div class="col s12 m2 input-field" >
                                    <div class="form-group">
                                        <div class="form-line success">
                                            <select name="numberweek" class="form-control h-30 materialize-select" style="height: 30px">
                                                <option value="{{ $numWeek?$numWeek:'' }}">week {{$numWeek?$numWeek:''}}</option>
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

                                            <select name="year" class="form-control materialize-select">
                                                <option value="{{$year?$year:now()->format("Y")}}">{{$year?$year:'current year'}}</option>
                                                @for ($i = 2020; $i < 2031; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m2 input-field">
                                    <x-standard-btn type="submit" class="font-15 h-45">
                                        go
                                    </x-standard-btn>
                                </div>
                            </form>
                            <div class="col s12 m1 input-field">
                                <div class="form-group">
                                    <form action="{{ route('week')}}">
                                        <x-text-input type="hidden" value="{{$numWeek_arrow_f}}" name="numberweek"></x-text-input>
                                        <x-text-input type="hidden" value="{{$year_arrow_f}}" name="year"></x-text-input>
                                        <x-standard-btn type="submit" class="font-15 h-45">
                                            <span class="material-symbols-outlined">
                                                arrow_forward
                                            </span>
                                        </x-standard-btn>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="row" id="htmlContent">
                            {!! $cardsHtml !!}
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
    <input type="hidden" id="numWeek" name="numWeek" value="{{$numWeek}}">
    <input type="hidden" id="year" name="year" value="{{$year}}">
    <input type="hidden" id="idToFee" name="year" value="">
    <x-service-details  :employees="$employeesItems" :customers="$customersItems" />
@endsection

{{-- inclusção de scripts  no final no corpo--}}
@section('script-botton')
    @include('layouts.generic_js')
    <script type="module" src="{{ asset('web/custom/service_cad.js') }}"></script>
    <script type="module" src="{{ asset('web/custom/modalPush.js') }}"></script>
    <script type="module" src="{{ asset('web/custom/field_change.js') }}"></script>


@endsection

