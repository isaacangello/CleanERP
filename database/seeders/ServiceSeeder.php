<?php

namespace Database\Seeders;

use App\Models\Customer;
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
        $daysOfThisWeek =  CarbonPeriod::between(now()->subWeeks(3)->startOfWeek(), now()->addWeeks(8)->endOfWeek());
        for($i=0;$i < 10;$i++){
        $employee = Employee::factory()->create(
            ['type'=>'RESIDENTIAL']
        );
            $arrCusType = array('RESIDENTIAL','RENTALHOUSE');
            $custType = array_rand($arrCusType);
            $Customer1 = Customer::factory()->create(['type'=>$arrCusType[$custType]]);
            $Customer2 = Customer::factory()->create(['type'=>$arrCusType[$custType]]);
        foreach ($daysOfThisWeek as $day){
                $custType = array_rand($arrCusType);
                $Customer1 = Customer::factory()->create(['type'=>$arrCusType[$custType]]);
                $Customer2 = Customer::factory()->create(['type'=>$arrCusType[$custType]]);

                Service::factory()
                    ->create([
                        'customer_id' => $Customer1->id,
                        'employee1_id' => $employee->id,
                        'employee2_id' => $employee->id,
                        'service_date' => $day->format('Y-m-d 08:00:00'),
                    ]);

                Service::factory()
                    ->create([
                        'customer_id' => $Customer2->id,
                        'employee1_id' => $employee->id,
                        'employee2_id' => $employee->id,
                        'service_date' => $day->format('Y-m-d 13:01:00'),
                    ]);

            }
        }
    }
}
