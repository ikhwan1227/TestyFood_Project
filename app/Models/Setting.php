<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    // Helper function untuk mengambil value berdasarkan key
    public static function getValue($key, $default = null)
    {
        return self::where('key', $key)->value('value') ?? $default;
    }
}