<?php

namespace App\Livewire;

use HighSolutions\LaravelSearchy\Facades\Searchy;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SearchCustomer extends Component
{
    public $search = '';
    #[Computed]
    public function data(){
        if($this->search){
         return Searchy::search('customers')->fields('name')->query($this->search)
             ->getQuery()->limit(10)->get()->toArray();
        }else{
            return [];
        }

    }
    public function render()
    {
        return view('livewire.search-customer');
    }
}
