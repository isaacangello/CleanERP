<?php

namespace App\Livewire\Commercial;

use AllowDynamicProperties;
use App\Helpers\WeekNavigation;
use App\Http\Controllers\Populate;
use App\Models\Schedule as Service;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;


class Schedule extends Component
{
    use WeekNavigation;
    use CommercialTrait;



    public  $showModal = false;
    public  $showCadModal = false;

    public $selectOptionsEmployees;
    public $selectOptionsCustomers;

    /**
     * modal vars
     * @var string
     */
    public $modalData = '';
    public $customer_id='',$denomination="",$employee1_id, $address='',$date='',$phone='',$info,$notes='',$instructions='',$service_date='',$service_time='',$checkin_datetime='',$checkout_datetime='';
    public $tempDate  = '';
    public $tempTime  = '';
    public string $tempControlInTime;

    public string $tempControlOutTime;

    #[Computed]
    public function dataCard(): string
    {
        $this->initVars();

        return empty($this->buildCard($this->from,$this->till,$this->numWeek,$this->year))?"<div style='width: 300px'><h5 class='font-15'>No schedule found.</h5> </div>":$this->buildCard($this->from,$this->till,$this->numWeek,$this->year);
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
