<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'image' => 'https://source.unsplash.com/random/600x600/?food,' . $this->faker->word,
            'category' => $this->faker->randomElement(['Makanan Utama', 'Salad', 'Dessert', 'Minuman']),
        ];
    }
}