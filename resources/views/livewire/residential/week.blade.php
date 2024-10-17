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
                            <span>
                              Week Number <span class="yellow-text text-darken-4">{{ $numWeek }}</span> / From <span
                                        class="label-date-home">{{ $from }}</span> - Till <span
                                        class="label-date-home">{{ $till }} </span><div class="displaytest">Iphone</div>
                            </span>
                            <span>Tela sendo Refeita por causa de erro no servidor ainda en recontrução</span>
                    </div>
                    <x-service-cad :employees="$selectOptionsEmployees" :customers="$selectOptionsCustomers" :num-week="$numWeek" :$year>

                    </x-service-cad>
                    <div class="body">
                        <x-btn-week-navigator :$route :$selectedWeek>
                            <x-standard-btn >   New service  </x-standard-btn>
                        </x-btn-week-navigator>
                        <div class="row" id="htmlContent">
                            {!! $this->dataCard() !!}
                        </div> <!--grid system row-->
                    </div> <!--card body-->
                </div> <!--card -->


            </div><!-- col -->
        </div>  <!-- row -->
        <x-service-details  :employees="$selectOptionsEmployees" :customers="$selectOptionsCustomers" />
        <x-custom-events />
    </div>

