<div>
    <div wire:loading class="fixed w-full h-full">
        <div>
            <img src="{{asset('img/loading.gif')}}" alt="loading" class="w-36 " style="margin-left: 40vw; margin-top: 10vh">
        </div>
    </div>

    <div class="w-full">
        <div class="panel panel-default" >
            <div class="panel-heading p-l-15 p-t-2 p-r-2 p-b-2">
                Configs
            </div>

            <div class="panel-body">

                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="save">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="border-b border-gray-400">
                            <label for="nun_reg_pages">Number of pages:</label>
                            <input type="number" id="nun_reg_pages" class="form-control padding-0" wire:model="configFrom.nun_reg_pages" >
                            @error('config.nun_reg_pages') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="border-b border-gray-400">
                            <label for="theme">theme:</label>
                            <input type="text" id="theme" class="form-control padding-0" wire:model="configFrom.theme" >
                            @error('config.theme') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="border-b border-gray-400">
                            <label for="spots">Spots:</label>
                            <input type="number" id="spots" class="form-control padding-0" wire:model="configFrom.spots" >
                            @error('config.spots') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                        <div class="pt-3">
                            <x-standard-btn type="submit"  >SAve</x-standard-btn>
                        </div>

                    </form>

            </div>
        </div>
    </div>
    <x-custom-events />
</div>