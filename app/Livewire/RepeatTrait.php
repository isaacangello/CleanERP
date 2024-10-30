<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

trait RepeatTrait
{
    public function repeat($data, $repeat_frequency, $repeat_months, $destination = 'residential'): array
    {
//        dd($data['schedule_date']);

        $numeric_index =0;
        $count_months=0;
        $week_step=0;
        $reference_date = $destination === 'residential' ? Carbon::create($data['service_date']) : Carbon::create($data['schedule_date']);
        $data_return =array();
            while ($count_months <= $repeat_months) {

                if($destination == 'residential'){
                    if($reference_date->format('H')> 0 and $reference_date->format('H')< 12){$period = "Morning";}
                    if($reference_date->format('H')>= 12 and $reference_date->format('H')< 18){$period = "Afternoon";}
                    if($reference_date->format('H')>= 18){$period = "Evening";}
                    $frequency_payment = explode(',',$data['frequency_payment']);
                    $data_return[$numeric_index] = [
                        'customer_id' => $data['customer_id'],
                        'service_date' => $reference_date->format('Y-m-d H:i:s'),
                        'notes' => $data['notes'],
                        'instructions' => $data['instructions'],
                        'employee1_id' =>$data['employee1_id'],
                        'employee2_id'=>$data['employee2_id'],
                        'period'=>$period,
                        'frequency'=>$repeat_frequency,
                        'frequency_payment'=>$data['frequency_payment'],
                        'price'=>$data['price'],
                        'payment'=> null,
                        'who_saved'=>\Auth::user()->name,
                        'who_saved_id'=>\Auth::id(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];

                }
                if($destination == 'commercial') {
                    $data_return[$numeric_index] = [
                        'customer_id' => $data['customer_id'],
                        'employee_id' => $data['employee_id'],
                        'denomination' => $data['denomination'],
                        'schedule_date' => $reference_date->format('Y-m-d H:i:s'),
                        'notes' => $data['notes'],
                        'instructions' => $data['instructions'],
                        'team' => $data['team'],
                        'team_id' => $data['team_id'],
                        'who_saved' => auth()->user()->name,
                        'who_saved_id' => auth()->id(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
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
    public function searchCycleByDate($string){
//         $cycles = DB::table('schedule_cycles')
//            ->select('customer_id','ids','dates','frequency')
//            ->get();
//        $data = array();
//        foreach ($cycles as $cycle){
//            $ids = explode(',',$cycle->ids);
//            $dates = explode(',',$cycle->dates);
//            $key = array_search($this->id,$ids);
//            if($dates !== false){
//                $data = [
//                    'customer_id' => $cycle->customer_id,
//                    'schedule_date' => $dates[$key],
//                    'frequency' => $cycle->frequency,
//                ];
//            }
//        }
    }
    public function searchScheduleCycleByDate(){

         $cycles = DB::table('schedule_cycles')
            ->select('customer_id','ids','dates','frequency')
            ->get();
        $data = array();
        foreach ($cycles as $cycle){
            $ids = explode(',',$cycle->ids);
            $dates = explode(',',$cycle->dates);
            $key = array_search($this->id,$ids);
            if($key !== false){
                $data = [
                    'customer_id' => $cycle->customer_id,
                    'schedule_date' => $dates[$key],
                    'frequency' => $cycle->frequency,
                ];
            }
        }
    }

    /**
     * @param $schedule_id
     * @return \Illuminate\Support\Collection
     */
    public function searchScheduleCycleById($schedule_id): \Illuminate\Support\Collection|bool
    {

         $cycles = DB::table('schedule_cycles')
            ->select('customer_id','ids','dates','frequency')
            ->get();
        $data = array();
        foreach ($cycles as $cycle){
            $ids = explode(',',$cycle->ids);
            $key = array_search($schedule_id,$ids);
            if($key !== false){
                return DB::table('schedule_cycles')
                    ->where('id','=',$cycle->id)
                    ->select('id','customer_id','ids','dates','frequency')
                    ->get();

            }

        }
        return 0;
    }
    public function searchServiceCycleById($service_id)
    {

         $cycles = DB::table('services_cycles')
            ->select('id','customer_id','ids','dates','frequency')
            ->get();
        $data = array();
        foreach ($cycles as $cycle){
            $ids = explode(',',$cycle->ids);
            $key = in_array($service_id, $ids);
            if($key !== false){
                return DB::table('services_cycles')
                    ->where('id','=',$cycle->id)
                    ->select('id','customer_id','ids','dates','frequency')
                    ->first();

            }

        }
        return 0;
    }

}