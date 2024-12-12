<?php

namespace App\Livewire;

use App\Helpers\Funcs;
use App\Helpers\WeekNavigation;
use App\Http\Controllers\Populate;
use App\Models\Customer;
use App\Models\ScheduleCycle;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ServiceCycle;
use function Laravel\Prompts\select;
use function PHPUnit\Framework\isFalse;

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
    public $filterType = "ALL";
    public $searchFilterType= "ALL";
    public function mount()
    {
        $this->initVars();

        $this->customers = Populate::customerFilter('RESIDENTIAL')->toArray();

    }

    #[Computed]
    public function filteredCustomers()
    {
        if($this->searchFilterType === "ALL")
        {
            return Customer::query()->orderBy('name')->get()->toArray();
        }
        if($this->searchFilterType === "RESIDENTIAL")
        {
            return Populate::customerFilter('RESIDENTIAL')->toArray();
        }
        if($this->searchFilterType === "COMMERCIAL")
        {
            return Populate::customerFilter('COMMERCIAL')->toArray();
        }
        //return $this->customers;
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
        if($this->searchFilterType){
            $this->filterType = $this->searchFilterType;
        }
        $config = Funcs::getConfig();
        if($this->filterType === "RESIDENTIAL")
        {

            if($this->selectedCustomer <= 0)
            {
                $this->cycles = ServiceCycle::paginate($config->nun_reg_pages)->toArray();

                return ServiceCycle::paginate($config->nun_reg_pages);

            }
            $this->cycles = ServiceCycle::where('customer_id',$this->selectedCustomer)->paginate($config->nun_reg_pages)->toArray();
             return ServiceCycle::where('customer_id',$this->selectedCustomer)->paginate($config->nun_reg_pages);
            //dd($this->cycles);
        }
        if($this->filterType === "COMMERCIAL")
        {
            if($this->selectedCustomer <=0)
            {
                $this->cycles = ScheduleCycle::paginate(10)->toArray();
                return ScheduleCycle::paginate($config->nun_reg_pages);

            }
            $this->cycles = ScheduleCycle::where('customer_id',$this->selectedCustomer)->paginate($config->nun_reg_pages)->toArray();
             return ScheduleCycle::where('customer_id',$this->selectedCustomer)->paginate($config->nun_reg_pages);
        }
    if($this->filterType === "ALL")
    {
        $serviceCycles = ServiceCycle::paginate($config->nun_reg_pages);
        $scheduleCycles = ScheduleCycle::paginate($config->nun_reg_pages);

        $serviceCycles->getCollection()->transform(function ($item) {
            $item->origin = 'serviceCycle';
            return $item;
        });

        $scheduleCycles->getCollection()->transform(function ($item) {
            $item->origin = 'scheduleCycle';
            return $item;
        });

        $mergedCycles = $serviceCycles->getCollection()->merge($scheduleCycles->getCollection());

        $paginatedCycles = new \Illuminate\Pagination\LengthAwarePaginator(
            $mergedCycles,
            $serviceCycles->total() + $scheduleCycles->total(),
            $config->nun_reg_pages,
            $serviceCycles->currentPage(),
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        $this->cycles = $paginatedCycles->toArray();
        return $paginatedCycles;
    }
return null;
    }
public function searchCycles()
{
  $this->searchedCycles();
}
#[On('confirmed-del-cycles')]
   public function deleteCycles($id, $origin = false)
{
    $this->dispatch('toast-alert', icon:'info', message: " id=> $id ...filtertype =$this->filterType, origin => $origin");

    try {
        if ($this->filterType === "RESIDENTIAL" or $this->filterType === "RENTALHOUSE") {
            $cycle = \App\Models\ServiceCycle::find($id);
            if ($cycle) {
                $ids = explode(',', $cycle->ids);
                \App\Models\Service::whereIn('id', $ids)->forceDelete();
                $cycle->forceDelete();
            }
        } elseif ($this->filterType === "COMMERCIAL") {
            $cycle = \App\Models\ScheduleCycle::find($id);
            if ($cycle) {
                $ids = explode(',', $cycle->ids);
                \App\Models\Schedule::whereIn('id', $ids)->forceDelete();
                $cycle->forceDelete();
            }
        }elseif($this->filterType === "ALL")
        {
            if(is_null($origin))
            {
                $this->dispatch('toast-alert', icon: 'error', message: 'Error deleting cycles: origin not found');
                return;
            }
            if($origin === 'serviceCycle')
            {
                $cycle = \App\Models\ServiceCycle::find($id);
                if ($cycle) {
                    $ids = explode(',', $cycle->ids);
                    \App\Models\Service::whereIn('id', $ids)->forceDelete();
                    $cycle->forceDelete();
                }
            }elseif($origin === 'scheduleCycle')
            {
                $cycle = \App\Models\ScheduleCycle::find($id);
                if ($cycle) {
                    $ids = explode(',', $cycle->ids);
                    \App\Models\Schedule::whereIn('id', $ids)->forceDelete();
                    $cycle->forceDelete();
                }
            }
        }
        $this->dispatch('toast-alert',icon: 'success', message: 'Cycles has been deleted successfully!');
    } catch (\Exception $e) {
        $this->dispatch('toast-alert', icon: 'error', message: 'Error deleting cycles: ' . $e->getMessage());
    }
}
    public function render()
    {
        return view('livewire.search-repeat');
    }
}
