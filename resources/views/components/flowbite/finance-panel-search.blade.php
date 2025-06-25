<div class="w-full border border-gray-100 mb-4 py-2.5" >
    <div class="pl-4 pr-1 py-1 font-bold">
        Search
    </div>
    <div>
            <form wire:submit.prevent="searchServices()" class="w-full" >
                <div class="flex gap-4 border  justify-center items-center">
                        <div class="">
                            <x-flowbite.input-label>Select employee.</x-flowbite.input-label>
                            <x-flowbite.select id="select-finance-employee" class="form-control browser-default livewire-select font-12 h-30" wire:model="selectedEmployee" >
                                <option  value="{{$id??'1'}}">This employee</option>

                                @foreach($employees as $employee)
                                    <option wire:key="empKey{{$employee['id']}}"  value="{{$employee['id']}}" @if($id === $employee['id']) selected @endif >{{ $employee['name'] }}</option>
                                @endforeach
                            </x-flowbite.select>
                            @error('selectedEmployee')
                            @script
                            <script>
                                console.log("error in plus")
                                $wire.dispatch('toast-btn-alert', {icon:'error', title:"Error", text:"{{$message}}"})
                            </script>
                            @endscript
                            @enderror
                        </div>
                        <div>
                            <x-flowbite.input-label class="form-label" for="input-finance-from">From</x-flowbite.input-label>
                            <x-flowbite.flatpickr-date id="input-finance-from"   wire:model="from"   title="Type init date." />

                        </div>
                        <div>
                            <x-flowbite.input-label class="form-label" for="input-finance-till">Till</x-flowbite.input-label>
                            <x-flowbite.flatpickr-date id="input-finance-till"    wire:model="till" title="Insert date till." />

                        </div>
                        <div>
                            <x-flowbite.input-label class="form-label" >&nbsp;</x-flowbite.input-label>
                                <x-flowbite.btn-blue type="submit">Search</x-flowbite.btn-blue>
                        </div>
                </div>
        </form>
    </div>


</div>