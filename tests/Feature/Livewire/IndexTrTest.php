<?php

use App\Livewire\IndexTr;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(IndexTr::class)
        ->assertStatus(200);
});
