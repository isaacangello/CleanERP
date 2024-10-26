    <div class="row m-b-0 hide-on-small-and-down">

        {{--========================= desktop   ============================================================================--}}
            <div class="col s4 m2 input-field">
                {{ $slot }}
            </div>

            <div class="col s4 m1 input-field">
                {!! $slot2??"&nbsp;" !!}
            </div>
            <div class="col s4 m2 input-field">
                <div class="form-group">
                    <form wire:submit.prevent="thisWeek()">
                        <x-standard-btn type="submit" class="btn-small z-depth-3" >
                            This week
                        </x-standard-btn>
                    </form>
                </div>
            </div>
            <div class="col s6 m1 input-field align-left ">
                <div class="form-group">
                    <x-standard-btn wire:click="backWeek()" type="submit" class="btn-small z-depth-3">
                        <span class="material-symbols-outlined">
                            arrow_back
                        </span>
                    </x-standard-btn>
                </div>
            </div>
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
                <div class="col s5 m2 input-field">
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
                <div class="col s2 m1 input-field">
                    <x-standard-btn type="submit" class="btn-small z-depth-3">
                        go
                    </x-standard-btn>
                </div>
            </form>

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

