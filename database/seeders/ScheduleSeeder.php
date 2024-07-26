<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0;$i <=21;$i++){
            $customer = Customer::factory()->create(['type'=>'COMMERCIAL']);
            $employee = Employee::factory()->create();
            Schedule::factory()
                ->for($customer)
                ->for($employee)
                ->count(3)
                ->create();
        }
    }
}
