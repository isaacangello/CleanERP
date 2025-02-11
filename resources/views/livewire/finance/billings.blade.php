<div>
    <x-cleopatra.card body-class="p-0">
        <x-slot name="header">
            <small class="uppercase-text">billings REGISTER AND VIEW</small>
        </x-slot>
    <!-- Basic Examples -->
                            <button class="btn btn-link font-12 "   >New Billings</button>
                            <span id="list-of-billings">LIST OF BILLINGS</span>

                            <!-- ############  Blade  component customer-cad ###########################################################################################-->
                            <!-- component register for register new customer-->
{{--                            <x-old.billings-cad />--}}


                        <div class="text-sm " style="display: flex; justify-content: flex-end">
                            <h2 class="text-sm">Show deleted items.</h2>
                            <div class="switch">
                                <label>
                                    Off
                                    <input type="checkbox" wire:model.live="showHiddenRegs"  wire:change="toggleShowHiddenRegs">
                                    <span class="lever"></span>
{{--                                    {{var_export($showHiddenRegs)}}--}}
                                    On
                                </label>
                            </div>

                        </div>


                        <table class="table-auto w-full text-left">
                            <thead>
                            <tr class="border-t">
                                <th class="px-4 py-2 border-r">label</th>
                                <th class="px-4 py-2 border-r">value</th>
                                <th class="px-4 py-2">hint</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-600">
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


                                <livewire:finance.td id="{{ $row->id }}" :model="$row" value="{{ $row->value }}" :key="$row->id" :show-hidden-regs="$showHiddenRegs" />

                        @endforeach
                            </tbody>
                        </table>

            <x-old.custom-events />


    </x-cleopatra.card>
</div>

