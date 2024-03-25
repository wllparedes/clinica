<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalRequest>
 */
class MedicalRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'appointment_id' => 19,
            'doctor_id' => 72,
            'date' => $this->faker->date,
            'time' => $this->faker->time,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),

        ];
    }
}
