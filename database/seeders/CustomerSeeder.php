<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

public array $names = [
    'Ruy López',
    'Gioacchino Greco',
    'Philidor',
    'Louis de la Bourdonnais',
    'Howard Staunton',
    'Adolf Anderssen',
    'Paul Morphy',
    'Wilhelm Steinitz',
    'Emanuel Lasker',
    'José Raúl Capablanca',
    'Alexander Alekhine',
    'Max Euwe',
    'Alexander Alekhine',
    'Mikhail Botvinnik',
    'Vasily Smyslov',
    'Mikhail Botvinnik',
    'Mikhail Tal',
    'Mikhail Botvinnik',
    'Tigran Petrosian',
    'Boris Spassky',
    'Bobby Fischer',
    'Anatoly Karpov',
    ];

    public function run(): void
    {
            foreach ($this->names as $name) {
                Customer::factory()->create([
                    'name' => $name,
                ]);
            }
    }
}
