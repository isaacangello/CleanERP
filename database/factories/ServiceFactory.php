<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $frequencevals = array('WEK','BIW','THR','MON','ONE');
        $frekey = array_rand($frequencevals);
        $periods = array('FIRST','SECOND','THIRD');
        $periodskey = array_rand($periods);
        return [
            'customer_id' => fake()->numberBetween(1,10000),
            'employee1_id' => fake()->numberBetween(1,100),
            'employee2_id' => fake()->numberBetween(1,100),
            'service_date' => fake()->dateTimeBetween('-5 years','+2 years' ),
            'period' => $periods[$periodskey],
            'frequency' =>  $frequencevals[$frekey],
            'notes' => fake()->paragraph(),
            'instructions'=> fake()->paragraph(),
            'paid_out' => false,
            'fee' => false
        ];
    }
}
