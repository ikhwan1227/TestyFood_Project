<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    public function definition(): array
    {
        // Daftar gambar galeri lokal
        $images = [
            'assets/anh-nguyen-kcA-c3f_3FE-unsplash.webp',
            'assets/anna-pelzer-IGfIGP5ONV0-unsplash.webp',
            'assets/brooke-lark-1Rm9GLHV0UA-unsplash.webp',
            'assets/brooke-lark-nBtmglfY0HU-unsplash.webp',
            'assets/brooke-lark-oaz0raysASk-unsplash.webp',
            'assets/ella-olsson-mmnKI8kMxpc-unsplash.webp',
            'assets/monika-grabkowska-P1aohbiT-EY-unsplash.webp',
            'assets/jonathan-borba-Gkc_xM3VY34-unsplash.webp',
            'assets/mariana-medvedeva-iNwCO9ycBlc-unsplash.webp',
            'assets/sanket-shah-SVA7TyHxojY-unsplash.webp',
            'assets/sebastian-coman-photography-eBmyH7oO5wY-unsplash.webp',
            'assets/eiliv-aceron-ZuIDLSz3XLg-unsplash.webp',
        ];

        return [
            'title' => $this->faker->words(3, true),
            'image' => $this->faker->randomElement($images),
            'category' => $this->faker->randomElement(['Makanan Utama', 'Salad', 'Dessert', 'Minuman']),
        ];
    }
}