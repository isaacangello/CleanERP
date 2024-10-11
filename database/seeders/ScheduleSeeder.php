<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Schedule;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $daysOfThisWeek =  CarbonPeriod::between(now()->startOfWeek(), now()->endOfWeek());
            foreach ($daysOfThisWeek as $day){

            $customer = Customer::factory()->create(['type'=>'COMMERCIAL']);
            $employee = Employee::factory()->create(['type'=>'COMMERCIAL']);
            Schedule::factory()
                ->for($customer)
                ->for($employee)
                ->create([
                    'schedule_date' => $day->format('Y-m-d 08:00:00'),
                ]);
           $customer = Customer::factory()->create(['type'=>'COMMERCIAL']);
            Schedule::factory()
                ->for($customer)
                ->for($employee)
                ->create([
                    'schedule_date' => $day->format('Y-m-d 13:01:00'),
                ]);
           $customer = Customer::factory()->create(['type'=>'COMMERCIAL']);
            Schedule::factory()
                ->for($customer)
                ->for($employee)
                ->create([
                    'schedule_date' => $day->format('Y-m-d 18:01:00'),
                ]);
            }

    }
}
