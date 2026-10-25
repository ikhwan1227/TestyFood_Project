<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('actor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('type');                 // article_created, category_updated, dll
            $table->string('title');                // "Artikel Baru Ditambahkan"
            $table->text('message')->nullable();    // Detail aktivitas
            $table->string('model_type')->nullable(); // App\Models\Article
            $table->unsignedBigInteger('model_id')->nullable();
            $table->string('url')->nullable();      // Link ke halaman terkait
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->index(['is_read', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};