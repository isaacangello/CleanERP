<?php

namespace App\Livewire\Commercial;

use AllowDynamicProperties;
use App\Helpers\WeekNavigation;
use App\Http\Controllers\Populate;
use App\Livewire\Forms\scheduleForm;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Schedule as Service;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;


class Schedule extends Component
{
    use WeekNavigation;
    use CommercialTrait;



    public  $showModal = false;
    public  $showCadModal = false;
    public $showTab1 = true;
    public $showTab2 = false;
    
    public $selectOptionsEmployees;
    public $selectOptionsCustomers;

    /**
     * modal vars
     * @var string
     */
    public $modalData = '';
    public $fieldTitles =[
        'employee1_id' => 'employee identification',
        'employee2_id' => 'second employee identification',
        'customer_id' => "Customer identification",
        'info' => 'Customer adtional information',
        'denomination' => 'denomination of customer',
        'phone' => 'Customer phone',
        'notes' => 'Notes',
        'instructions' => 'instructions for employees',
        'schedule_date' => "date of schedule",
        'checkin_datetime' => 'date and time employee checkin',
        'checkout_datetime' =>  'date and time employee checkout',
        'address' =>  'address of service.',
    ];
    public scheduleForm $form;
    public $customer_id='',$denomination="",$employee1_id, $address='',$date='',$phone='',$info,$notes='',$instructions='',$service_date='',$service_time='',$checkin_datetime='',$checkout_datetime='';
    public $tempDate  = '';
    public $tempTime  = '';
    public string $tempControlInTime;

    public string $tempControlOutTime;

    #[Computed]
    public function dataCard($team = 'scale1'): string
    {
        $this->initVars();

        return empty($this->buildCard($this->from,$this->till,$this->numWeek,$this->year,$team))?"<div style='width: 300px'><h5 class='font-15'>No schedule found.</h5> </div>":$this->buildCard($this->from,$this->till,$this->numWeek,$this->year,$team);
    }

    /***================================================================================================================
     * @return void
     *================================================================================================================*/
    #[On('delete-service')]

    public function delete(){
        //TODO: apagando serviço com soft delete
        $currentService = Service::find($this->modalData->id);
        $currentService->delete();
        $this->dispatch('toast-alert',icon:'success',message:"Service has been deleted!!!") ;

    }

    /***================================================================================================================
     * @method store
     * @return void
     *================================================================================================================*/
    public function store(){
        $return = $this->form->submit();
        if($return){
            $this->showCadModal = false;
            $this->dispatch('toast-alert',icon:"success",message:"$return !!!");
        }
    }


    /***================================================================================================================
     * @param $field
     * @return void|int
     *================================================================================================================*/
    public function field_change($field){
        if(empty($this->modalData->id)){
            $this->dispatch('toast-btn-alert', icon:'error', title:"Error", text:"Service not found  it should be trying changing field value!!");;
            return 0;
        }
        $serviceModel =  \App\Models\Schedule::with('control')->find($this->modalData->id);
        $customerModel =  Customer::find($serviceModel->customer_id);
        if($field === 'employee_id'){
            $employeeModel =  Employee::find($serviceModel->employee_id);
        }
        $model ="";
        $value = '';
        $dynamic_rules = array();
        $direction = 'services';

//        foreach ($serviceModel->rules() as $input => $rule ){
//            if(array_key_exists($input, $req->all())){
//                $dynamic_rules[$input] = $rule;
//            }
//        }
        //dd($this->modalData->id);
        $dynamic_rules[$field] = $serviceModel->rules()[$field];

        $this->validate($dynamic_rules);
        switch ($field){
            case'customer_id':
                $value = $this->customer_id; $model = $serviceModel;
                break;
            case'denomination': $value = empty($this->denomination)?"&nbsp;":$this->denomination; $model = $customerModel;  break;
            case'employee1_id': $value = $this->employee_id; $model = $serviceModel;    break;
            case'info': $value = $this->info; $model = $customerModel;                  break;
            case'phone': $value = $this->phone; $model = $customerModel;                break;
            case'notes': $value = $this->notes; $model = $serviceModel;                 break;
            case'instructions': $value = $this->instructions; $model = $serviceModel;   break;
            case'schedule_date': $value = $this->service_date; $model = $serviceModel;   break;
            case'checkin_datetime': $direction = 'checkIn'; $id =$this->modalData->id;  break;
            case'checkout_datetime': $direction = 'cheOut'; $id =$this->modalData->id;  break;
            case'address': $value = $this->address; $model = $customerModel;            break;
            default: $this->dispatch('toast-btn-alert', icon:'error', title:"Error", text:"An error occurred when changing field value!!");;
        }
        //dd($model);
        //dd($field .'=>'. $value);
        switch ($direction)
        {
            case'checkIn':
                DB::table('scheduling_control_residential')->updateOrInsert(
                    ['service_id' => $id],
                    [
                        'service_id' => $id,
                        'checkin_local' => "salvo no escritório",
                        'checkin_lat' => 0,
                        'checkin_long' => 0,
                        'checkin_datetime' => Carbon::create($this->checkin_datetime)->format('Y-m-d H:i:s'),
                    ]

                );break;
            case'cheOut':DB::table('scheduling_control_residential')->updateOrInsert(
                ['service_id' => $id],
                [
                    'service_id' => $id,
                    'checkin_local' => "salvo no escritório",
                    'checkin_lat' => 0,
                    'checkin_long' => 0,
                    'checkout_datetime' => Carbon::create($this->checkout_datetime)->format('Y-m-d H:i:s'),
                ]

            );break;
            default:
                //dd($model);
                $model->update(
                    [
                        $field => $value
                    ]
                );
                $model->save();

        }

        $this->dispatch('refresh-week');
        $this->dispatch('toast-alert',icon:"success",message:"The ".$this->fieldTitles[$field]." field  has been Updated !!!");

    }


    /***================================================================================================================
     * @param $id
     * @return void
     *================================================================================================================*/
    public function populateModal($id): void
    {
//        sleep(2);
        $currentService = Service::with('customer','employee','control')->find($id);
        $this->dispatch('populate-date-time', idElement:"#scheduleDate",dateTime:$currentService->schedule_date);
        if($currentService->control){
            $this->tempControlInTime = Carbon::create($currentService->control->checkin_datetime)->format('Y-m-d H:i:s');
            $this->tempControlOutTime = Carbon::create($currentService->control->checkout_datetime)->format('Y-m-d H:i:s');
        }else{
            $this->tempControlInTime = ' ';
            $this->tempControlOutTime= ' ';
        }
        $this->dispatch('populate-date-time', idElement:"#scheduleInTime",dateTime:$this->tempControlInTime);
        $this->dispatch('populate-date-time', idElement:"#scheduleOutTime",dateTime:$this->tempControlOutTime);

        $this->customer_id= $currentService->customer->id;
        $this->denomination=$currentService->denomination;
        $this->employee1_id=$currentService->employee->id;
        $this->phone=$currentService->customer->phone;
        $this->address=$currentService->customer->address; $this->info=$currentService->customer->info;
        $this->notes=$currentService->notes;$this->instructions=$currentService->instructions;
        //dd($this->tempDate);
        $this->modalData = $currentService;
//        dd($this->modalData);
    }

    public function mount():void{
        $this->initVars();
        $this->selectOptionsEmployees = Populate::employeeFilter('commercial');
        $this->selectOptionsCustomers = Populate::customerFilter('commercial');

    }
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {

        return view('livewire.commercial.schedule')
            ->extends('layouts.app');
    }
}
