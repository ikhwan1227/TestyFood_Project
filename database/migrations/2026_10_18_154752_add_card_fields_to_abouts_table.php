<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->string('card1_title')->nullable();
            $table->text('card1_desc')->nullable();
            $table->string('card2_title')->nullable();
            $table->text('card2_desc')->nullable();
            $table->string('card3_title')->nullable();
            $table->text('card3_desc')->nullable();
            $table->string('card4_title')->nullable();
            $table->text('card4_desc')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn([
                'card1_title', 'card1_desc', 
                'card2_title', 'card2_desc', 
                'card3_title', 'card3_desc', 
                'card4_title', 'card4_desc'
            ]);
        });
    }
};