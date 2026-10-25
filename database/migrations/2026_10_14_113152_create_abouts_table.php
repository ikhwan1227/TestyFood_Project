<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            // Section 1: Tasty Food
            $table->string('title_1')->default('TASTY FOOD');
            $table->text('description_1a')->nullable();
            $table->text('description_1b')->nullable();
            $table->string('image_1a')->nullable();
            $table->string('image_1b')->nullable();
            // Section 2: Visi
            $table->string('title_2')->default('VISI');
            $table->text('description_2')->nullable();
            $table->string('image_2a')->nullable();
            $table->string('image_2b')->nullable();
            // Section 3: Misi
            $table->string('title_3')->default('MISI');
            $table->text('description_3')->nullable();
            $table->string('image_3')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};