<?php

namespace App\Livewire;

use App\Livewire\Forms\ConfigForm;
use Livewire\Component;
use App\Models\Config;
use Illuminate\Support\Facades\Auth;

class ConfigEditor extends Component
{
    public $config;
    public ConfigForm $configFrom;
    public function mount()
    {
        $this->config = Config::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'nun_reg_pages' => 15,
                'theme' => 'light',
                'spots' => 11
            ]
        );
        //dd($this->config);
        $this->configFrom->set();

    }
    public function save()
    {
        $this->configFrom->save();
        $this->dispatch('toast-alert',icon: 'success', message: 'register has been updated successfully!');
    }


    public function render()
    {
        return view('livewire.config-editor')
            ->extends('layouts.app', ['header' => 'Configuration']);
    }
}