<?php

namespace App\Livewire;

use App\Helpers\WeekNavigation;
use App\Http\Controllers\Populate;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SearchRepeat extends Component
{
    use WeekNavigation;
    use WithPagination;


    public $customers;
    public $id = 0;
    public $selectAll = false;
    public $selectedCustomer = 0;
    public $selectedCycles= [];
    public $cycles = [];

    public $result = [];
    public $filterType = "RESIDENTIAL";

    public function mount()
    {
        $this->initVars();

        if($this->filterType === "RESIDENTIAL")
        {
            $this->customers = Populate::customerFilter('RESIDENTIAL')->toArray();
            $this->cycles = DB::table('services_cycles')->paginate(10)->toArray();
            //dd($this->cycles);
        }
        if($this->filterType === "COMMERCIAL")
        {
            $this->customers = Populate::customerFilter( 'COMMERCIAL')->toArray();
            $this->cycles = DB::table('schedule_cycles')->paginate(10)->toArray();
        }


    }

    public function updatedSelectAll()
    {
        if($this->selectAll)
        {
            $this->selectedCycles = array_column($this->cycles['data'],'id');
        }else{
            $this->selectedCycles = [];
        }
    }

    public function searchedCycles()
    {
        if($this->filterType === "RESIDENTIAL")
        {
            $this->cycles = DB::table('services_cycles')->where('customer_id',$this->selectedCustomer)->paginate(10)->toArray();
            //dd($this->cycles);
        }
        if($this->filterType === "COMMERCIAL")
        {
            $this->cycles = DB::table('schedule_cycles')->where('customer_id',$this->selectedCustomer)->paginate(10)->toArray();
        }
    }
    public function deletedCycles()
    {
        $this->dispatch('toast-btn-alert', icon: 'warning', title: 'Não foi dessa vez!', text: 'ainda não implementado.');
        return;
        if($this->selectedCycles)
        {
            if($this->filterType === "RESIDENTIAL")
            {
                DB::table('services_cycles')->whereIn('id',$this->selectedCycles)->delete();
            }
            if($this->filterType === "COMMERCIAL")
            {
                DB::table('schedule_cycles')->whereIn('id',$this->selectedCycles)->delete();
            }
        }
    }
    public function render()
    {
        return view('livewire.search-repeat');
    }
}
