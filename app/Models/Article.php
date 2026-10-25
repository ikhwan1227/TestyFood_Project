<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'thumbnail',
        'excerpt',
        'content',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Relasi: Artikel milik satu User (Penulis)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Artikel milik satu Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // ============================================
    // ACCESSOR — URL Thumbnail
    // ============================================
    /**
     * Mendapatkan URL thumbnail yang benar,
     * baik dari seeder (assets/) maupun upload (storage/).
     */
    public function getThumbnailUrlAttribute(): string
    {
        if (!$this->thumbnail) {
            return asset('assets/placeholder.webp'); // fallback
        }

        // Jika dari seeder → assets/article-1.webp
        if (Str::startsWith($this->thumbnail, 'assets/')) {
            return asset($this->thumbnail);
        }

        // Jika dari upload → articles/xxx.jpg (di storage/app/public)
        return asset('storage/' . $this->thumbnail);
    }

    // ============================================
    // ACCESSOR — Judul Plain Text
    // ============================================
    /**
     * Mendapatkan judul tanpa tag HTML (untuk alt, title tag, dll).
     */
    public function getPlainTitleAttribute(): string
    {
        return strip_tags($this->title);
    }

    /**
     * Mendapatkan excerpt tanpa tag HTML (untuk card).
     */
    public function getPlainExcerptAttribute(): string
    {
        return strip_tags($this->excerpt);
    }

}