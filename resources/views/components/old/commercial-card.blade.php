
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
@if($dayName != "Saturday" and $dayName != "Sunday" )

        <div class="card green darken-3 white-text">
            <div class="card-content card-content-min">
                <span class="card-title font-12">{{ $dayName??''  }} - {{ $day??'' }}  </span>
                <p>
                <table class="table-home green darken-3 centered">
                    <tbody>
                            <tr class="yellow-row"><td>&nbsp;</td></tr>
                            <tr class="yellow-row"><td>&nbsp;</td></tr>
                            <tr class="yellow-row"><td>&nbsp;</td></tr>
                    </tbody>
                </table>

                </p>
            </div>
        </div>

@endif

