<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\user>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'names' => $this->faker->name,
            'paternal' => $this->faker->lastName,
            'maternal' => $this->faker->lastName,
            'dni' => $this->faker->unique()->randomNumber(8),
            'phone_number' => $this->faker->phoneNumber,
            'gender' => $this->faker->randomElement(['M', 'F']),
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'available' => 1,
            'status' => 1,
            'role' => $this->faker->randomElement(['doctor', 'receptionist']),

        ];
    }
}
