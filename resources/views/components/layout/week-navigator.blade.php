<div class="row">
    <div class="col s12 m2 input-field">
    </div>
    <div class="col s12 m2 input-field">
        <div class="form-group">
            <form wire:submit.prevent="thisWeek()">
                <x-standard-btn type="submit" class="font-15 h-45" >
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

                <form >
                    <x-text-input type="hidden"  name="numberweek"></x-text-input>
                    <x-text-input type="hidden"  name="year"></x-text-input>
                    <x-standard-btn type="submit" class="font-15 h-45">
                                            <span class="material-symbols-outlined">
                                                arrow_back
                                            </span>
                    </x-standard-btn>
                </form>
        </div>
    </div>
    <form >
        <div class="col s12 m2 input-field" >
            <div class="form-group">
                <div class="form-line success">
                    <select wire:model="nunWeek" class="form-control  materialize-select" >
                        <option value="{{ $numWeek??'' }}">week {{$numWeek??''}}</option>
                        @for ($i = 1; $i < 53; $i++)
                            <option value="{{$i}}">week {{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="col s12 m2 input-field">
            <div class="form-group">
                <div class="form-line success">

                    <select wire:model="year" class="form-control materialize-select">
                        <option value="{{$year??now()->format("Y")}}">{{$year??'current year'}}</option>
                        @for ($i = 2020; $i < 2031; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor

                    </select>
                </div>
            </div>
        </div>
        <div class="col s12 m1 input-field">
            <x-standard-btn type="submit" class="font-15 h-45" wire:click.prevent="selectedWeek()">
                go
            </x-standard-btn>
        </div>
    </form>
    <div class="col s12 m1 input-field align-left">
        <div class="form-group">
            <form wire:submit.prevent="forwardWeek('{{$numWeek_arrow_f??''}}','{{$year_arrow_f??''}}')">
                <x-text-input type="hidden" value="{{$numWeek_arrow_f??''}}" wire:model="numWeek"></x-text-input>
                <x-text-input type="hidden" value="{{$year_arrow_f??''}}" wire:model="year"></x-text-input>
                <x-standard-btn type="submit" class="font-15 h-45">
                                            <span class="material-symbols-outlined">
                                                arrow_forward
                                            </span>
                </x-standard-btn>
            </form>
        </div>
    </div>
<div>
    week {{var_export($numWeek??'')}}<br>
    year {{var_export($year??'')}}<br>
    prev year{{var_export($previousYear??'')}}<br>
    next year {{var_export($nextYear??'')}}<br>
    prev week{{var_export($previousWeek??'')}}<br>
    next week {{var_export($numWeek_arrow_f??'')}}<br>
<br>
    {{ now()->format('D, d M Y H:i:s') }}
</div>
</div>