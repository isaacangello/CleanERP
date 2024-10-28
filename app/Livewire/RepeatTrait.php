<?php

namespace App\Livewire;

use Carbon\Carbon;

trait RepeatTrait
{
    public function repeat($data, $repeat_frequency, $repeat_months, $destination = 'residential'): array
    {
//        dd($data['schedule_date']);

        $numeric_index =0;
        $count_months=0;
        $week_step=0;
        $reference_date = Carbon::create($data['schedule_date']);
        $data_return =array();
            while ($count_months <= $repeat_months) {
            if($destination == 'residential'){
                $data_return[$numeric_index] = [
                    'customer_id' => $data['customer_id'],
                    'employee_id' => $data['employee_id'],
                    'service_date' => $reference_date->format('Y-m-d H:i:s'),
                    'notes' => $reference_date->format('l').' '.$repeat_frequency.$data['notes'],
                    'instructions' => $data['instructions'],
                    'who_saved' => auth()->user()->name,
                    'who_saved_id' => auth()->id(),
                ];

            }
            if($destination == 'commercial') {
                $data_return[$numeric_index] = [
                    'customer_id' => $data['customer_id'],
                    'employee_id' => $data['employee_id'],
                    'denomination' => $data['denomination'],
                    'schedule_date' => $reference_date->format('Y-m-d H:i:s'),
                    'notes' => $reference_date->format('l') . ' ' . $repeat_frequency . $data['notes'],
                    'instructions' => $data['instructions'],
                    'team' => $data['team'],
                    'team_id' => $data['team_id'],
                    'who_saved' => auth()->user()->name,
                    'who_saved_id' => auth()->id(),
                ];
            }

                $previos_month = $reference_date->month;
                switch ($repeat_frequency) {
                    case "Wek":
                    case "WK":
                        $reference_date->addWeek();
                        break;
                    case "Biw":
                        $reference_date->addWeeks(2);
                        break;
                    case "Thr":
                        $reference_date->addWeeks(3);
                        break;
                    case "Mon":
                        $reference_date->addMonth();
                        $count_months++;
                        break;
                    default:
                }
                if($previos_month != $reference_date->month){
                    $count_months++;
                }


                $numeric_index++;
            }

           return $data_return;
    }

}