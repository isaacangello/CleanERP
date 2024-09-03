<?php

use App\Livewire\Billings;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Billings::class)
        ->assertStatus(200);
});
