<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => fake()->numberBetween(1,21),
            'employee_id'=> fake()->numberBetween(1,10000),
            'schedule_date'=> fake()->dateTimeInInterval(now()->format('Y-m-d H:i:s'), '+ 5 days'),
            'notes'=>fake()->paragraph,
            'instructions'=>fake()->paragraph,
            'team'=> 'scale1',
            'who_saved'=>'isaac',
            'who_saved_id' => 1,
            'denomination'=> fake()->company,
        ];
    }
}
