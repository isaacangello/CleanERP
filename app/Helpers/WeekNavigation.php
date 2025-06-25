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
    public array|null $week = null;
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

//        $this->week = $dateTrait->getWeekByNumberWeek($this->numWeek,$this->year);
//        $this->from = Carbon::create($this->week['Monday'])->format('m/d/Y');
//        $this->till = Carbon::create($this->week['Saturday'])->format('m/d/Y') ;

        if ($this->selectedWeek === null){$this->selectedWeek = $this->numWeek;}
        if($this->selectedYear === null){$this->selectedYear = $this->year;}

        $this->week = $dateTrait->getWeekByNumberWeek($this->numWeek, $this->year);
        $this->from = Carbon::create($this->week['Monday'])->format('m/d/Y');
        $this->till = Carbon::create($this->week['Sunday'])->format('m/d/Y');

    }
    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     *
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function resetVars(): void
    {
        $dateTrait = new DateTreatment();
        if(empty($this->numWeek)){
            $this->numWeek = $dateTrait->numberWeekByDay(now()->format('Y-m-d'));
        }

        if (empty($this->year)){
            $this->year = $dateTrait->referenceYear(now()->format('Y-m-d'));
        }

        $this->week = $dateTrait->getWeekByNumberWeek($this->numWeek,$this->year);
        $this->from = Carbon::create($this->week['Monday'])->format('m/d/Y');
        $this->till = Carbon::create($this->week['Saturday'])->format('m/d/Y') ;
        //dd($this->numWeek,$this->year, $this->week);
        if ($this->selectedWeek === null){$this->selectedWeek = $this->numWeek;}
        if($this->selectedYear === null){$this->selectedYear = $this->year;}
    }

    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @return void
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function thisWeek(): void
    {
        $dateTrait =new DateTreatment();
        $this->numWeek =  $dateTrait->numberWeekByDay(now()->format('Y-m-d'));
        $this->year = $dateTrait->referenceYear(now()->format('Y-m-d'));
        $this->resetVars();
    }

    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @return void
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function backWeek(): void
    {
        $date = new DateTreatment();
        if(($this->numWeek -1) <= 0 ){
            $this->numWeek = 52;
            $this->year--;

        }else{
            $this->numWeek--;
        }
        $this->resetVars();
    }

    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @return void
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function forwardWeek(): void
    {
        if(($this->numWeek +1) > 52 ){
            $this->numWeek = 1;
            $this->year++;
        }else{
            $this->numWeek++;
        }
        $this->resetVars();
    }

    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @return void
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function selectWeek():void
    {
        if(is_null($this->numWeek) || is_null($this->year)  ){
            $this->dispatch('toast-alert',icon:'error', message:"you need select number week and Year") ;
        }
        $this->numWeek = $this->selectedWeek;
        $this->year  = $this->selectedYear;
        $dateTrait = new DateTreatment();
        $this->week = $dateTrait->getWeekByNumberWeek($this->selectedWeek,$this->selectedYear);
        $this->from = Carbon::create($this->week['Monday'])->format('m/d/Y');
        $this->till = Carbon::create($this->week['Sunday'])->format('m/d/Y');
    }



}