<div class="container-fluid">
    <div class="block-header">
        <h2>
            <small class="uppercase-text">PAYMENT METHODS REGISTER AND VIEW</small>
        </h2>
    </div>
    <!-- Basic Examples -->
    <div class="row clearfix">
        <div class="col s12 m12">
            <div class="card">
                <div class="header between">
                    <div class="w-49p">
                        <button class="btn btn-link font-12  modal-trigger"  href="#new-payment"  >New Payments</button>
                        <span id="list-of-payment">LIST OF PAYMENT METHODS</span>

                        <!-- ############  Blade  component customer-cad ###########################################################################################-->
                        <!-- component register for register new customer-->
                        <x-payment-cad />
                    </div>

                    <div class="w-49p valign-wrapper" style="display: flex; justify-content: flex-end">
                        <h2 class="text-center valign-wrapper m-r-5">Show deleted items.</h2>
                        <div class="switch">
                            <label>
                                Off
                                <input type="checkbox" wire:model.live="showHiddenRegs"  wire:change="toggleShowHiddenRegs">
                                <span class="lever"></span>
{{--                                                                    {{var_export($showHiddenRegs)}}--}}
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
                            <h2 class="p-0">Payment methods</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos highlight">
                                    <thead>
                                    <tr>
                                        <th class="flow-text">title</th>
                                        <th class="flow-text" colspan="2">notes</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php


                                    @endphp
                                    @foreach($this->data as $row)

                                        <livewire:finance.payments-reg-tr :model="$row" :id="$row['id']" :$showHiddenRegs wire:key="{{$row['id']}}" @deleted="$refresh"  />

                                    @endforeach
                                    @error('title')
                                    <tr>
                                        <td colspan="2" class="red-text text-darken-3"> {{ $message }}  </td>
                                    </tr>
                                    @enderror
                                    @error('notes')
                                    <tr>
                                        <td colspan="2" class="red-text text-darken-3"> {{ $message }}  </td>
                                    </tr>
                                    @enderror

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

