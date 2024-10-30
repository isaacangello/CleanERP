<?php

namespace App\Livewire\Forms;

use App\Livewire\RepeatTrait;
use App\Models\Customer;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Form;

class scheduleForm extends Form
{
    use RepeatTrait;
    #[Validate('required', message: 'Please select the Customer')]
    public  $customer_id='';
    #[Validate('required', message: 'Please select the Employee')]
    public  $employee_id;
    #[Validate('nullable')]
    public  $denomination="";
    #[Validate('required', message: 'Please select the Date')]
    public  $schedule_date='';
    #[Validate('nullable')]
    public   $notes='';
    #[Validate('nullable')]
    public   $instructions='';
    #[Validate('nullable')]
    public    $team='';
    #[Validate('nullable')]
    public   $team_id;


    public $repeat_frequency;
    public $repeat_months;



    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function submit(): string
    {
        //dd($this->repeat_frequency);
        $this->validate();
        if(empty($this->team)){
            $this->team = "scale1";
        }
        if(empty($this->denomination)){
            $this->denomination = Customer::find($this->customer_id)->name;
        }
        if($this->repeat_months == 0){
            Schedule::create([
                'customer_id' => $this->customer_id,
                'employee_id' => $this->employee_id,
                'denomination' => $this->denomination,
                'schedule_date' => $this->schedule_date,
                'notes' => $this->notes,
                'instructions' => $this->instructions,
                'team' => $this->team,
                'team_id' => $this->team_id,
                'who_saved' => auth()->user()->name,
                'who_saved_id' => auth()->id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return "Schedule created successfully";
        }
        if($this->repeat_months > 0){
            $data_insert =  $this->repeat($this->all(),$this->repeat_frequency,$this->repeat_months,'commercial');
            $ids = array();
            foreach ($data_insert as $key => $data){
                $id = DB::table('schedules')->insertGetId($data);
                DB::table('customers_schedules')->insert( [
                    'customer_id' => $this->customer_id,
                    'schedule_id' => $id,
                    'date' => $data['schedule_date'],
                    'created_at' => now(),
                    'updated_at' => now(),

                ]);
                $ids[$key] = $id;
                $dates[$key] = $data['schedule_date'];
            }
            $data = [
                'customer_id' => $this->customer_id,
                'customer_name' => $this->denomination,
                'ids' => implode(',',$ids),
                'dates' => implode(',',$dates),
                'frequency' => $this->repeat_frequency,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DB::table('schedule_cycles')->insert($data);
        }
        $this->reset();
        return 'Schedule repeat created successfully';
    }
}
