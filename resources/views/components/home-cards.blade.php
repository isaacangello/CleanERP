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

                                <div class="card green darken-3 white-text">
                                    <div class="card-content card-content-min">
                                        <span class="card-title">{{$empName}}</span>
                                        <p>
                                            <table class="table-home green darken-3 centered">
                                                <thead>
                                                    <tr>
                                                        <th>ESCALA 1</th>
                                                        <th>ESCALA 2</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data as $weekDayLabel => $row)

                                                        <x-home-card-week-day :week-day-label="$weekDayLabel" :data="$row" />
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </p>
                                    </div>
                                </div>
                            </div>


</div>
