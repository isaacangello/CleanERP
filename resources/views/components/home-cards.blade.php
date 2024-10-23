<div>
    <!-- home card components
        this component was written to iterate through the data for the week by employee
        /**
        Tela home week tratando  tables
        materialize colors
        yellow darken-3 : #f9a825;
        yellow: #fff176;
        green darken-3: #2e7d32;
        */
    -->
                            <div class="col s12 m3">
                                <div class="card card-gradient-background z-depth-3 white-text">
                                    <div class="card-content card-content-min">
                                        <span class="card-title">{{$empName}}</span>
                                        <p>
                                            <table class="table-home green darken-3 centered">
                                                <tbody>
{{--                                                @php dd($data) @endphp--}}
                                                @foreach($data as $weekDayLabel => $row)
{{--                                                        @php(var_dump($row)."<br><br>")--}}
                                                        <x-home-card-week-day :week-day-label="$weekDayLabel" :data="$row" />
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </p>
                                    </div>
                                </div>
                            </div>


</div>
