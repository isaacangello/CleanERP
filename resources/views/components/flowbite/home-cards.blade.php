<div>
    <!-- home card components
        this component was written to iterate through the data for the week by employee
    -->

                                    <div class="card shadow-xl rounded-md border bg-white/30 backdrop-blur-md dark:bg-gray-800">
                                        <div class="card-header p-4 border-b text-xs">{{$empName}}</div>
                                                @foreach($data as $weekDayLabel => $row)
                                                        <x-home-card-week-day :week-day-label="$weekDayLabel" :data="$row"  :$week :emp-name="$empName" :employee-id="$employeeId" />
                                                @endforeach
                                    </div>


</div>
