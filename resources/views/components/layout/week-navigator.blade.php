<div class="row">
    <div class="col s12 m2 input-field">
        <div class="form-group">

            <button class="btn btn-link font-15 h-45 modal-trigger" href="#new-schedule">
                New schedule
            </button>
        </div>
    </div>
    <div class="col s12 m2 input-field">
        <div class="form-group">
            <form action="{{ route('commercial.schedule') }}">
                <x-standard-btn type="submit" class="font-15 h-45">
                    This week
                </x-standard-btn>
            </form>
        </div>
    </div>
    <div class="col s12 m1 input-field align-left">
        <div class="form-group">
            @php
                //numberweek=28&year=current
                if (!isset($year) || $year == "current"){$year=now()->format("Y");}
//                dd($year);
                if(isset($numWeek)){
                    if($numWeek >= 52){
                        $numWeek_arrow_f=1;
                        $year_arrow_f = $year + 1;
                    }else{
                        $numWeek_arrow_f= $numWeek + 1;
                        $year_arrow_f = $year;
                    }
                    if($numWeek <= 1){
                        $numWeek_arrow_b=52;
                        $year_arrow_b = $year - 1;

                    }else{
                        $numWeek_arrow_b= $numWeek - 1;
                        $year_arrow_b = $year;
                    }
                }
                //dd($weekArr);
            @endphp

                <form action="{{ route('week')}}">
                    <x-text-input type="hidden" value="{{$numWeek_arrow_b??''}}" name="numberweek"></x-text-input>
                    <x-text-input type="hidden" value="{{$year_arrow_b??''}}" name="year"></x-text-input>
                    <x-standard-btn type="submit" class="font-15 h-45">
                                            <span class="material-symbols-outlined">
                                                arrow_back
                                            </span>
                    </x-standard-btn>
                </form>
        </div>
    </div>
    <form action="{{ route('commercial.schedule') }}">
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
            <x-standard-btn type="submit" class="font-15 h-45">
                go
            </x-standard-btn>
        </div>
    </form>
    <div class="col s12 m1 input-field align-left">
        <div class="form-group">
            <form action="{{ route('commercial.schedule')}}">
                <x-text-input type="hidden" value="{{$numWeek_arrow_f??''}}" name="numberweek"></x-text-input>
                <x-text-input type="hidden" value="{{$year_arrow_f??''}}" name="year"></x-text-input>
                <x-standard-btn type="submit" class="font-15 h-45">
                                            <span class="material-symbols-outlined">
                                                arrow_forward
                                            </span>
                </x-standard-btn>
            </form>
        </div>
    </div>
<div>
    week {{var_export($numWeek)}}//
    year {{var_export($year)}}//
    prev year{{var_export($previousYear)}}//
    next year {{var_export($nextYear)}}//
    prev week{{var_export($previousWeek)}} //
    next week{{var_export($nextWeek)}} //

</div>
</div>