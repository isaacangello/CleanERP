<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class IndexTr extends Component
{
    public $data;

    public $key = null;

    public function mount($data): void
    {
        $this->data = $data;
    }
    public function render()
    {
        return view('livewire.index-tr');
    }
}
