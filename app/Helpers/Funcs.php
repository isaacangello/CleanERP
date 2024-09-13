<?php

namespace App\Helpers;

use Carbon\Carbon;
use Spatie\Html\Html;
use Spatie\Html\Elements\Div;
use Spatie\Html\Elements\Element;

class Funcs
{
    /** check if number is odd
     * @param $nun
     * @return bool
     */
    public static function oddCheck($nun):bool
    {
        if ($nun % 2 > 0 ){
            return true;
        }else{
            return false;
        }

    }

    /**
     * @param $date
     * @param $out
     * @return string
     */
    public static function carbonFormat($date,string $out = "d"):string
    {
        switch ($out){
            case 'h':
                return Carbon::create($date)->format('h:i A')
                ;
            case'd':
            default:
                return Carbon::create($date)->format('m/d')
                ;

        }

    }

    /**
     * @param String $name
     * @param string $delimiter
     * @param int $index
     * @return string
     */
    public static function nameShort(String $name,string $delimiter = ' ',int $index = 0):string
    {
        if(sizeof(explode($delimiter,trim($name))) > 1) {
            $exploded = explode($delimiter,$name);
            if ($index > 0) {
                $string = '';
                for ($i=0;$i<$index;$i++){
                    $string .= $exploded[$i]." ";
                }
                return trim($string);
            }else{
                return trim($exploded[0]);
            }
        }
        return $name;
    }
    public static function dateTimeToDB($date,$time): string
    {
        return Carbon::create($date." ".$time)->format('Y-m-d H:i:s');
    }
    public static function replaceSpaces(string $string,string $replace_string = "_"): array|string
    {
        return str_replace(' ',$replace_string,trim($string));
    }

    public static function createCommercialCard(array $trTds,string $cardTile):string{
        //dd($trTds);
        $trs_temp = '';
        foreach ($trTds as $EmpNameKey => $arr){
            //dd($arr);
            $trs_temp .= Element::withTag('tr')->class('label-green-lighten-1')->addChild(Element::withTag('td')->class('align-center')->text($EmpNameKey));
            foreach ($arr as $value){
                $trs_temp .= Element::withTag('tr')->class('orange-row')->addChild(Element::withTag('td')
                    ->addChildren(
                        [
                            Div::create()->attributes([
                                'class' => 'hide',
                                'id' => 'scheduleId'
                            ]),

                            Element::withTag('a')->attributes([
                            'data-schedule-id' => $value->id,
                            'href' => '#scheduleModal',
                            'class'=> 'btn-link-underline modal-trigger link-modal-commercial m-l-5',
                            ])->text($value->denomination)
                        ]
                    )
                );
            }
        }

        return Div::create()->addChild(
                    Div::create()->class('card green darken-3 white-text')
                        ->addChild(
                                    Div::create()->class('card-content card-content-min')
                                    ->addChild(Element::withTag('span')->class('card-title font-12')->text($cardTile))
                                    ->addChild(Element::withTag('p')->addChild(Element::withTag('table')->class('table-home green darken-3')->addchild($trs_temp))
                                )
                        )
                )->render();

    }
    public static function createResidentialCard($data, $numWeek, $year = '2024'):string{
//        dd($data);
        $return = "";

        foreach ($data as $EmpName => $array) {
            $trs_temp = '';
            $cardTitleSpan = Element::withTag('span')->class('card-title')->text($EmpName);

            foreach ($array as $weekDayLabel => $arr) {
                //dd($arr);
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

                            $confirmation_service = $value->confirmed?'green darken-3':'red darken-3';
                            $spanRentalHouse = $value->cust_type === 'RENTALHOUSE'?Element::withTag('span')->class('material-symbols-outlined')->text('brightness_7'):'';
                            $trs_temp .= Element::withTag('tr')->class('yellow-row')->addChild(Element::withTag('td')->class('valign-wrapper')
                                ->addChildren(
                                        [
                                            Div::create()->class('hide')->attributes([
                                                'id' => 'serviceId',
                                                'class' => 'hide'
                                            ]),
                                            Div::create()->class('left valign-wrapper center-align padding-0')->addChild(

//                                                        Element::withTag('input')->attributes(['type'=>"hidden",'name'=>"_token" , 'value' => csrf_token() ]),
//                                                        Element::withTag('input')->attributes(['type'=>"hidden",'name'=>"confirmed" , 'value' => $value->confirmed ]),
//                                                        Element::withTag('input')->attributes(['type'=>"hidden",'name'=>"numWeek" , 'value' => $numweek ]),
//                                                        Element::withTag('input')->attributes(['type'=>"hidden",'name'=>"id" , 'value' => $value->service_id ]),

                                                        Element::withTag('a')->attributes(
                                                            [
                                                                'class'=> 'btn-confirm-form waves-effect waves-light btn-xm padding-0  z-depth-2 '.$confirmation_service,
                                                                'data-service-id' => "$value->service_id"  ,
                                                                'data-token' => csrf_token(),
                                                                'data-confirmed' => $value->confirmed ,
                                                                'data-num-week' => $numWeek,
                                                                'data-year' => $year,
                                                                'type'=>"button",
                                                            ])
                                                            ->addChild(html()->span()->class('white-text')->text(Funcs::carbonFormat($value->service_date,'h')))


                                            )

                                                ,

                                            Div::create()->class('valign-wrapper center-align padding-0')->addChildren(
                                                [
                                                    Element::withTag('a')->attributes(
                                                        [
                                                            'data-service-id' => $value->service_id,
                                                            'href' => '#largeModal',
                                                            'class' => 'btn-link-underline link-modal-residential modal-trigger m-l-5',
                                                        ]
                                                    )->text(Funcs::nameShort($value->cust_name,' ',2))
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
                switch($arrayCount) {
                    case 1:$trs_temp .= Element::withTag('tr')->class('yellow-row')->addChild(Element::withTag('td')->text('&nbsp;'));break;
                    case 0:
                        $trs_temp .= Element::withTag('tr')->class('yellow-row')->addChild(Element::withTag('td')->text('&nbsp;'));
                        $trs_temp .= Element::withTag('tr')->class('yellow-row')->addChild(Element::withTag('td')->text('&nbsp;'));
                        break;


                }

                //2º foreach
            }
            //1º foreach
            $return.= Div::create()->class("col s12 m3")
                ->addChild(
                            Div::create()->class('card green darken-3 white-text')
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
    public function createCustomerList():bool{
        return true;
    }
    public function createEmployeeList():bool{
        return true;
    }


}