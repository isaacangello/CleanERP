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
                                    <div class="card">
                                        <div class="card-header">
                                        <span class="font-bold text-xs">{{$empName}}</span>
                                            <span wire:loading wire:target="confirmService ,btnFeeService"  class="loading loading-spinner loading-xs"></span>
                                        </div>

                                            <table class="table-auto w-full text-left">
                                                <tbody>
{{--                                                @php dd($employeesIds, $data,$week) @endphp--}}
                                                @foreach($data as $weekDayLabel => $row)
{{--                                                        @php(var_dump($row)."<br><br>")--}}
                                                        <x-home-card-week-day :week-day-label="$weekDayLabel" :data="$row"  :$week :emp-name="$empName" :employee-id="$employeeId" />
                                                @endforeach
                                                </tbody>
                                            </table>
                                    </div>


</div>
