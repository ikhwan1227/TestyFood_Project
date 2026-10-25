<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    public function definition(): array
    {
        // Daftar gambar galeri lokal
        $images = [
            'assets/article-1.webp',
            'assets/article-2.webp',
            'assets/article-3.webp',
            'assets/article-4.webp',
            'assets/article-5.webp',
            'assets/article-6.webp',
            'assets/article-7.webp',
            'assets/article-8.webp',
            'assets/article-9.webp',
            'assets/article-10.webp',
            'assets/article-11.webp',
            'assets/article-12.webp',
            'assets/article-13.webp',
            'assets/article-14.webp',
            'assets/article-15.webp',
            'assets/article-16.webp',
        ];

        return [
            'title' => $this->faker->words(3, true),
            'image' => $this->faker->randomElement($images),
            'category' => $this->faker->randomElement(['Makanan Utama', 'Salad', 'Dessert', 'Minuman']),
        ];
    }
}