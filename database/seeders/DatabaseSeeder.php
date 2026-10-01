<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User (Admin)
        User::factory()->create([
            'name' => 'Admin Tasty Food',
            'email' => 'admin@tastyfood.com',
            'password' => bcrypt('password'), // Password: password
        ]);
        // Buat 3 user tambahan sebagai penulis
        User::factory(3)->create();

        // 2. Buat Kategori
        $categories = [
            'Makanan Khas Nusantara',
            'Resep Sehat',
            'Tips Dapur',
            'Review Restoran',
            'Dessert & Minuman'
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat),
            ]);
        }

        // 3. Buat Artikel (Berita)
        // Membuat 15 artikel dummy
        Article::factory(15)->create();

        // 4. Buat Galeri
        // Membuat 12 foto galeri dummy
        Gallery::factory(12)->create();

        // 5. Buat Testimoni
        // Membuat 5 testimoni dummy
        Testimonial::factory(5)->create();

        // 6. Buat Settings (Info Kontak & Website)
        $settings = [
            ['key' => 'site_name', 'value' => 'Tasty Food'],
            ['key' => 'contact_email', 'value' => 'tastyfood@gmail.com'],
            ['key' => 'contact_phone', 'value' => '+62 812 3456 7890'],
            ['key' => 'address', 'value' => 'Kota Bandung, Jawa Barat'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/tastyfood'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/tastyfood'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}