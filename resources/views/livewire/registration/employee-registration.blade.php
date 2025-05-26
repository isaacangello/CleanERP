<div
x-data=" {
    showEmployeeCreate: @entangle('showEmployeeCreate'),
    showEmployeeEdit: @entangle('showEmployeeEdit'),
    selectTab: ()=> console.log('Provide Compatibility'),
    focusables() {
        let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
        return [...$el.querySelectorAll(selector)]
            .filter(el => ! el.hasAttribute('disabled'))
    },
    firstFocusable() { return this.focusables()[0] },
    lastFocusable() { return this.focusables().slice(-1)[0] },
    nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
    prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
    nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
    prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 }
}"
x-init="customEvents()"
>
    <div wire:loading.class.remove="hidden" class="hidden fixed w-full h-full">
        <div>
            <img src="{{ asset('img/loading.gif') }}" alt="loading" class="w-36" style="margin-left: 40vw; margin-top: 10vh">
        </div>
    </div>

    <div class="w-full">
        <div class="header w-full p-4">
            <i class="fa-duotone fa-regular fa-user-magnifying-glass font-medium"></i> Search employee
        </div>

        <div class="w-full">
            <div class="flex space-x-2 items-end justify-center p-2 mb-3 border border-gray-300 bg-white shadow-md sm:rounded-lg">

                <div>
                    <label>&nbsp;</label>
                    <x-flowbite.btn-blue wire:click="createEmployeeEvent" class="py-2.5">
                        <i class="fa-duotone fa-regular fa-user-plus"></i>
                    </x-flowbite.btn-blue>
                </div>

                <div>
                    <span>&nbsp;</span>
                    <x-flowbite.input
                        label="Search Employee"
                        placeholder="Search Employee"
                        wire:model.live.debounce="search"
                        class="text-sm h-30"
                    />
                </div>
                <div>
                    <x-flowbite.select wire:model="searchFilterType" title="select type of employee to search">
                        <option value="ALL">All</option>
                        <option value="COMMERCIAL">Commercial</option>
                        <option value="RESIDENTIAL">Residential</option>
                    </x-flowbite.select>
                </div>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2">

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        @if($this->data)
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Created At</th>
                                <th scope="col" class="px-6 py-3">Employee</th>
                                <th scope="col" class="px-6 py-3 hidden md:block">Type</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                            </tr>
                            @php $counter = 0; @endphp
                            @foreach($this->data as $key => $data)
                                <tr wire:key="emp{{ $key }}" class="{{ \App\Helpers\Funcs::altClass($counter, ['bg-gray-100', 'bg-white text-gray-600']) }}">
                                    <td class="px-6 py-3">
                                        <span class="hidden md:block">{{ Carbon\Carbon::create($data->created_at)->format('l, m/d/Y h:i A') }}</span>
                                        <span class="block md:hidden text-sm">{{ Carbon\Carbon::create($data->created_at)->format('m/d/Y') }}</span>
                                    </td>
                                    <td class="px-6 py-3">
                                        <a title="Click to Edit employee information." class="hover:text-gray-900 hover:underline cursor-pointer text-blue-950" wire:click="editEmployee({{ $data->id }})">{{ $data->name }}</a>
                                    </td>
                                    <td class="px-6 py-3 hidden md:block">
                                        <span class="@if($data->type == 'COMMERCIAL') text-gray-700 @else text-blue-700 @endif">{{ $data->type }}</span>
                                    </td>
                                    <td class="px-6 py-3" colspan="2">
                                        <a class="hover:text-gray-900 hover:underline  cursor-pointer" wire:click="changeStatus({{ $data->id }})" title="Click to change status.">
                                            <span>{{ $data->status }}</span>
                                        </a>
                                    </td>
                                </tr>
                                @php $counter++; @endphp
                            @endforeach
                        @else
                            <tr class="px-6 py-3">
                                <td colspan="3" class="text-center">Not found</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
            <div class="w-full">
                <div>
                    <div class="py-7 flex justify-center">
                        @if(!is_array($this->data))
                            {{ $this->data->links() }}
                        @endif
                    </div>
                </div>
            </div>
    </div>
    <x-flowbite.employee-html-form :$formType :$showEmployeeEdit />
</div>





