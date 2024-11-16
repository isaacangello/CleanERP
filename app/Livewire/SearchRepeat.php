<?php

namespace App\Livewire;

use App\Helpers\WeekNavigation;
use App\Http\Controllers\Populate;
use App\Models\ScheduleCycle;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ServiceCycle;
use function Laravel\Prompts\select;

class SearchRepeat extends Component
{
    use WeekNavigation;
    use WithPagination;


    public $customers;
    public $id = 0;
    public $selectAll = false;
    public $selectedCustomer = -1;
    public $selectedCycles= [];
    public $cycles = [];

    public $result = [];
    public $filterType = "RESIDENTIAL";
    public $searchFilterType;
    public function mount()
    {
        $this->initVars();

        $this->customers = Populate::customerFilter('RESIDENTIAL')->toArray();

    }

    public function updatedSelectAll()
    {
        if($this->selectAll)
        {
            //dd($this->cycles);
            $this->selectedCycles = array_column($this->cycles['data'],'id');
        }else{
            $this->selectedCycles = [];
        }
    }

    #[Computed]
    public function searchedCycles(): ?\Illuminate\Contracts\Pagination\LengthAwarePaginator
    {

        if($this->filterType === "RESIDENTIAL")
        {
            if($this->selectedCustomer == -1)
            {
                $this->cycles = ServiceCycle::paginate(10)->toArray();

                return ServiceCycle::paginate(10);

            }
            $this->cycles = ServiceCycle::where('customer_id',$this->selectedCustomer)->paginate(10)->toArray();
             return ServiceCycle::where('customer_id',$this->selectedCustomer)->paginate(10);
            //dd($this->cycles);
        }
        if($this->filterType === "COMMERCIAL")
        {
            if($this->selectedCustomer == -1)
            {
                $this->cycles = ScheduleCycle::paginate(10)->toArray();
                return ScheduleCycle::paginate(10);

            }
            $this->cycles = ScheduleCycle::where('customer_id',$this->selectedCustomer)->paginate(10)->toArray();
             return ScheduleCycle::where('customer_id',$this->selectedCustomer)->paginate(10);
        }
        return null;
    }
public function searchCycles()
{
  $this->searchedCycles();
}
    public function deletedCycles()
    {
        $this->dispatch('toast-btn-alert', icon: 'warning', title: 'Não foi dessa vez!', text: 'ainda não implementado.');
        return;
//        if($this->selectedCycles)
//        {
//            if($this->filterType === "RESIDENTIAL")
//            {
//                DB::table('services_cycles')->whereIn('id',$this->selectedCycles)->delete();
//            }
//            if($this->filterType === "COMMERCIAL")
//            {
//                DB::table('schedule_cycles')->whereIn('id',$this->selectedCycles)->delete();
//            }
//        }
    }
    public function render()
    {
        return view('livewire.search-repeat');
    }
}
