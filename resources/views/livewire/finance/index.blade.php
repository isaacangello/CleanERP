<div class="container-fluid">
    <div class="block-header">
        <h2>
            <small>FINANCES</small>
        </h2>
    </div>
    <!-- Basic Examples -->

    <div class="row clearfix">
        <div class="col s12 m12">
            <div class="card">

                <div class="header">
                    <span>RESIDENTIAL</span> Week Number {{ $numWeek }} / From {{ $from }} - Till {{ $till }}

                </div>

                <div class="body">
{{--                    <x-layout.week-navigator :$numWeek :$year :$previousYear :$nextYear :$previousWeek :$nextWeek  />--}}
                    <div class="row">
                        <div class="col s12 m2 input-field">
                        </div>
                        <div class="col s12 m2 input-field">
                            <div class="form-group">
                                <form wire:submit.prevent="thisWeek()">
                                    <x-standard-btn type="submit" class="font-15 h-45" >
                                        This week
                                    </x-standard-btn>
                                </form>
                            </div>
                        </div>
                        <div class="col s12 m1 input-field align-left">
                            <div class="form-group">
                                @php
                                    //numbered=28&year=current
                                @endphp

                                <form wire:submit.prevent="backWeek()">
                                    <x-standard-btn type="submit" class="font-15 h-45">
                                            <span class="material-symbols-outlined">
                                                arrow_back
                                            </span>
                                    </x-standard-btn>
                                </form>
                            </div>
                        </div>
                        <form wire:submit.prevent="selectWeek()">
                            <div class="col s12 m2 input-field" >
                                <div class="form-group">
                                    <div class="form-line success">
                                        <select wire:model="selectedWeek"  class="form-control  materialize-select" >
                                            <option value="{{ $numWeek}}">week {{$numWeek}}</option>
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

                                        <select wire:model="selectedYear"  class="form-control materialize-select">
                                            <option value="{{$year}}">{{$year}}</option>
                                            @for ($i = 2020; $i < 2031; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m1 input-field">
                                <x-standard-btn type="submit" class="font-15 h-45">
                                    go
                                </x-standard-btn>
                            </div>
                        </form>
                        <div class="col s12 m1 input-field align-left">
                            <div class="form-group">
                                <form wire:submit.prevent="forwardWeek()">
                                    <x-standard-btn type="submit" class="font-15 h-45">
                                            <span class="material-symbols-outlined">
                                                arrow_forward
                                            </span>
                                    </x-standard-btn>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col s12 ">
                            <div class="panel panel-default" >
                                <div class="panel-heading">
                                    Seach
                                </div>
                                <div class="panel-body" >
                                    <div class="row clearfix">
                                        <div class="input-field col s12 m2">
                                            <div class="form-group">
                                                <div class="form-line success">
                                                    <select id="select-finance-employee" class="form-control materialize-select" wire:model="selectedEmployee" >
                                                        <option selected value=""></option>

                                                            @foreach($allEmployees as $employee)
                                                                <option value="{{ $employee['id'] }}">{{ $employee['name'] }}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                                <div class="help-info">Select employee.</div>
                                            </div>
                                        </div>
                                        <div class="input-field col s12 m2 ">
                                            <div class="form-group">
                                                <div class="form-line success">
                                                    <input id="input-finance-from" name="finance-from" type="text" class="form-control date" value="">
                                                    <label class="form-label" for="input-finance-from">From</label>
                                                </div>
                                                <div class="help-info">Insert date from.</div>
                                            </div>
                                        </div>
                                        <div class="input-field col s12 m2">
                                            <div class="form-group">
                                                <div class="form-line success">
                                                    <input id="input-finance-till" name="finance-till" type="text" class="form-control date" value="">
                                                    <label class="form-label" for="input-finance-till">Till</label>
                                                </div>
                                                <div class="help-info">Insert date till.</div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col s12" >
                                            <button class="btn btn-success  valign-wrapper">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <div class="col s6 m6" >--}}
{{--                            <div class="panel panel-default">--}}
{{--                                <div class="panel-heading">--}}
{{--                                    <small>Payments of week</small>--}}
{{--                                </div>--}}
{{--                                <div class="panel-body p-l-3 p-r-3" style="height:35vh;">--}}
{{--                                    <div class="chart-container align-center" style="position: relative; height:30vh;" >--}}
{{--                                        <canvas id="chart-area"></canvas>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="panel-footer" style="position: relative">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col s1"></div>--}}
{{--                                        <div class="col s11">--}}
{{--                                            &nbsp;--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}


{{--                        </div>--}}
{{--                    </div>--}}
                        <div class="panel panel-default">
                            <div class="panel-body">

                            <table class="table table-striped highlight">
                                <thead>
                                <tr class="green darken-3 white-text">
                                    <th>Employee</th>
                                    <th>Total</th>
                                    <th>70%</th>
                                    <th>30%</th>
                                    <th>&nbsp;</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($employees_services != null)
                                    {{--                                        {{dd($employees_services)}}--}}
                                    @foreach($employees_services as $key =>  $row)
                                        @php
                                            //                                                    dd($row);
                                                                                                extract($row);
                                        @endphp
                                        @if($emp_name!=null)
                                            <tr>
                                                <td>{{$emp_name}}</td>
                                                <td>{{$cem}}</td>
                                                <td>{{$setenta}}</td>
                                                <td>{{$trinta}}</td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" style="padding: 10px"><p>Services not found in this week</p></td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            </div>
                        </div>
                        </div>{{--panel--}}

                </div>

            </div>
        </div>
        </div>

    </div>
