<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Treatment\DateTreatment;
use Carbon\CarbonPeriod;
class ServicesController extends Controller
{

    private Service $service;
    private DateTreatment $date;
    public function __construct(Service $service,DateTreatment $date)
    {
        $this->service = $service;
        $this->date = $date;
    }

    public function home(Request $request){
        if (isset($request->year)){$year = $request->year;}else{$year = 'current';}
        if(isset($request->numberweek) and intval($request->numberweek) >=1 and intval($request->numberweek) <=52 ){
//            dd($request->numberweek);
            $weekarr = $this->date->getWeekByNumberWeek($request->numberweek,$year);

        }else{
            $numweek = 1;
//            dd($numweek);
            $weekarr = $this->date->getWeekByNumberWeek($numweek,$year);
        }
//         dd($today);


//        dd($weekarr);


        return view('home',
        [
           'weekarr' => $weekarr,
        ]);
    }
}
