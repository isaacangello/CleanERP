<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DateFlatPickr extends Component
{
    /**
     * Create a new component instance.
     */
    public $defaultDate;
    public function __construct()
    {
        if(is_null($this->defaultDate)){
            $this->defaultDate = now()->format("Y-m-d");
        }

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.old.date-flat-pickr');
    }
}
