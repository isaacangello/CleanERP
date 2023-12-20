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
            'email' => fake()->freeEmail(),
            'birth' => fake()->date,
            'address' => fake()->address(),
            'namerefone' => fake()->name,
            'namereftwo' => fake()->name,
            'phonerefone' => fake()->e164PhoneNumber(),
            'phonereftwo' => fake()->e164PhoneNumber(),
            'description' => fake()->sentence,
            'restriction' => fake()->sentence,
            'document' => fake()->randomNumber(),
            'type' => ((rand(1,1))%2)<0?'RESIDENCIAL':'COMERCIAL',
            'status' => 'ACTIVE',
            'shift' => fake()->text(10),
            'username' => $username,
            'password' => '$2y$10$D6RqabA3OSgM91rUvSiYSeVMf9k6IyrqkVBOGwGOjCIV5bW2UrRWO',
            'newuser' => true
        ];
    }
}
