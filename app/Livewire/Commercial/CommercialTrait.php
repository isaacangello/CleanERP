<?php

namespace App\Livewire\Commercial;

use App\Helpers\Funcs;
use App\Treatment\DateTreatment;
use Carbon\Carbon;
use App\Models\Schedule as  ScheduleModel;
use Spatie\Html\Elements\Div;
use Spatie\Html\Elements\Element;

trait CommercialTrait
{
    public static function createCommercialCard(array $trTds,string $cardTile):string{
        //dd($trTds);
        $trs_temp = '';
        foreach ($trTds as $EmpNameKey => $arr){

            //dd($arr);
            $trs_temp .= Element::withTag('tr')->class('blue-grey white-text')->addChild(Element::withTag('td')->class('align-center p-t-5 p-b-5')->addChild(Element::withTag('h6')->class('font-12 margin-0')->text($EmpNameKey)));
            foreach ($arr as $value){
                $schedule_date = Carbon::create($value->schedule_date);
//                dd($value->id, $schedule_date->format('l F\\, jS\\, Y h:i a'));
                if($schedule_date->format('H')< 12 ){
                    $denomination_class = "light-blue-text  text-darken-4";
                }
                if($schedule_date->format('H')>= 12 and $schedule_date->format('H') < 18){
                    $denomination_class = "blue-grey-text  text-darken-4";
                }
                if($schedule_date->format('H')>= 18 ){
                    $denomination_class = "deep-orange-text  text-darken-4";
                }
                $cust = $value->customer->name;
                $emp = $value->employee->name;
                $customer_print = empty($value->denomination)?Funcs::nameShort($value->customer->name,' ',2):$value->denomination;
                $title ="
                Denomination: $customer_print  \r\nCustomer: $cust  \r\nEmployee: $emp \r\nSchedule Date: ".$schedule_date->format('l F\\, jS\\, Y \\/ h:i a')."\r\n";

                $trs_temp .= Element::withTag('tr')->class('yellow-row')->addChild(Element::withTag('td')
                    ->addChildren(
                        [
                            Div::create()->attributes([
                                'class' => 'hide',
                                'id' => 'scheduleId'
                            ]),

                            Element::withTag('a')->attributes([
                                'data-schedule-id' => $value->id,
                                'wire:click' => "populateModal($value->id)",
                                '@click'=>"open = !open",
                                'class'=> "btn-link-underline pointer link-modal-commercial m-l-5 $denomination_class" ,
                                'title' => $title,
                            ])->text($schedule_date->format('h:i a')." - ".Funcs::nameShort($customer_print,' ',1  ))
                        ]
                    )
                );
            }
        }

        return Div::create()->addChild(
            Div::create()->class('modal-dialog z-depth-3')
                ->addChild(
                    Div::create()->class('modal-content modal-col-white')
                        ->addChild(
                            Div::create()->class('header center-align font-12 p-t-10 p-b-10')->addChild(
                                Element::withTag('h5')->class('modal-title w-full center-align green-text text-darken-4 font-13 padding-0 margin-0')->text($cardTile)
                            )
                        )
                        ->addChild(Element::withTag('p')->addChild(Element::withTag('table')->class('table-card')->addchild($trs_temp))
                            ->addChild(Div::create()->class('modal-footer footer-commercial-card p-t-10 p-b-10')->text('&nbsp;'))
                        )
                )
        )->render();

    }



    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @param $from
     * @param $till
     * @param $nunWeek
     * @param $year
     * @param $team
     * @return string
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function buildCard($from,$till,$nunWeek,$year,string $team='scale1'): string
    {
        $dateTrait = new DateTreatment();
        $weekArr = $dateTrait->getWeekByNumberWeek($nunWeek,$year);

//        dd($filteredWeekGroup);
        $schedule = new ScheduleModel();
        $data = $schedule->with('customer','employee')

            ->whereDate('schedule_date','>=' , Carbon::create($from)->format('Y-m-d H:i:s') )
            ->whereDate('schedule_date','<=' , Carbon::create($till)->format('Y-m-d H:i:s') )
            ->where('team',$team)
            ->orderBy('schedule_date')->get();
        //dd($data);

        //dd($card);

        $schedulesPerDay = [];
//        dd($data);
        foreach ($data as $item){
//            echo $item->schedule_date."<br>";
            $scheduleDateCarbon = Carbon::create($item->schedule_date);
            $scheduleDateFormated = $scheduleDateCarbon->format('Y-m-d');
            if($scheduleDateCarbon->isMonday()){
                $schedulesPerDay[$scheduleDateFormated][] =  $item;
            }
            if($scheduleDateCarbon->isTuesday()){
                $schedulesPerDay[$scheduleDateFormated][] =  $item;
            }
            if($scheduleDateCarbon->isWednesday()){
                $schedulesPerDay[$scheduleDateFormated][] =  $item;
            }
            if($scheduleDateCarbon->isThursday()){
                $schedulesPerDay[$scheduleDateFormated][] =  $item;
            }
            if($scheduleDateCarbon->isFriday()){
                $schedulesPerDay[$scheduleDateFormated][] =  $item;
            }
        }
        $schedulesPerDayAndEmployee = [];
        //dd(array_key_exists()$schedulesPerDay['Friday']);
        foreach ($schedulesPerDay as $dayString => $dataSchedule){
            $schedulesPerDayAndEmployee[$dayString] = [];
            foreach ($dataSchedule as $data){
                $schedulesPerDayAndEmployee[$dayString][$data->employee->name][] = $data;
            }
        }
        //dd($schedulesPerDayAndEmployee);
        $cards = '';
        foreach ($schedulesPerDayAndEmployee as $dayString => $dataSchedule){
            if($dayString != "Saturday" and $dayString != "Sunday" ){
                $textRowTd = [];
                //dd($dataSchedule);
                $cards .=  $this->createCommercialCard($dataSchedule, Carbon::create($dayString)->format('l \\- m/d/Y'));
            }
        }
        return $cards;
    }

}