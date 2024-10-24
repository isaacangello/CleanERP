<?php

namespace App\Helpers;

use App\Models\Config;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
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
                $trs_temp .= Element::withTag('tr')->class('yellow-row')->addChild(Element::withTag('td')
                    ->addChildren(
                        [
                            Div::create()->attributes([
                                'class' => 'hide',
                                'id' => 'scheduleId'
                            ]),

                            Element::withTag('a')->attributes([
                            'data-schedule-id' => $value->id,
                            'href' => '#scheduleModal',
                            'class'=> "btn-link-underline modal-trigger link-modal-commercial m-l-5 $denomination_class" ,
                            'title' => "$value->denomination - ".$schedule_date->format('h:i a'),
                            ])->text($schedule_date->format('h:i a')." - ".Funcs::nameShort($value->denomination,' ',1  ))
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
                                        Div::create()->class('header font-12 p-t-10 p-b-10')->addChild(Element::withTag('h5')->class('modal-title green-text text-darken-4 font-13 padding-0 margin-0')->text($cardTile))
                                    )
                                    ->addChild(Element::withTag('p')->addChild(Element::withTag('table')->class('table-commercial')->addchild($trs_temp))
                                    ->addChild(Div::create()->class('modal-footer footer-commercial-card p-t-10 p-b-10')->text('&nbsp;'))
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
                                } else {
                                    $confirmClass = $value->confirmed ? 'green darken-3' : 'red darken-3';
                                    $classes_service = " btn-confirm-form " . $confirmClass;
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

                                            //                                                        Element::withTag('input')->attributes(['type'=>"hidden",'name'=>"_token" , 'value' => csrf_token() ]),
                                            //                                                        Element::withTag('input')->attributes(['type'=>"hidden",'name'=>"confirmed" , 'value' => $value->confirmed ]),
                                            //                                                        Element::withTag('input')->attributes(['type'=>"hidden",'name'=>"numWeek" , 'value' => $numweek ]),
                                            //                                                        Element::withTag('input')->attributes(['type'=>"hidden",'name'=>"id" , 'value' => $value->service_id ]),

                                                Element::withTag('a')->attributes(
                                                    [
                                                        'class' => $classes_service . ' btn-link white-text  btn-xm padding-0 z-depth-3 pointer p-l-2 p-r-2',
                                                        'data-service-id' => "$value->service_id",
                                                        'data-token' => csrf_token(),
                                                        'data-confirmed' => $value->confirmed,
                                                        'data-num-week' => $numWeek,
                                                        'data-year' => $year,
                                                        'type' => "button",
                                                    ])
                                                    ->addChild(html()->span()->text(Funcs::carbonFormat($value->service_date, 'h')))


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
    static function altClass($nun,array $classes): string
    {
        if ($nun % 2 > 0 ){
            return $classes[0];
        }else{
            return $classes[1];
        }
    }
    public static function getConfig(): config
    {
     return Config::firstOrCreate(
             ['user_id' => Auth::user()->id],
             ['nun_reg_pages'=> 15]
             );
    }

    public static function getEmployees ($type="RESIDENTIAL", $status="ACTIVE"): Collection
    {
        $model = new Employee();
        return  $model->select()->where('status' , '=', $status)
            ->where('type', '=', $type)->orderBy('name')->get();

    }



}