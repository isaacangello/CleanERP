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
            'customer_id' => fake()->numberBetween(1,10000),
            'employee_id'=> fake()->numberBetween(1,10000),
            'schedule_date'=> fake()->dateTimeInInterval('2024-07-22 08:00:49', '+ 5 days'),
            'notes'=>fake()->paragraph,
            'instructions'=>fake()->paragraph,
            'loop' => '["Monday","Tuesday","Wednesday","Thursday","Friday"]',
            'who_saved'=>'isaac:10',
            'denomination'=> fake()->company,
        ];
    }
}
