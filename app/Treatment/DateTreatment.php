<?php

namespace App\Treatment;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DI\Definition\DecoratorDefinition;
use phpDocumentor\Reflection\PseudoTypes\NumericString;

class DateTreatment
{
   /**
     * A basic feature test example.
     */

    /*************************************JJLsystem************************************
     *  Essa funçao retorna o nome do mes
     */
    public function GetNameMonth($month)
    {
        $meses = array('01' => "Janeiro", '02' => "Fevereiro", '03' => "Março",
            '04' => "Abril", '05' => "Maio", '06' => "Junho",
            '07' => "Julho", '08' => "Agosto", '09' => "Setembro",
            '10' => "Outubro", '11' => "Novembro", '12' => "Dezembro"
        );

        if ($month >= 01 && $month <= 12) {
            return $meses[$month];
        } else {
            return "Mês deconhecido";
        }


        /*************************************JJLsystem************************************
         * Metodo da classe MakearrayDays
         * esse metodo retorna um array de datas de repetiçao em um periodo por uma quantidade de meses
         *
         * peiodos testados
         * Weekly = Wek or Biweekly = Biw or Threeweekly =  Thr or Monthly = Mon
         *
         */
    }

public function MakeArrayDays($firstdate = 0, $periodo = "WEK", $periodo_meses = 9)
    {
        /*********************************************************************************
         * verificando segundo parametro
         * Verificando frequencia de repeticoes
         */
        switch ($periodo) {
            case "WEK":
            case "WK":
                $periodo_nun = 7;
                break;
            case "BIW":
                $periodo_nun = 14;
                break;
            case "THR":
                $periodo_nun = 21;
                break;
            case "MON":
                $periodo_nun = 30;
                break;
            default:
                $periodo_nun = 7;
        }
        /*********************************************************************************
         *  verificando o primeiro parametro
         * checando primeira data caso nao exista a data atual e assumida
         */
        if ($firstdate == 0) {
            $loop_day = date('d');
            $loop_month = date('m');
            $loop_year = date('Y');
            $firstday = date('Y-m-d');
        } else {
            //var_dump($firstdate);echo"<br>";
            list($loop_month, $loop_day, $loop_year) = explode("/", $firstdate);
            $firstday = $firstdate;
        }
        /*********************************************************************************
         * inicializando variaveis e tratando parametro 3
         *
         */
        $i = 1;
        $j = 0;
        $k = 0;
        $count_mounth = $loop_month;
        $totaldays = $periodo_meses * 30;
        $daysofmonth = $this->GetNumberDays("$loop_month");
        $array_datas = array();
        $calendar = array("0" => $firstday);
        /*********************************************************************************
         * Montando array com calendario com o preiodo global
         */

        while ($i <= $totaldays) {
            if ($loop_day >= $daysofmonth) {
                $loop_day = 0;
                $count_mounth++;
                $daysofmonth = $this->GetNumberDays("$count_mounth");
            }
            $loop_day++;
            if ($count_mounth > 12) {
                $count_mounth = 1;
                $loop_year++;
            }
            $loop_day = str_pad("$loop_day", 2, '0', STR_PAD_LEFT);
            $count_mounth = str_pad("$count_mounth", 2, '0', STR_PAD_LEFT);
            $calendar[$i] = "$count_mounth/$loop_day/$loop_year";
            $i++;

        } // while calendar
        //var_dump($calendar); echo"<br><br><br>";
        /*********************************************************************************
         * montando retorna do metodo
         */

        $array_datas[0] = "$firstday";
        while ($j <= $totaldays) {
            $j = $j + $periodo_nun;
            $k++;
            if ($j < $totaldays) {
                $array_datas["$k"] = $calendar[$j];
                //var_dump($j);
                //echo"<br>";
            }
        }
        return $array_datas;
    }

