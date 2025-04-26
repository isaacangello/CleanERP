<div class="flex gap-2 justify-center">
    <div class="" >
        <form action="{{route($route??'home')}}">
            <x-flowbite.btn-blue type="submit" class="" >
                <i class="fa-duotone fa-solid fa-house-user"></i>
            </x-flowbite.btn-blue>
        </form>
    </div>
        {{ $btns }}
    <div>

    </div>
    <div class="">
            <form wire:submit.prevent="thisWeek()">
                <x-flowbite.btn-blue type="submit" class="" >
                    This week
                </x-flowbite.btn-blue>
            </form>
    </div>
    <div class="">
            @php
                //numbered=28&year=current
            @endphp


            <x-flowbite.btn-blue wire:click="backWeek()" type="submit" class="">
                <i class="fa-duotone fa-solid fa-backward"></i>
            </x-flowbite.btn-blue>
    </div>
    <div class="">

            <x-flowbite.btn-blue wire:click="forwardWeek()" type="submit" class="">
                <i class="fa-duotone fa-solid fa-forward"></i>
            </x-flowbite.btn-blue>
    </div>

    <form wire:submit.prevent="selectWeek()" class="flex gap-2 ">
        <div class="" >
                    <select wire:model="selectedWeek"  class="px-5 py-2 font-medium rounded-lg text-sm" >
                        <option value="{{$selectedWeek}}">week {{$selectedWeek}}</option>
                        @for ($i = 1; $i < 53; $i++)
                            <option wire:key="selectedWeek{{$i}}" value="{{$i}}">week {{$i}}</option>
                        @endfor
                    </select>

        </div>

        <div class="">
            <select wire:model="selectedYear"  class="px-5 py-2 font-medium rounded-lg text-sm">
                <option value="{{$selectedYear??now()->format('Y')}}">{{$selectedYear??now()->format('Y')}}</option>
                @for ($i = 2020; $i < ((int)now()->format('Y'))+5; $i++)
                    <option wire:key="selectedYear{{$i}}" value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="">
            <x-flowbite.btn-blue type="submit" class="">
                go
            </x-flowbite.btn-blue>
        </div>
    </form>
    <div class="">
            <x-flowbite.btn-blue wire:click="forwardWeek()" type="submit" class="">
                <i class="fa-duotone fa-solid fa-forward"></i>
            </x-flowbite.btn-blue>
    </div>
</div>
