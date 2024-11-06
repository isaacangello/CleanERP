<?php

namespace App\Helpers;

use App\Treatment\DateTreatment;
use Illuminate\Support\Carbon;

trait WeekNavigation
{
    /** this area contain var  for week navigation
     * @var string|int|null
     */
    public string|int|null $numWeek = null;
    public string|int|null $year = null;
    public string|int|null $week = null;
    public string|int|null $from;
    public string|int|null $till;

    public string|int|null $currentTab = null;
    public string|int|null $currentEmployee = null;
    public string|int|null $selectedWeek = null;
    public string|int|null $selectedYear = null;
    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     *
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function initVars(): void
    {
        $dateTrait = new DateTreatment();

        if($this->numWeek === null){
            $this->numWeek = $dateTrait->numberWeekByDay(now()->format('Y-m-d'));
        }
        if ($this->year === null){
            $this->year = now()->format('Y');
        }

//        $week = $dateTrait->getWeekByNumberWeek($this->numWeek,$this->year);
//        $this->from = Carbon::create($week['Monday'])->format('m/d/Y');
//        $this->till = Carbon::create($week['Saturday'])->format('m/d/Y') ;

        if ($this->selectedWeek === null){$this->selectedWeek = $this->numWeek;}
        if($this->selectedYear === null){$this->selectedYear = $this->year;}

        $week = $dateTrait->getWeekByNumberWeek($this->numWeek, $this->year);
        $this->from = Carbon::create($week['Monday'])->format('m/d/Y');
        $this->till = Carbon::create($week['Sunday'])->format('m/d/Y');

    }
    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     *
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function resetVars(): void
    {
        $dateTrait = new DateTreatment();
        $this->numWeek = $dateTrait->numberWeekByDay(now()->format('Y-m-d'));
        $this->year = now()->format('Y');
        $week = $dateTrait->getWeekByNumberWeek($this->numWeek,$this->year);
        $this->from = Carbon::create($week['Monday'])->format('m/d/Y');
        $this->till = Carbon::create($week['Sunday'])->format('m/d/Y');
        $this->selectedWeek = $this->numWeek;
        $this->selectedYear = $this->year;
    }


    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @return void
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function thisWeek(): void
    {
        $dateTrait =new DateTreatment();

        $this->year = now()->format('Y');
        $this->numWeek =  $dateTrait->numberWeekByDay(now());
        $this->initVars();
    }

    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @return void
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function backWeek(): void
    {
        $date = new DateTreatment();
        if(($this->numWeek -1) <= 0 ){
            $this->numWeek = 52;
            $this->year = $this->year -1;

            $newYearDate = Carbon::create($this->year,12,31,0,0,0);
            $this->from = $newYearDate->startOfWeek()->format('m/d/Y');
            $this->till = $newYearDate->startOfWeek()->addDays(6)->format('m/d/Y');
            //dd($this->year,$this->numWeek,$this->from,$this->till);
        }else{
            $this->numWeek--;
        }
        $this->initVars();

    }

    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @return void
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function forwardWeek(): void
    {
        if(($this->numWeek +1) > 52 ){
            $this->numWeek = 1;
            $this->year = $this->year +1;
            $newYearDate = Carbon::create($this->year,01,04,0,0,0);
            $this->from = $newYearDate->startOfWeek()->format('m/d/Y');
            $this->till = $newYearDate->startOfWeek()->addDays(6)->format('m/d/Y');
            //dd($this->from,$this->till,$this->year,$this->numWeek);

        }else{
            $this->numWeek++;
        }
        $this->initVars();
    }

    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @return void
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function selectWeek():void
    {
        $dateTrait = new DateTreatment();
        //dd($this->selectedWeek,$this->selectedYear);
        if(is_null($this->selectedWeek) || is_null($this->selectedYear)  ){
            $this->initVars();
        }else{

        $this->numWeek = $this->selectedWeek;
        $this->year  = $this->selectedYear;
        }
        $week = $dateTrait->getWeekByNumberWeek($this->numWeek,$this->year);
        $this->from = Carbon::create($week['Monday'])->format('m/d/Y');
        $this->till = Carbon::create($week['Sunday'])->format('m/d/Y');
    }



}