<?php

use App\Livewire\Finance\Billings;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Billings::class)
        ->assertStatus(200);
});
