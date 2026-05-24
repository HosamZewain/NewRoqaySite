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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('slug_ar')->unique();
            $table->string('slug_en')->unique();
            $table->longText('content_ar');
            $table->longText('content_en');
            $table->string('featured_image')->nullable();
            $table->string('seo_title_ar')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->text('seo_description_ar')->nullable();
            $table->text('seo_description_en')->nullable();
            $table->string('seo_keywords_ar')->nullable();
            $table->string('seo_keywords_en')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
