<div class="row m-b-0">
    <div class="col s12 m2 input-field">
        <form action="{{route('finances')}}">
            <x-standard-btn type="submit" class="btn-small" >
                <span class="material-symbols-outlined font-15">
                house
                </span>
            </x-standard-btn>
        </form>
    </div>
    <div class="col s12 m2 input-field">
        <div class="form-group">
            <form wire:submit.prevent="thisWeek()">
                <x-standard-btn type="submit" class="btn-small" >
                    This week
                </x-standard-btn>
            </form>
        </div>
    </div>
    <div class="col s12 m1 input-field align-left">
        <div class="form-group">
            @php
                //numbered=28&year=current
            @endphp


            <x-standard-btn wire:click="backWeek()" type="submit" class="btn-small">
                <span class="material-symbols-outlined">
                    arrow_back
                </span>
            </x-standard-btn>
        </div>
    </div>
    <form wire:submit.prevent="selectWeek()">
        <div class="col s12 m2 input-field" >
            <div class="form-group">
                <div class="form-line success">
                    <select wire:model="selectedWeek"  class="form-control browser-default h-30 font-12" >
                        <option value="{{$selectedWeek}}">week {{$selectedWeek}}</option>
                            @for ($i = 1; $i < 53; $i++)
                                <option wire:key="selectedWeek{{$i}}" value="{{$i}}">week {{$i}}</option>
                            @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="col s12 m2 input-field">
            <div class="form-group">
                <div class="form-line success">
                    <select wire:model="selectedYear"  class="form-control browser-default h-30 font-12">
                        <option value="{{$selectedYear??now()->format('Y')}}">{{$selectedYear??now()->format('Y')}}</option>
                        @for ($i = 2020; $i < ((int)now()->format('Y'))+5; $i++)
                            <option wire:key="selectedYear{{$i}}" value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="col s12 m1 input-field">
            <x-standard-btn type="submit" class="btn-small">
                go
            </x-standard-btn>
        </div>
    </form>
    <div class="col s12 m1 input-field align-left">
        <div class="form-group">
            <x-standard-btn wire:click="forwardWeek()" type="submit" class="btn-small">
                <span class="material-symbols-outlined">
                    arrow_forward
                </span>
            </x-standard-btn>
        </div>
    </div>
</div>
