<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_1', 'description_1a', 'description_1b', 'image_1a', 'image_1b',
        'title_2', 'description_2', 'image_2a', 'image_2b',
        'title_3', 'description_3', 'image_3',
        'about_image_1a', 'about_image_1b', 'about_image_2a', 'about_image_2b', 'about_image_3',

        'card1_title', 'card1_desc', 
        'card2_title', 'card2_desc', 
        'card3_title', 'card3_desc', 
        'card4_title', 'card4_desc'
    ];

    // Helper: ambil record pertama atau buat baru
    public static function getInstance(): self
    {
        return self::firstOrCreate(['id' => 1]);
    }

    // Accessor URL untuk semua gambar
    public function getImageUrl(string $field): string
    {
        $image = $this->$field;
        if (!$image) {
            return asset('assets/placeholder.webp');
        }
        if (Str::startsWith($image, 'assets/')) {
            return asset($image);
        }
        return asset('storage/' . $image);
    }
}