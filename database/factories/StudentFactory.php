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
        $gender = fake()->randomElement(['M', 'F']);
        $level = fake()->randomElement(0, 1, 2, 3);
        $class = fake()->randomElement(['1 A', 'A', 'B', '2']);

        return [
            'nisn' => fake()->unique()->numberBetween(202401001, 202401100),
            'fullname' => fake()->firstName($gender == 'M' ? 'male' : 'female') . ' ' . fake()->lastName($gender),
            'gender' => $gender,
            'grade' => null,
            'level' => $level,
            'active' => true,
        ];
    }
}
