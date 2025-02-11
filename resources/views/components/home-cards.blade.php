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

                                    <div class="card shadow-xl rounded-sm border bg-white/60 backdrop-blur-md dark:bg-gray-800">
                                        <div class="card-header p-4 border-b text-xs">{{$empName}}</div>

{{--                                                @php dd($employeesIds, $data,$week) @endphp--}}
                                                @foreach($data as $weekDayLabel => $row)
{{--                                                        @php(var_dump($row)."<br><br>")--}}
                                                        <x-home-card-week-day :week-day-label="$weekDayLabel" :data="$row"  :$week :emp-name="$empName" :employee-id="$employeeId" />
                                                @endforeach
                                    </div>


</div>
