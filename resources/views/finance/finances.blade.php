@extends("layouts.main_old")
@section('title')
    <title>Finances - main - CleanERP 2</title>
@endsection
{{--css links para o head--}}
@section('css-style')
    @include('layouts.generic_css')
@endsection

@section('content')
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
                        <span id="list-of-customer" class="m-l-35">FINANCES</span>
                    </div>

                    <div class="body">
                        <div class="row clearfix">
                            <div class="col s6 m6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <small>Seach paid</small>
                                    </div>
                                    <div class="panel-body p-l-3 p-r-3" style="height:35vh;">
                                        <div class="row">
                                            <div class="input-field col s12 m12">
                                                <div class="form-group">
                                                    <div class="form-line success">
                                                        <select id="select-finance-employee"
                                                                class="form-control materialize-select"
                                                                name="finance-employee">
                                                            <option selected value=""></option>
                                                            @foreach($employees as $employee)
                                                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="help-info">Select employee.</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12 m6 ">
                                                <div class="form-group">
                                                    <div class="form-line success">
                                                        <input id="input-finance-from" name="finance-from" type="text"
                                                               class="form-control date" value="">
                                                        <label class="form-label" for="input-finance-from">From</label>
                                                    </div>
                                                    <div class="help-info">Insert date from.</div>
                                                </div>
                                            </div>
                                            <div class="input-field col s12 m6">
                                                <div class="form-group">
                                                    <div class="form-line success">
                                                        <input id="input-finance-till" name="finance-till" type="text"
                                                               class="form-control date" value="">
                                                        <label class="form-label" for="input-finance-till">Till</label>
                                                    </div>
                                                    <div class="help-info">Insert date till.</div>
                                                </div>

                                            </div>
                                        </div>
                                        <button class="teal waves-effect waves-classic waves-light white-text btn btn-small">
                                            Search
                                        </button>
                                    </div>
                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class="col s1"></div>
                                            <div class="col s11">
                                                &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s6 m6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <small>Payments of week</small>
                                    </div>
                                    <div class="panel-body p-l-3 p-r-3" style="height:35vh;">
                                        <div class="chart-container align-center"
                                             style="position: relative; height:30vh;">
                                            <canvas id="chart-area"></canvas>
                                        </div>
                                    </div>
                                    <div class="panel-footer" style="position: relative">
                                        <div class="row">
                                            <div class="col s1"></div>
                                            <div class="col s11">
                                                &nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col s12">
                                <table class="table table-striped highlight">
                                    <thead>
                                    <tr class="green darken-3 white-text">
                                        <th>Employee 1</th>
                                        <th>Total</th>
                                        <th>70%</th>
                                        <th>30%</th>
                                        <th>&nbsp;aaa</th>
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
                                                    <td class="hidden">{{$emp_name}}</td>
                                                    <td class="block  md:hidden">{{ Funcs::nameShort($emp_name)}} </td>
                                                    <td>{{$cem}}</td>
                                                    <td>{{$setenta}}</td>
                                                    <td>{{$trinta}}</td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" style="padding: 10px"><p>Services not found in this week</p>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="s12 p-20">
                                {{ $employees->links() }}a
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- tratando variáveis -->

        @endsection

        {{-- inclusção de scripts  no final no corpo--}}
        @section('script-botton')

            @include('layouts.generic_js')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <!-- Custom Js -->

            <script>
                /**
                 copiado do style home  tables
                 materialize colors
                 yellow darken-3 : #f9a825; rgb(249,168,37)
                 yellow: #fff176; rgb(255,241,118)
                 green darken-3: #2e7d32; rgb(46,125,50)
                 */
                const ctx = document.getElementById('chart-area');

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['100%', '70%', '30%'],
                        datasets: [
                            {

                                data: [{{$total_services['cem']}}, {{$total_services['setenta']}}, {{$total_services['trinta']}},],
                                backgroundColor: [
                                    'rgb(46,125,50,0.4)',
                                    'rgb(249,168,37,0.4)',
                                    'rgb(255,241,118,0.4)'
                                ],
                                borderColor: [
                                    'rgb(46,125,50)',
                                    'rgb(249,168,37)',
                                    'rgb(255,241,118)'
                                ],
                                borderWidth: 1,
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
@endsection


