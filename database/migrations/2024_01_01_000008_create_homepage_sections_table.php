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
        Schema::create('homepage_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_key')->unique();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->text('subtitle_ar')->nullable();
            $table->text('subtitle_en')->nullable();
            $table->longText('content_ar')->nullable();
            $table->longText('content_en')->nullable();
            $table->string('image')->nullable();
            $table->string('background_image')->nullable();
            $table->string('button_text_ar')->nullable();
            $table->string('button_text_en')->nullable();
            $table->string('button_url')->nullable();
            $table->json('extra_data')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_sections');
    }
};
