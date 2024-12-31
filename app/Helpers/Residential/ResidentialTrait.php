<?php

namespace App\Helpers\Residential;

use App\Helpers\Funcs;
use App\Treatment\DateTreatment;
use Illuminate\Support\Carbon;
use Spatie\Html\Elements\Div;
use Spatie\Html\Elements\Element;


trait ResidentialTrait
{
    public function traitNullVars(): void
    {
        $dateTrait = new DateTreatment();
        if(empty($this->numWeek)){
            $this->numWeek = $dateTrait->numberWeekByDay(now()->format('Y-m-d'));
        }

        if (empty($this->year)){
            $this->year = $dateTrait->referenceYear(now()->format('Y-m-d'));
        }

        $week = $dateTrait->getWeekByNumberWeek($this->numWeek,$this->year);
        $this->from = Carbon::create($week['Monday'])->format('m/d/Y');
        $this->till = Carbon::create($week['Saturday'])->format('m/d/Y') ;
        //dd($this->numWeek,$this->year, $week);
        if ($this->selectedWeek === null){$this->selectedWeek = $this->numWeek;}
        if($this->selectedYear === null){$this->selectedYear = $this->year;}

    }
    public function createResidentialCard($data, $numWeek, $year = '2024'):string{
//        dd($data);
        $return = "";

        foreach ($data as $EmpName => $array) {
            $trs_temp = '';
            $cardTitleSpan = Element::withTag('span')->class('card-title')->text($EmpName);

            foreach ($array as $weekDayLabel => $arr) {
                //dd($arr);
                if($weekDayLabel != 'Saturday' and $weekDayLabel != 'Sunday') {
                    if (array_key_exists(0, $arr)) {
                        $text_print = Funcs::carbonFormat($arr[0]->service_date);
                    } else {
                        $text_print = "";

                    }
                    $trs_temp .= Element::withTag('tr')->addChild(Element::withTag('td')->attributes(
                        [
                            'class' => 'align-center',
                            'colspan' => '1',
                        ]
                    )->text($weekDayLabel . " " . $text_print));
                    $arrayCount = sizeof($arr);
                    if (collect($arr)->isNotEmpty()) {
                        foreach ($arr as $value) {

                            if (collect($value)->isNotEmpty()) {
                                //dd($value);
                                if ($value->fee === 1) {
                                    $classes_service = "btnFeeService amber darken-3";
                                    $wireclick = "\$dispatch('trigger-cancel-fee',{id:$value->service_id})";
                                } else {
                                    $confirmClass = $value->confirmed ? 'green darken-3' : 'red darken-3';
                                    $classes_service = " btn-confirm-form " . $confirmClass;
                                    $wireclick = "confirmService($value->service_id)";
                                }
                                $spanRentalHouse = $value->cust_type === 'RENTALHOUSE' ? Element::withTag('span')->class('material-symbols-outlined')->text('brightness_7') : '';
                                $trs_temp .= Element::withTag('tr')->class('yellow-row')->addChild(Element::withTag('td')->class('valign-wrapper')
                                    ->addChildren(
                                        [
                                            Div::create()->class('hide')->attributes([
                                                'id' => 'serviceId',
                                                'class' => 'hide'
                                            ]),
                                            Div::create()->class('left valign-wrapper center-align padding-0')->addChild(

                                                Element::withTag('a')->attributes(
                                                    [
                                                        'class' => $classes_service . ' btn-link white-text  btn-xm padding-0 z-depth-3 pointer p-l-2 p-r-2',
                                                        'data-service-id' => "$value->service_id",
                                                        'data-token' => csrf_token(),
                                                        'data-confirmed' => $value->confirmed,
                                                        'data-num-week' => $numWeek,
                                                        'data-year' => $year,
                                                        'type' => "button",
                                                        'wire:click' => $wireclick
                                                    ])
                                                    ->addChild(html()->span()->text(Funcs::carbonFormat($value->service_date, 'h')))


                                            )

                                            ,

                                            Div::create()->class('valign-wrapper center-align padding-0')->addChildren(
                                                [
                                                    Element::withTag('a')->attributes(
                                                        [
                                                            'data-service-id' => $value->service_id,
                                                            'wire:click' => "populateModal($value->service_id)",
                                                            '@click'=>"open = !open",
                                                            'class' => 'btn-link-underline link-modal-residential modal-on-livewire m-l-5 pointer'
                                                        ]
                                                    )->text(Funcs::nameShort($value->cust_name, ' ', 2))
                                                    ,
                                                    Element::withTag('span')->class('badge')->addChildren(
                                                        [
                                                            Element::withTag('span')->class('material-symbols-outlined')->text('mark_unread_chat_alt'),
                                                            $spanRentalHouse

                                                        ]
                                                    )
                                                ]
                                            )
                                        ]
                                    )
                                );
                            }
                            //3º foreach
                        }

                    }
                    switch ($arrayCount) {
                        case 1:
                            $trs_temp .= Element::withTag('tr')->class('yellow-row')->addChild(Element::withTag('td')->text('&nbsp;'));
                            break;
                        case 0:
                            $trs_temp .= Element::withTag('tr')->class('yellow-row')->addChild(Element::withTag('td')->text('&nbsp;'));
                            $trs_temp .= Element::withTag('tr')->class('yellow-row')->addChild(Element::withTag('td')->text('&nbsp;'));
                            break;


                    }
                }
                //2º foreach
            }
            //1º foreach
            $return.= Div::create()->class("col s12 m3")
                ->addChild(
                    Div::create()->class('card card-gradient-background z-depth-3 white-text')
                        ->addChild(
                            Div::create()->class('card-content card-content-min')
                                ->addChildren(
                                    [
                                        $cardTitleSpan,
                                        Element::withTag('p')->addChild(
                                            Element::withTag('table')->class('table-home green darken-3 centered')->addChild($trs_temp)
                                        )
                                    ]
                                )

                        )

                )->render();

        }
        //dd($return);
        return $return;
    }


}