<div class="hide-on-med-and-up">
    <div class="row clearfix margin-0">
        {{--========================= mobile  ==========================================================================--}}

            <div class="col s4 m2 input-field align-left">
                {{ $slot }}
            </div>

            <div class="col s4 m1 input-field">
                {!! $slot2??"&nbsp;" !!}
            </div>
            <div class="col s4 m2 input-field align-right">
                <div class="form-group">
                    <form wire:submit.prevent="thisWeek()">
                        <x-standard-btn type="submit" class="btn-small z-depth-3" >
                            This week
                        </x-standard-btn>
                    </form>
                </div>
            </div>
    </div>
    <div class="row margin-0">
    <form wire:submit.prevent="selectWeek()">
        <div class="col s5 m2 input-field" >
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
        <div class="col s4 m2 input-field">
            <div class="form-group">
                <div class="form-line success">
                    <select wire:model="selectedYear"  class="form-control browser-default h-30 font-12">
                        <option value="{{$selectedYear??now()->format('Y')}}">{{$selectedYear??now()->format('Y')}}</option>
                        @for ($i = 2020; $i < 2031; $i++)
                            <option wire:key="selectedYear{{$i}}" value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="col s3 m1 input-field align-right">
            <x-standard-btn type="submit" class="btn-small z-depth-3">
                go
            </x-standard-btn>
        </div>
    </form>
    </div>
    <div class="row margin-0">
        <div class="col s6 m1 input-field align-left ">
            <div class="form-group">
                <x-standard-btn wire:click="backWeek()" type="submit" class="btn-small z-depth-3">
                <span class="material-symbols-outlined">
                    arrow_back
                </span>
                </x-standard-btn>
            </div>
        </div>

        <div class="col s6 m1 input-field align-right">
            <div class="form-group">
                <x-standard-btn wire:click="forwardWeek()" type="submit" class="btn-small z-depth-3">
                <span class="material-symbols-outlined">
                    arrow_forward
                </span>
                </x-standard-btn>
            </div>
        </div>
    </div>
</div>

