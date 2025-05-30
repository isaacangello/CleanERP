<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
class selectActors extends Component
{
   /**
     * Create a new component instance.
     */
    public function __construct(
//        public string  $elementName,
//        public string  $elementId,

        public Customer $customers,
        public Employee $employees
    ){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-actors');
    }
}