        /*************************************SSJsystem************************************
     * funcao||metodo que retorna quanto dias um Mes tem
     * OBS essa funçao observa ano bisexto
     * recebe o numero do mes como parametro.
     */
    public function GetNumberDays($mes)
    {
        $number_days = array(
            1 => 31, '01' => 31, 2 => 28, '02' => 28, 3 => 31, '03' => 31, 4 => 30, '04' => 30,
            5 => 31, '5' => 31, 6 => 30, '06' => 30, 7 => 31, '07' => 31, 8 => 31, '08' => 31,
            9 => 30, '09' => 30, 10 => 31, '10' => 31, 11 => 30, '11' => 30, 12 => 31, '12' => 31
        );

        if (((date('Y') % 4) == 0 and (date('Y') % 100) != 0) or (date('Y') % 400) == 0) {
            $number_days['02'] = 29;    // altera o numero de dias de fevereiro se o ano for bissexto
            //$number_days[2] = 29;
        }
        if ($mes > 12){
            return $number_days[12];
        }else{return $number_days[$mes];}

    } // MakeArrayDays
    public function GetMondaySartuday(string $day = null): array
    {
        if($day === null){
                $array_result['reference_day'] = date('Y-m-d', strtotime('today'));
                $array_result["monday"] = date('Y-m-d', strtotime('Monday this week'));
                $array_result["monday_tela"] = date('m/d/Y', strtotime('Monday this week'));
                $array_result["saturday"] = date('Y-m-d', strtotime('saturday this week'));
                $array_result["saturday_tela"] = date('m/d/Y', strtotime('saturday this week'));
                return $array_result;
        }
        $monday_found = false;
        $saturday_found = false;
        $cr=0;$cl=0;$array_result['reference_day'] = $day;
        while($monday_found == false){
            $day_right = getdate(strtotime($day)+(86400*$cr));
            if($day_right['weekday'] == "Monday"){
                $array_result["monday"] = $day_right['year'].'-'.$day_right['mon']."-".$day_right['mday'];
                $array_result["monday_tela"] = $day_right['mon'].'/'.$day_right['mday']."/".$day_right['year'];
                $monday_found = true;
            }
                $cr--;
        }
        while($saturday_found == false){
            $day_left = getdate(strtotime($day)+86400*$cl);
            if($day_left['weekday'] == "Saturday"){
                $array_result["saturday"] = $day_left['year'].'-'.$day_left['mon']."-".$day_left['mday'];
                $array_result["saturday_tela"] = $day_left['mon'].'/'.$day_left['mday']."/".$day_left['year'];
                $saturday_found = true;
            }
            $cl++;
        }

        return $array_result;
    }
    public function getWeek($day):array{
        /**
         * Monday (Segunda-feira) ...
         * Tuesday (Terça-feira) ...
         * Wednesday (Quarta-feira) ...
         * Thursday (Quinta-feira) ...
         * Friday (Sexta-feira) ...
         * Saturday (Sábado) ...
         * Sunday (Domingo) ...
         */

        return $this->getWeekByDay($day);
    }

    /**
     * @param $numberWeek
     * @param $year
     * @return array|string[]
     */
    public function getWeekByNumberWeek(int $numberWeek, string $year = "current"):array{
        if(is_nan($numberWeek)){
            return ['error' => "numberWeek var is not a number"];
        }
        //dd($year);
        if ($year === "current"){
            $year = now()->format('Y');
        }

//        $numberWeek= 52;
//        $year = "2023";

        $immutableInstance = Carbon::create($year,1,4);
        $instance = $immutableInstance;
        $convertedWeek = "converted Week>".$immutableInstance->isoWeek((int)$numberWeek);
        $weeWithNumber = $convertedWeek;

        $startWeek = $immutableInstance->startOfWeek()->format('Y-m-d H:i:s');
        $endWeek = $immutableInstance->endOfWeek()->format('Y-m-d H:i:s');

        $weekArr= $this->getWeek($startWeek) ;
        //dd($weekArr);

//        dd($immutableInstance->format('Y-m-d H:i:s'),
//            "numberWeek>".$numberWeek,
//            $convertedWeek,
//            $weeWithNumber,
//            $startWeek,
//            $endWeek,
//            $immutableInstance->weeksInYear,
//            $weekArr
//        );

        return $weekArr;
    }

    /**
     * @param string $day_string
     * @return array
     */
    public function getWeekByDay(string $day_string): array
    {
        $weekArr = [];$carbonInstance = Carbon::create($day_string);$carbonInstance1 = Carbon::create($day_string);
        $daysOfThisWeek =  CarbonPeriod::between($carbonInstance->startOfWeek(Carbon::MONDAY), $carbonInstance1->endOfWeek(Carbon::SUNDAY));
        foreach ($daysOfThisWeek as $day){$weekArr[$day->format('l')] = $day->format('Y-m-d H:i:s');}
        return $weekArr;
    }

    public function numberWeekByDay(string $date): int
    {
        return Carbon::create($date)->weekOfYear();
    }
    public function referenceYear($date)
    {
        return Carbon::create($date)->endOfWeek()->year;
    }
}