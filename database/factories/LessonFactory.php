<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *k
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1,50),
            'title' => fake()->text(80),
            'body' => fake()->paragraph()
        ];
    }
}
