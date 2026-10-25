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
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 1000),
            // Menggunakan gambar lokal, bukan URL eksternal
            'thumbnail' => $this->faker->randomElement($thumbnails),
            'excerpt' => $this->faker->paragraph(5),
            'content' => $this->faker->paragraphs(5, true),
            'is_published' => true,
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}