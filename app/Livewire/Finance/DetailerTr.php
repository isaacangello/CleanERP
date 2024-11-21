<?php

namespace App\Livewire\Finance;

use App\Livewire\RepeatTrait;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use stdClass;


class DetailerTr extends Component
{
    use RepeatTrait;
    public $data;
    public $key = null;
    #[Validate('numeric')]
    public  $plus = 0;
    #[Validate('numeric')]
    public  $minus = 0;
    public int $i;
    #[Validate('required')]
    public float $price;
    #[Validate('required')]
    public string $payment='';

    public $title ='';
    protected $listeners = [
        'detailer-refresh' => '$refresh'
    ];

    public function modalCall()
    {
        // TODO: Implement modalCall() method.
        $this->dispatch('open-modal', referenceId: $this->data->id);
    }

    #[NoReturn] public function changeValues(): void
    {
        $this->validate([
            'plus' => 'required|numeric',
           'minus' => 'required|numeric'
        ]);
        $CurrentService = Service::find($this->data->id);
        $CurrentService->plus =  (float)$this->plus;
        $CurrentService->minus =  (float)$this->minus;
        $CurrentService->save();
        $this->dispatch('detailer-refresh')->component('finance.detailer');
        $this->dispatch('toast-alert',icon:'success',message:"this fields has bean changed !!!") ;
    }
    #[Computed]
    public function computedService(): Collection|Service|array|null
    {
        //dd(Service::find($this->data->id));
        $result = $this->searchServiceCycleById($this->data->id);
        //var_dump($result);
        if($result){
            $dates = explode(',',$result->dates);
            $this->title = "dates: \n";
            foreach ($dates as $date){
                $this->title .= Carbon::create($date)->format('m/d/Y')."\n";
            }

        }else{
            $this->title = "No repeat found";
        }
        return Service::find($this->data->id);
    }
    #[Computed]
    public function computedPayments(): \Illuminate\Database\Eloquent\Collection
    {
        return Payment::all();
    }
    #[Computed]
    public function computedPrices()
    {
        $cust = new Customer();
        //dd($cust);
        return $cust->with('billings')->find($this->data->customer_id)->billings;
    }
    public function changePrice():void
    {
//        $this->validate([
//            'price' => 'required|numeric'
//        ]);
        $CurrentService = Service::find($this->data->id);
        $CurrentService->price =$this->price;
        $CurrentService->save();
        $this->dispatch('detailer-refresh');
        $this->dispatch('toast-alert',icon:'success',message:"this price has been changed!!!") ;

    }
    public function changePayment(): void
    {
        $CurrentService = Service::find($this->data->id);
        $CurrentService->payment = $this->payment;
        $CurrentService->save();
        $this->dispatch('detailer-refresh');
        $this->dispatch('toast-alert',icon:'success',message:"this payment method has been changed!!!") ;
    }
    #[Computed]
    public function paymentSelected(){
        $CurrentService = Service::find($this->data->id);
        $payment = Payment::where('id', $CurrentService->payment)->first();
        if($payment){
            return $payment;
        } else{
            return null;}

    }
    public function mount(){
        $this->plus = (float)$this->data->plus;
        $this->minus = (float)$this->data->minus;
//        $this->i = $this->key; // Assuming $key is a unique identifier for each row. You should replace it with your own unique identifier.
    }
    public function render()
    {
        return view('livewire.finance.detailer-tr');
    }
    public function confirmPaid($id,$boolValue): void
    {
        $result =    Service::find($id)->update([
            'paid_out'=> $boolValue
        ]);
        if($boolValue){
            $this->dispatch('toast-alert', icon:'success', message:'Service marked as paid!');
        }else{
            $this->dispatch('toast-alert', icon:'warning', message:'Service marked as not paid!');
        }
    }

}
