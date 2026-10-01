<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(6);

        // Daftar gambar lokal yang tersedia di public/assets/
        $thumbnails = [
            'assets/sanket-shah-SVA7TyHxojY-unsplash.webp',
            'assets/sebastian-coman-photography-eBmyH7oO5wY-unsplash.webp',
            'assets/jimmy-dean-Jvw3pxgeiZw-unsplash.webp',
            'assets/luisa-brimble-HvXEbkcXjSk-unsplash.webp',
            'assets/fathul-abrar-T-qI_MI2EMA-unsplash.webp',
            'assets/eiliv-aceron-ZuIDLSz3XLg-unsplash.webp',
        ];

        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 1000),
            // Menggunakan gambar lokal, bukan URL eksternal
            'thumbnail' => $this->faker->randomElement($thumbnails),
            'excerpt' => $this->faker->paragraph(2),
            'content' => $this->faker->paragraphs(5, true),
            'is_published' => true,
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}