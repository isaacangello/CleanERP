<?php

namespace App\View\Components\flowbite;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomerHtmlForm extends Component
{
    public ?string $formType = null;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if($this->formType === null ){
            $this->formType = "EDIT";
        }
        return view('components.flowbite.customer-html-form');
    }
}
