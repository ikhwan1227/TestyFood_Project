<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'message' => $this->faker->paragraph(3),
            'rating' => $this->faker->numberBetween(3, 5),
            'photo' => 'https://i.pravatar.cc/150?u=' . $this->faker->unique()->numberBetween(1, 100),
            'is_active' => true,
        ];
    }
}