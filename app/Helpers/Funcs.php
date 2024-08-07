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
                for ($i=0;$i<=$index;$i++){
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
                $trs_temp .= Element::withTag('tr')->class('orange-row')->addChild(Element::withTag('td')->text($value->denomination));
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
    public function createResidentialCard():bool{
        return true;
    }
    public function createCustomerList():bool{
        return true;
    }
    public function createEmployeeList():bool{
        return true;
    }


}