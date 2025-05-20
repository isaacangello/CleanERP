<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Service;
use Carbon\CarbonPeriod;
use Database\Factories\EmployeeFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customArrayId =  array(3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21);
        $daysOfThisWeek =  CarbonPeriod::between(now()->subWeeks(3)->startOfWeek(), now()->endOfWeek());
        for($i=0;$i < 10;$i++){
        $employee = Employee::factory()->create(
            ['type'=>'RESIDENTIAL']
        );
        foreach ($daysOfThisWeek as $day){
                $key = array_rand($customArrayId);
                Service::factory()
                    ->create([
                        'customer_id' => $customArrayId[$key],
                        'employee1_id' => $employee->id,
                        'employee2_id' => $employee->id,
                        'service_date' => $day->format('Y-m-d 08:00:00'),
                    ]);
                $key1 = array_rand($customArrayId);
                Service::factory()
                    ->create([
                        'customer_id' => $customArrayId[$key1],
                        'employee1_id' => $employee->id,
                        'employee2_id' => $employee->id,
                        'service_date' => $day->format('Y-m-d 13:01:00'),
                    ]);

            }
        }
    }
}
