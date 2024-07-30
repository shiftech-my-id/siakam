<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['male', 'female']);

        return [
            'nisn' => fake()->unique()->numberBetween(202401001, 202401100),
            'fullname' => fake()->firstName($gender) . ' ' . fake()->lastName($gender),
            'gender' => $gender,
            'grade_id' => null,
            'stage_id' => null,
            'active' => true,
        ];
    }
}
