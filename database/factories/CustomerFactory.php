<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /**
         *  WEK =>Weekly
         *  BIW=>Biweekly
         *  THR=>Threeweekly
         *  MON=>Monthly
         *  ONE=>Eventual         *
         */
        $frequencevals = array('WEK','BIW','THR','MON','ONE');
        $frekey = array_rand($frequencevals);
        return [
            'name' => fake()->name(),
            'address' => fake()->address(),
            'complement' => fake()->text(20) ,
            'phone' => fake()->e164PhoneNumber() ,
            'email' => fake() ->companyEmail,
            'type' => ((rand(1,1))%2)<0?'RESIDENCIAL':'COMERCIAL',
            'status' => 'ACTIVE',
            'frequency' => $frequencevals[$frekey] ,
            'price_weekly' => fake()->randomFloat(2,80,300) ,
            'price_biweekly' => fake()->randomFloat(2,80,300)  ,
            'price_monthly' => fake()->randomFloat(2,80,300)  ,
            'other_services' => fake()->text(30) ,
            'regday' => null,
            'info' => fake()->paragraph ,
            'drivelicence' => false ,
            'key' => false ,
            'gate_code' => false ,
            'house_description' => fake()->paragraph(3) ,
        ];
    }
}
