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
        $arrCusType = array('COMERCIAL','RESIDENCIAL','RENTALHOUSE');
        $custType = array_rand($arrCusType);
        return [
            'name' => fake()->name(),
            'address' => fake()->address(),
            'complement' => fake()->text(20) ,
            'phone' => fake()->e164PhoneNumber() ,
            'email' => fake()->unique()->safeEmail(),
            'type' => $custType,
            'status' => 'ACTIVE',
            'frequency' => $frequencevals[$frekey] ,
            'price_weekly' => fake()->randomFloat(2,80,300) ,
            'price_biweekly' => fake()->randomFloat(2,80,300)  ,
            'price_monthly' => fake()->randomFloat(2,80,300)  ,
            'other_services' => fake()->text(30) ,
            'regday' => null,
            'info' => fake()->paragraph ,
            'drivelicence' => array_rand(array(true,false)) ,
            'key' => array_rand(array(true,false)) ,
            'gate_code' => array_rand(array(true,false)) ,
            'house_description' => fake()->paragraph(3) ,
        ];
    }
}
