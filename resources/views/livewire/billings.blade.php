<div class="container-fluid">
    <div class="block-header">
        <h2>
            <small class="uppercase-text">billings REGISTER AND VIEW</small>
        </h2>
    </div>
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col s12 m12">
            <div class="card">
                <div class="header" style="padding-bottom: 0;">
                    <div class="row">
                        <div class="col s12 m12">
                            <button class="btn btn-link font-12 h-45 modal-trigger"  href="#new-billing"  >New Billings</button>
                            <span id="list-of-billings" class="m-l-35">LIST OF BILLINGS</span>

                            <!-- ############  Blade  component customer-cad ###########################################################################################-->
                            <!-- component register for register new customer-->

                            <x-billings-cad />

                        </div>
                    </div>
                </div>
            </div>



                                    <div class="row">
                                        <div class="col s12 m12">
                                            <div class="card">
                                                <div class="header">
                                                    <h2 class="p-0">billings</h2>
                                                </div>
                                                <div class="body">
                                                    <div class="table-responsive ">
                                                        <table class="table table-hover dashboard-task-infos highlight">
                                                            <thead>
                                                            <tr>
                                                                <th class="flow-text">label</th>
                                                                <th class="flow-text">value</th>
                                                                <th class="flow-text">hint</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <!--
                                                                Chamada Principal
                                                                https://meet.google.com/pbx-ngck-evi
                                                                Chamada Residencial
                                                                https://meet.google.com/vvh-zxmn-cjc
                                                                Chamada Comercial
                                                                https://meet.google.com/cot-jkcr-dgw
                                                                Chamada Extra
                                                                https://meet.google.com/mec-cngi-feo
                                                            -->

                                                        @foreach($billing as $row)

                                                                <livewire:td id="{{ $row->id }}"  value="{{ $row->value }}" />

                                                        @endforeach
                                                            </tbody>
                                                        </table>
{{--                                                        <button class="btn btn-link white-text" wire:click="toast">Click</button>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

            </div>
            <button
                    class="btn btn-link"
                    wire:click.prevent="showtoast"
                    wire:confirm="Are you sure you want to delete this post?"
            >
                teste
            </button>
        </div>

