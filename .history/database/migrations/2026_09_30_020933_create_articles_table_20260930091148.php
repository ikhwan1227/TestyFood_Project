<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel users (Admin/Penulis)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Relasi ke tabel categories
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail')->nullable(); // Path gambar
            $table->text('excerpt'); // Ringkasan untuk card berita
            $table->longText('content'); // Isi berita lengkap
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};