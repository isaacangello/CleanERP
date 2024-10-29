<?php

namespace App\Livewire\Forms;

use App\Helpers\Funcs;
use App\Livewire\RepeatTrait;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ServiceForm extends Form
{
    use RepeatTrait;
    public $who_saved;
    public $who_saved_id;
    #[Validate('required|numeric')]
    public $customer_id='';
    #[Validate('required|numeric')]
    public $employee1_id;
    #[Validate('nullable')]
    public $employee2_id;
    #[Validate('nullable')]
    public $frequency;

    public $period = '';
    public $repeat_frequency;
    public $repeat_months;

    #[Validate('nullable')]
    public $notes='';
    #[Validate('nullable')]
    public $instructions='';
    #[Validate('required')]
    public$service_date='';
    #[Validate('nullable', message: 'Please provide the Price')]
    public $frequency_payment;
    public function store():bool
    {
//        dd(
//            'teste'
//        );
        $this->validate();
//        $service_date = Funcs::dateTimeToDB($this->service_date,$this->service_time); //Carbon::create($this->service_date." ".$this->service_time)->format('Y-m-d H:i:s');
        if($this->employee2_id === "0"){$employee2_id = $this->employee1_id;}else{$employee2_id = $this->employee2_id;}
        $frequency_payment = explode(',',$this->frequency_payment);
        if($this->repeat_months == 0) {

            $return = Service::create([
                    'customer_id' => $this->customer_id,
                    'employee1_id' => $this->employee1_id,
                    'employee2_id' => $employee2_id,
                    'service_date' => $this->service_date,
                    'period' => $this->period,
                    'frequency' => $this->repeat_frequency,
                    'notes' => $this->notes,
                    'instructions' => $this->instructions,
                    'frequency_payment' => $frequency_payment[0] ?? null,
                    'price' => $frequency_payment[1] ?? 0,
                    'payment' => null,
                    'who_saved' => \Auth::user()->name,
                    'who_saved_id' => \Auth::id(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),

                ]
            );
            $this->reset();
            return "Service created successfully";
        }
        if ($this->repeat_months > 0) {
            $data = [
                'customer_id' => $this->customer_id,
                'employee1_id' => $this->employee1_id,
                'employee2_id' => $employee2_id,
                'service_date' => $this->service_date,
                'period' => $this->period,
                'frequency' => $this->repeat_frequency,
                'notes' => $this->notes,
                'instructions' => $this->instructions,
                'frequency_payment' => $frequency_payment[0] ?? null,
                'price' => $frequency_payment[1] ?? 0,
                'payment' => null,
                'who_saved' => \Auth::user()->name,
                'who_saved_id' => \Auth::id(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ];
            $return = $this->repeat($data, $this->repeat_frequency, $this->repeat_months);
            $ids = array();
            foreach ($return as $key => $data){
                $id = DB::table('services')->insertGetId($data);
                DB::table('customers_services')->insert( [
                    'customer_id' => $this->customer_id,
                    'service_id' => $id,
                    'date' =>  $this->service_date,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),

                ]);
                $ids[$key] = $id;
            }
            $this->reset();
            return 'Service repeat created successfully';

        }
        //dd($return);
        $this->reset();
        return true;
    }
}
