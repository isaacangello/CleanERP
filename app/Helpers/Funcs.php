<?php

namespace App\Helpers;

use Carbon\Carbon;

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
        if(sizeof(explode($delimiter,$name)) > 1) {
            if ($index > 0) {
                $string = '';

                for ($i=0;$i<$index;$i++){
                    $string .= explode($delimiter,$name)[$i]." ";
                }
                return trim($string);
            }
        }
        return $name;
    }
    public static function dateTimeToDB($date,$time): string
    {
        return Carbon::create($date." ".$time)->format('Y-m-d H:i:s');
    }

}