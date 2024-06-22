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
                    <x-service-cad :employees="$employeesCol" :customers="$customersCol">

                    </x-service-cad>
                    <div class="body">
                        <div class="row">
                            <div class="col s12 m2 input-field">
                                <div class="form-group">

                                        <button class="btn h-45 modal-trigger"href="#new-service">
                                            New service
                                        </button>
                                </div>
                            </div>
                            <div class="col s12 m2 input-field">
                                <div class="form-group">
                                    <form action="{{ route('home') }}">
                                        <button class="btn h-45">
                                            This week
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <form action="{{ route('home') }}">
                            <div class="col s12 m3 input-field" >
                                <div class="form-group">
                                    <div class="form-line success">
                                    <select name="numberweek" class="form-control h-30" style="height: 30px">
                                        <option value="{{ $numWeek?$numWeek:'' }}">week {{$numWeek?$numWeek:''}}</option>
                                        @for ($i = 1; $i < 53; $i++)
                                            <option value="{{$i}}">week {{$i}}</option>
                                        @endfor

                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m3 input-field">
                                <div class="form-group">
                                    <div class="form-line success">

                                        <select name="year" class="form-control">
                                            <option value="{{$year?$year:now()->format("Y")}}">{{$year?$year:'current year'}}</option>
                                            @for ($i = 2020; $i < 2031; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m2 input-field">
                                    <button class="btn h-45">
                                        go
                                    </button>
                            </div>
                            </form>
                        </div>

                        <div class="row">
                            @php
                                $c=0;
                            @endphp

                            @foreach($dataArr as $key => $row)
                                <x-home-cards :emp-name="$key" :data="$row"/>
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

