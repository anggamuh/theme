<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            // Background
            $table->string('bg_type');
            $table->string('bg_image')->nullable();
            $table->string('bg_main_color')->nullable();
            $table->string('bg_second_color')->nullable();
            // Header
            $table->string('head_type');
            // Gallery
            $table->string('gallery_type');
            // Description
            $table->string('desc_text_color');
            $table->string('desc_main_color');
            $table->string('desc_second_color');
            // Contact
            $table->string('contact_main_color');
            $table->string('contact_second_color');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
