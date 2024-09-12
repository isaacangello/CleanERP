<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PopulateController;


class Populate extends PopulateController
{

    public static function employeeFilter($type = 'residential',$orderBy = 'name',$nunOfPages = 0)
    {
        $class = new PopulateController();
        return $class->employee_filter($type,$orderBy,$nunOfPages);
    }
    public static function customerFilter($type = 'residential',$orderBy = 'name',$nunOfPages = 0)
    {
        $class = new PopulateController();
        return $class->filter_customer($type,$orderBy,$nunOfPages);
    }
}