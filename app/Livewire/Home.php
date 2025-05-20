<?php

namespace App\Livewire;

use App\Models\Service;
use App\Treatment\DateTreatment;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Home extends Component
{
    #[Computed]
    public function allServices() {
        $dateTrait = new DateTreatment();
     $weekDay = $dateTrait->numberWeekByDay(now()->format('Y-m-d'));
        $week = $dateTrait->getWeekByNumberWeek($weekDay,now()->format('Y'));
     return Service::select('id')
         ->whereDate('service_date','>=',$week['Monday'])
         ->whereDate('service_date','<=',$week['Sunday'])->count();
    }
    public $weekServices = 0;
    public function render()
    {
        return view('livewire.home');
    }
}
