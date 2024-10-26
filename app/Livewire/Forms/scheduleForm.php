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

    public function submit(): bool
    {
        //dd($this->repeat_frequency);
        $this->validate();
        if(empty($this->team)){
            $this->team = "scale1";
        }
        if(empty($this->denomination)){
            $this->denomination = Customer::find($this->customer_id)->name;
        }

        $data_insert =  $this->repeat($this->all(),$this->repeat_frequency,$this->repeat_months);
        $ids = array();
        foreach ($data_insert as $key => $data){
         $ids[$key] = DB::table('schedules')->insertGetId($data);
        }
        dd( implode(", " , $ids ));
//        Schedule::create([
//            'customer_id' => $this->customer_id,
//            'employee_id' => $this->employee_id,
//            'denomination' => $this->denomination,
//            'schedule_date' => $this->schedule_date,
//            'notes' => $this->notes,
//            'instructions' => $this->instructions,
//            'team' => $this->team,
//            'team_id' => $this->team_id,
//            'who_saved' => auth()->user()->name,
//            'who_saved_id' => auth()->id(),
//        ]);
        // Execution doesn't reach here if validation fails.

        // Do something with the data
        return true;
    }
}
