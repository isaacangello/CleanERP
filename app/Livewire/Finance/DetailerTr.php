<?php

namespace App\Livewire\Finance;

use App\Models\Service;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;


class DetailerTr extends Component
{
    public $data;
    public $key = null;
    #[Validate('numeric')]
    public  $plus = 0;
    #[Validate('numeric')]
    public  $minus = 0;
    public int $i;
    protected $listeners = [
        'detailer-refresh' => '$refresh'
    ];
    #[NoReturn] public function changeValues(): void
    {
        $this->validate();
        $CurrentService = Service::find($this->data->id);
        $CurrentService->plus =  (float)$this->plus;
        $CurrentService->minus =  (float)$this->minus;
        $CurrentService->save();
        $this->dispatch('detailer-refresh');
        $this->dispatch('toast-alert',icon:'success',message:"this fields has bean changed !!!") ;
    }
    #[Computed]
    public function computedService(): Collection|Service|array|null
    {
        //dd(Service::find($this->data->id));
        return Service::find($this->data->id);
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
}
