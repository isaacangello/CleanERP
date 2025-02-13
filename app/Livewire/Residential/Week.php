<?php

namespace App\Livewire\Residential;

use AllowDynamicProperties;
use App\Helpers\Residential\ResidentialTrait;
use App\Http\Controllers\Populate;
use App\Livewire\Forms\ServiceForm;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Service;
use App\Treatment\DateTreatment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Http\Controllers\PopulateController;

#[AllowDynamicProperties]

class Week extends Component
{
    use ResidentialTrait;
    public ServiceForm $form;
    #[Url]
    public $id;
    public $from;
    public $till;
    public $numWeek = null;
    public $year = null;
    public $customer_id='',$employee1_id, $address='',$date='',$phone='',$info,$notes='',$instructions='',$service_date='',$service_time='',$checkin_datetime='',$checkout_datetime='',$customer_type='';
    public $populateBillings = null;

    public $selectOptionsEmployees='';
    public $selectOptionsCustomers='';
    #[Validate('required')]
    public $selectedEmployee = null;
    public $currentEmployee = null;
    public $selectedWeek = null;
    public $selectedYear = null;
    public $route = 'week';
    public $populate;
    public $employeesIds = [];
    public $empFromOpen = 0;
    public $dateTrait;
    public $fieldTitles =[
        'employee1_id' => 'employee identification',
        'employee2_id' => 'second employee identification',
        'customer_id' => "Customer identification",
        'info' => 'Customer adtional information',
        'phone' => 'Customer phone',
        'notes' => 'Notes',
        'instructions' => 'instructions for employees',
        'service_date' => "date of service",
        'service_time' => "time of service",
        'checkin_datetime' => 'date and time employee checkin',
        'checkout_datetime' =>  'date and time employee checkout',
        'address' =>  'address of service.',
    ];
    /**
     * @var string modal vars
     */

    public $modalData = '';
    public $tempDate  = '';
    public $tempTime  = '';
    public $tempControlInTime  = '';
    public $tempControlOutTime  = '';
    public  $showModal = false;
    public  $showCadModal = false;
     public $cardsHtml ='';
     public array $week = [];

