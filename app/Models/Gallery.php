<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'category'];

    /**
     * URL gambar yang benar untuk kedua sumber:
     * - Seeder: assets/article-1.webp   → asset('assets/article-1.webp')
     * - Upload: galleries/abc123.jpg    → asset('storage/galleries/abc123.jpg')
     */
    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('assets/placeholder.webp');
        }

        // Jika dari seeder → assets/...
        if (Str::startsWith($this->image, 'assets/')) {
            return asset($this->image);
        }

        // Jika dari upload → galleries/...
        return asset('storage/' . $this->image);
    }
}