<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}