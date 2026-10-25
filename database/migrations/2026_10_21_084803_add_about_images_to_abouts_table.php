<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            // Gambar khusus untuk halaman Tentang Kami
            $table->string('about_image_1a')->nullable();
            $table->string('about_image_1b')->nullable();
            $table->string('about_image_2a')->nullable();
            $table->string('about_image_2b')->nullable();
            $table->string('about_image_3')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn([
                'about_image_1a', 'about_image_1b',
                'about_image_2a', 'about_image_2b', 'about_image_3'
            ]);
        });
    }
};