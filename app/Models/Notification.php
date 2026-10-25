<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'actor_id',
        'type',
        'title',
        'message',
        'model_type',
        'model_id',
        'url',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    // Relasi: siapa yang melakukan aksi
    public function actor()
    {
        return $this->belongsTo(User::class, 'actor_id');
    }

    // Scope: hanya yang belum dibaca
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
}