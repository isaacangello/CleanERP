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
                            <div class="">
                                <div class="modal-dialog z-depth-3 m-b-20">
                                    <div class="modal-content modal-col-white">
                                        <div class="header left-align font-12 p-t-10 p-b-10">
                                        <span class="card-title font-12 font-bold">{{$empName}}</span>
                                            <div wire:loading wire:target="confirmService ,btnFeeService" class="left button--loading"></div>
                                        </div>

                                            <table class="table-card centered">
                                                <tbody>
{{--                                                @php dd($employeesIds, $data,$week) @endphp--}}
                                                @foreach($data as $weekDayLabel => $row)
{{--                                                        @php(var_dump($row)."<br><br>")--}}
                                                        <x-home-card-week-day :week-day-label="$weekDayLabel" :data="$row"  :$week :emp-name="$empName" :employee-id="$employeeId" />
                                                @endforeach
                                                </tbody>
                                            </table>

                                        <div class="modal-footer footer-commercial-card p-t-10 p-b-10">
                                                &nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>


</div>
