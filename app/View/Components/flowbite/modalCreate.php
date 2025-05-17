<?php

namespace App\View\Components\flowbite;

use App\Http\Controllers\Populate;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modalCreate extends Component
{
    /**
     * Create a new component instance.
     */
    public $employees;
    public $customers;

    public function __construct(
    )
    {
        //
    }



    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.flowbite.modal-create',
        [
            'employees' => Populate::employeeFilter(),
            'customers' => Populate::customerFilter()
        ]
        );
    }
}
