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
        $arrCusType = array('COMMERCIAL','RESIDENTIAL','RENTALHOUSE');
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
            'others_emails'=> fake()->unique()->safeEmail().','.fake()->unique()->safeEmail().','.fake()->unique()->safeEmail(),
            'other_services' => fake()->text(30) ,
            'info' => fake()->paragraph ,
            'drive_licence' => array_rand(array(true,false)) ,
            'more_girl' => array_rand(array(true,false)),
            'key' => array_rand(array(true,false)) ,
            'gate_code' => array_rand(array(true,false)) ,
            'house_description' => fake()->paragraph(3) ,
        ];
    }
}
