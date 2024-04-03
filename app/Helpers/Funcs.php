<?php

namespace App\Helpers;

class Funcs
{
    public static function oddCheck($nun):bool
    {
        if ($nun % 2 > 0 ){
            return true;
        }else{
            return false;
        }

    }


}