<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->firstName('female');
        $lastname= fake()->lastName;
        $username= strtolower($name.$lastname);
        return [
            'name' => "$name $lastname",
            'phone' => fake()->e164PhoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'birth' => fake()->date,
            'address' => fake()->address(),
            'name_ref_one' => fake()->name,
            'name_ref_two' => fake()->name,
            'phone_ref_one' => fake()->e164PhoneNumber(),
            'phone_ref_two' => fake()->e164PhoneNumber(),
            'description' => fake()->sentence,
            'restriction' => fake()->sentence,
            'document' => fake()->randomNumber(),
            'type' => ((rand(1,1))%2)<0?'RESIDENCIAL':'COMMERCIAL',
            'status' => 'ACTIVE',
            'shift' => fake()->text(10),
            'username' => $username,
            'password' => '$2y$10$D6RqabA3OSgM91rUvSiYSeVMf9k6IyrqkVBOGwGOjCIV5bW2UrRWO',
            'new_user' => true
        ];
    }
}
