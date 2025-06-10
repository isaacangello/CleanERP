<div>
    <div wire:loading class="fixed w-full h-full">
        <div>
            <img src="{{asset('img/loading.gif')}}" alt="loading" class="w-36 " style="margin-left: 40vw; margin-top: 10vh">
        </div>
    </div>

    <div class="w-full">
        <div class="header w-full p-4">
            Search Employee
        </div>

        <div class="w-full" >
            <div class="flex space-x-2 items-end justify-center p-2 mb-3 border border-gray-300">
                <div>
                    <x-flowbite.input
                            label="Search Employee"
                            placeholder="Search Employee"
                            wire:model.live.debounce="search"
                            class="text-sm"
                    />
                </div>
                <div>

                    <x-flowbite.select wire:model="searchFilterType" >
                        <option selected value="ALL"> All </option>
                        <option value="COMMERCIAL">Commercial</option>
                        <option value="RESIDENTIAL">Residential</option>
                    </x-flowbite.select>
                </div>
            </div>
        </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-2">

                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        @if($this->data)
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Created At</th>
                                    <th scope="col" class="px-6 py-3">Employee</th>
                                    <th scope="col" class="px-6 py-3">Type</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            @php $counter = 0; @endphp

                            @foreach($this->data as $key => $data)
                                <tr wire:key="emp{{$data->id}}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td  class="px-6 py-3">{{Carbon\Carbon::create($data->created_at)->format('l, m/d/Y h:i A')}}</td>
                                    <td  class="px-6 py-3"><a title="Click to edit Employee information." class="cursor-pointer text-gray-700 hover:text-gray-900 hover:underline" wire:click="editEmployeeEvent({{ $data->id }})">{{$data->name}}</a></td>
                                    <td  class="px-6 py-3"><span class=" @if($data->type == "COMMERCIAL") text-gray-700 @else text-blue-700 @endif ">{{$data->type}}</span> </td>
                                    <td  class="px-6 py-3" colspan="2">
                                        <a   class="cursor-pointer hover:text-gray-900 hover:underline" title="Click to change status"
                                                 wire:click="changeStatus({{$data->id}})"
                                        >
                                            <span>{{$data->status}}</span>
                                        </a>
                                    </td>
                                </tr>
                          @php $counter++; @endphp
                            @endforeach

                        @else

                                <tr>
                                    <td colspan="3" class="px-6 py-3 text-center"> Not found </td>
                                </tr>

                        @endif

                    </table>
            </div>
    </div>
</div>

