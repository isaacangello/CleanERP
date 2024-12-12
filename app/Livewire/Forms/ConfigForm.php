<?php

namespace App\Livewire\Forms;

use _PHPStan_c875e8309\React\Dns\Config\Config;
use App\Helpers\Funcs;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Config as ConfigModel;
class ConfigForm extends Form
{
    public $ConfigModel;
    public $nun_reg_pages ='15';
    public $theme = 'light';
    public $spots = '11';
    public function set():void{
        $this->ConfigModel = Funcs::getConfig();
        $this->nun_reg_pages = $this->ConfigModel->nun_reg_pages;
        $this->theme = $this->ConfigModel->theme;
        $this->spots = $this->ConfigModel->spots;

    }

    public function save()
    {
        $this->validate([
            'nun_reg_pages' => 'required|integer',
            'theme' => 'required|string',
            'spots' => 'required|integer',
        ]);
        $this->ConfigModel->nun_reg_pages = $this->nun_reg_pages;
        $this->ConfigModel->theme = $this->theme;
        $this->ConfigModel->spots = $this->spots;
        //dd($this->ConfigModel);
       $this->ConfigModel->save();

        return true;
    }

}
