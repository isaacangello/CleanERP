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
                <div class="header">
                    <div class="w-25p">
                            <button class="btn btn-link font-12 h-45 modal-trigger"  href="#new-billing"  >New Billings</button>
                            <span id="list-of-billings">LIST OF BILLINGS</span>

                            <!-- ############  Blade  component customer-cad ###########################################################################################-->
                            <!-- component register for register new customer-->
                            <x-billings-cad />
                    </div>

                        <div class="w-25p valign-wrapper" style="display: flex; ">
                            <h2 class="text-center valign-wrapper m-r-5">Show deleted items.</h2>
                            <div class="switch">
                                <label>
                                    Off
                                    <input type="checkbox" wire:model="showHiddenRegs"  wire:change="toggleShowHiddenRegs">
                                    <span class="lever"></span>
{{--                                    {{var_export($showHiddenRegs)}}--}}
                                    On
                                </label>
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
                                                    <div class="table-responsive">
                                                        <table class="table table-hover dashboard-task-infos highlight">
                                                            <thead>
                                                            <tr>
                                                                <th class="flow-text">label</th>
                                                                <th class="flow-text">value</th>
                                                                <th class="flow-text">hint</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @error('value')
                                                                <tr>
                                                                    <td colspan="3" class="red-text text-darken-3"> {{ $message }}  </td>
                                                                </tr>
                                                            @enderror
                                                            @error('hint')
                                                                <tr>
                                                                    <td colspan="3" class="red-text text-darken-3"> {{ $message }}  </td>
                                                                </tr>
                                                            @enderror

                                                        @foreach($billing as $row)


                                                                <livewire:td id="{{ $row->id }}" :model="$row" value="{{ $row->value }}" :key="$row->id"  />

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
{{--            <button--}}
{{--                    class="btn btn-link"--}}
{{--                    wire:click="showtoast"--}}
{{--                    wire:confirm="Are you sure you want to delete this post?"--}}
{{--            >--}}
{{--                teste--}}
{{--            </button>--}}
            <x-custom-events />
</div>

