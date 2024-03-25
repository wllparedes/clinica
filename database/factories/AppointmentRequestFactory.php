<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppointmentRequest>
 */
class AppointmentRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => 48,
            'motive' => $this->faker->text,
            'estimated_datetime' => $this->faker->dateTime,
            'is_urgent' => $this->faker->boolean,
            'comment' => $this->faker->text,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
