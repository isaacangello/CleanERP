<?php

use App\Livewire\ToastAlert;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ToastAlert::class)
        ->assertStatus(200);
});
