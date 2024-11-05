<?php

namespace App\Livewire\Residential;

use App\Helpers\WeekNavigation;
use Livewire\Component;


class SearchRepeat extends Component
{
    use WeekNavigation;

    public $searchResults = "";
    public $tabService = true;
    public $tabRepeat = false;
    public $tabCustomer = false;
    public $tabEmployee = false;




    public function mount()
    {
        $this->initVars();
    }
    public function render()
    {
        return view('livewire.residential.search-repeat')
            ->extends('layouts.app');
    }
}
