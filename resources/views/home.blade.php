@extends("layouts.main")

@section('title')
    <title>Home - main - JJL System 2</title>
@endsection

{{--css links para o head--}}
@section('css-style')
    @include('layouts.generic_css')
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
                        <button class="btn waves-effect waves-light btn-small  btn-small modal-trigger"
                                href="#new-service">New service
                        </button>
                        <span class="p-l-10">
                          Week Number <span class="yellow-text text-darken-4">{{ $numWeek }}</span> / From <span
                                    class="label-date-home">{{ $weekArr['Monday'] }}</span> - Till <span
                                    class="label-date-home">{{ $weekArr['Saturday'] }} </span><div class="displaytest">Iphone</div>
                    </span>
                    </div>
                    <x-service-cad :employees="$employeesCol" :customers="$customersCol">

                    </x-service-cad>
                    <div class="body">
                        <x-msgs/>
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
@endsection

{{-- inclusção de scripts  no final no corpo--}}
@section('script-botton')
    @include('layouts.generic_js')
@endsection

