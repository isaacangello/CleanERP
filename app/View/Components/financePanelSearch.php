<?php

namespace App\View\Components;

use App\Helpers\Funcs;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class financePanelSearch extends Component
{
    /**
     * Create a new component instance.
     */
    public Collection $employees;
    public function __construct()
    {
        $this->employees = Funcs::getEmployees();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.finance-panel-search',
        [
            'employees' => $this->employees,
        ]

        );
    }
}
