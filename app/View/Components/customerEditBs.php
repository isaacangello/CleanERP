<?php

namespace App\View\Components;

use App\Livewire\Forms\CustomerForm;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class customerEditBs extends Component
{
    /**
     * Create a new component instance.
     */
    public CustomerForm $fcustomer;
    public ?string $formType;
    public function __construct()
    {
         $this->formType  = 'EDIT';
    }

    public function isCreate($formType): bool
    {
        return $formType === 'CREATE';
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.old.customer-edit-bs');
    }
}