    protected $listeners = [
        'refresh-week' => '$refresh'
    ];

    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @return void
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function __constructor(): void
    {
        $this->populate = new PopulateController();
        $this->dateTrait = new DateTreatment();
    }

    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @return void
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function thisWeek(): void
    {
        $dateTrait =new DateTreatment();
        $this->numWeek =  $dateTrait->numberWeekByDay(now()->format('Y-m-d'));
        $this->year = $dateTrait->referenceYear(now()->format('Y-m-d'));
        $this->traitNullVars();
    }
    public function exportPdf(){
        return redirect()->route('week.pdf.export', [ 'from' => Carbon::create($this->from)->format("Y-m-d"), 'till' => Carbon::create($this->till)->format("Y-m-d")]);
    }
    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @return void
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function backWeek(): void
    {
        $date = new DateTreatment();
        if(($this->numWeek -1) <= 0 ){
            $this->numWeek = 52;
            $this->year--;

        }else{
            $this->numWeek--;
        }
        $this->traitNullVars();

    }

    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @return void
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function forwardWeek(): void
    {
        if(($this->numWeek +1) > 52 ){
            $this->numWeek = 1;
            $this->year++;
        }else{
            $this->numWeek++;
        }
        $this->traitNullVars();
    }

    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @return void
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function selectWeek(): void
    {
        if(is_null($this->numWeek) || is_null($this->year)  ){
            $this->dispatch('toast-alert',icon:'error', message:"you need select number week and Year") ;
        }
        $this->numWeek = $this->selectedWeek;
        $this->year  = $this->selectedYear;
        $dateTrait = new DateTreatment();
        $week = $dateTrait->getWeekByNumberWeek($this->selectedWeek,$this->selectedYear);
        $this->from = Carbon::create($week['Monday'])->format('m/d/Y');
        $this->till = Carbon::create($week['Sunday'])->format('m/d/Y');
    }

    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @return array
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    #[Computed]
    public function dataCard(): array
    {

        $this->traitNullVars();
        $employees =  Populate::employeeFilter();
        $filteredWeekGroup = [];
        $employeesClass = new Employee();
        $dateTrait = new DateTreatment();
        $this->week = $dateTrait->getWeekByNumberWeek($this->numWeek,$this->year);
        foreach ($employees as $row){
            $filteredWeekGroup[$row->name] = $employeesClass->servicesFromWeekNumber($row->id,$this->numWeek,$this->year);;
            $this->employeesIds[$row->name] = $row->id;
        }
        /** Rendering HTML elements in server side SSR */
//        dd($filteredWeekGroup);

        return $filteredWeekGroup;
//        return $this->createResidentialCard($filteredWeekGroup,$this->numWeek,$this->year);
    }

    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @return void
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function price_inject(): void
    {
//        dd($this->form->customer_id);
        $temp_customer = Customer::with('billings')->find($this->form->customer_id);
        $this->populateBillings = $temp_customer->billings;
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
        $serviceModel =  Service::with('control')->find($this->modalData->id);
        $customerModel =  Customer::find($serviceModel->customer_id);
        if($field === 'employee1_id'){
        $employeeModel =  Employee::find($serviceModel->employee1_id);
        }
        if($field === 'employee2_id'){
            $employeeModel =  Employee::find($serviceModel->employee2_id);
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
            case'employee1_id': $value = $this->employee1_id; $model = $serviceModel;   break;
            case'employee2_id': $value = $this->employee2_id; $model = $serviceModel;   break;
            case'info': $value = $this->info; $model = $customerModel;                  break;
            case'phone': $value = $this->phone; $model = $customerModel;                break;
            case'notes': $value = $this->notes; $model = $serviceModel;                 break;
            case'instructions': $value = $this->instructions; $model = $serviceModel;   break;
            case'service_date': $value = $this->service_date; $model = $serviceModel;   break;
            case'service_time': $value = $this->service_time; $model = $serviceModel;   break;
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

//        $this->dispatch('refresh-week');
        $this->dispatch('toast-alert',icon:"success",message:"The ".$this->fieldTitles[$field]." field  has been Updated !!!");

    }

    /**=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     * @return void
     *=====================++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    public function store(){
        $return = $this->form->store();
        if($return){
            $this->showCadModal = false;
            $this->dispatch('toast-alert',icon:"success",message:'New service has been created !!!');
        }
    }

    /***================================================================================================================
     * @param $id
     * @return void
     *================================================================================================================*/
    public function confirmService($id): void
    {
        //TODO: implementar logica para confirmar serviço
//        sleep(3);
        $curentService = Service::find($id);
        $confirm = !$curentService->confirmed;

        $curentService->confirmed = !$curentService->confirmed;
//        dd($curentService);
        $curentService->save();


        if($confirm){
            $this->dispatch('toast-alert',icon:'success',message:"Service has been confirmed!!!") ;
        }else{
            $this->dispatch('toast-alert',icon:'warning', message:"Service has been decommitted!!!") ;
        }
    }

    /***================================================================================================================
     * @return void
     *================================================================================================================*/
    #[On('toggle-fee')]
    public function toggleFee(){
        //TODO: logica de cancelamento de serviço
        $currentService = Service::find($this->modalData->id);
//        dd($currentService);
        if ($currentService->fee === 1) {
            $currentService->fee = 0;
        } else {
            $currentService->fee = 1;
        }
        $currentService->save();
        $this->showModal = false;
        $this->dispatch('toast-alert',icon:'warning', message:"Service has been Canceled!!!") ;
    }

    /***============================================== cancelFee =======================================================
     * @param $id
     * @return void
     *================================================================================================================*/
    #[On('cancel-fee')]
    public function cancelFee($id){
        //TODO: logica de cancelamento de serviço
        $currentService = Service::find($id);
//        dd($currentService);
        if ($currentService->fee === 1) {
            $currentService->fee = 0;
        } else {
            $currentService->fee = 1;
        }
        $currentService->save();
        $this->showModal = false;
        $this->dispatch('toast-alert',icon:'success', message:"Service has been Canceled!!!") ;
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
        $this->dispatch('populate-date-time', idElement:"#serviceDate",dateTime:$currentService->service_date);
        if($currentService->control){
            $this->tempControlInTime = Carbon::create($currentService->control->checkin_datetime)->format('Y-m-d H:i:s');
            $this->tempControlOutTime = Carbon::create($currentService->control->checkout_datetime)->format('Y-m-d H:i:s');
        }else{
            $this->tempControlInTime = ' ';
            $this->tempControlOutTime= ' ';
        }
        $this->dispatch('populate-date-time', idElement:"#serviceInTime",dateTime:$this->tempControlInTime);
        $this->dispatch('populate-date-time', idElement:"#serviceOutTime",dateTime:$this->tempControlOutTime);

        $this->customer_id= $currentService->customer->id; $this->employee1_id=$currentService->employee->id;
        $this->phone=$currentService->customer->phone;
        $this->address=$currentService->customer->address; $this->info=$currentService->customer->info;
        $this->notes=$currentService->notes;$this->instructions=$currentService->instructions;
        //dd($this->tempDate);
        if ($currentService->customer->type === "RENTALHOUSE"){
            $this->customer_type = "<span class='material-symbols-outlined '>brightness_7</span>";
        }else{
            $this->customer_type = "<span class='material-symbols-outlined '>person</span>";
        }
        $this->modalData = $currentService;
//        dd($this->modalData);
    }

    #[On('populate-on-open')]
    public function populateOnOpen($empId,$date): void
    {
        //dd($this->form);
        $this->form->fill([
            'employee1_id'=> $empId,
            'service_date' => $date,
            'customer_id' => 712,
        ]);

    }

    /***================================================================================================================
     * @return void
     *================================================================================================================*/
    public function toggleCadModal():void
    {
        $this->showCadModal =!$this->showCadModal;
    }

    /***================================================================================================================
     * @return void
     *================================================================================================================*/
    public function toggleModal():void
    {
        $this->showModal =!$this->showModal;
    }

    /***================================================================================================================
     * @return void
     *================================================================================================================*/
    public function toggleEmpForm():void
    {
        $this->empFormOpen =!$this->empFormOpen;
    }

    /***================================================================================================================
     * @return void
     *================================================================================================================*/
    public function toggleEmpFormConfirm():void
    {
        $this->empFormConfirm =!$this->empFormConfirm;
    }

    /***================================================================================================================
     * @return void
     *================================================================================================================*/
    public function mount(){

        $dateTrait = new DateTreatment();
        $this->traitNullVars();
        if($this->from and ($this->numWeek === null)){
            $this->numWeek = $dateTrait->numberWeekByDay(Carbon::create($this->from)->nextWeekday()->format('Y-m-d'));
        }
        if (empty($this->selectedWeek) ){$this->selectedWeek = $dateTrait->numberWeekByDay(now()->format('Y-m-d'));}
        if($this->selectedYear === null){$this->selectedYear = $this->year;}


        $this->week = $dateTrait->getWeekByNumberWeek($this->numWeek,$this->year);
        $this->selectOptionsEmployees = Populate::employeeFilter();
        $this->selectOptionsCustomers = Populate::customerFilter();



    }

    /***================================================================================================================
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     *================================================================================================================*/
    public function render()
    {

        return view('livewire.residential.week')
            ->section('title', 'Residential Week Schedule')
            ->extends('layouts.app');

    }
    public function closeModal():void
    {
        $this->showModal = false;
    }
    public function createService($date,$emp_id):void
    {
        $this->empFormOpen = $emp_id;
        $this->dispatch('populate-date-time', idElement:"#input-cad-service-date",dateTime:$date);
        //dd($date,$emp_id);
        $this->showCadModal = true;
    }
}
