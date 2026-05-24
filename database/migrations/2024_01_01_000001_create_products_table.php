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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('slug_ar')->unique();
            $table->string('slug_en')->unique();
            $table->text('short_description_ar');
            $table->text('short_description_en');
            $table->longText('description_ar');
            $table->longText('description_en');
            $table->json('features_ar')->nullable();
            $table->json('features_en')->nullable();
            $table->json('benefits_ar')->nullable();
            $table->json('benefits_en')->nullable();
            $table->json('modules_ar')->nullable();
            $table->json('modules_en')->nullable();
            $table->string('icon')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('og_image')->nullable();
            $table->string('seo_title_ar')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->text('seo_description_ar')->nullable();
            $table->text('seo_description_en')->nullable();
            $table->string('seo_keywords_ar')->nullable();
            $table->string('seo_keywords_en')->nullable();
            $table->string('hero_headline_ar')->nullable();
            $table->string('hero_headline_en')->nullable();
            $table->text('hero_subheadline_ar')->nullable();
            $table->text('hero_subheadline_en')->nullable();
            $table->text('target_audience_ar')->nullable();
            $table->text('target_audience_en')->nullable();
            $table->json('implementation_steps_ar')->nullable();
            $table->json('implementation_steps_en')->nullable();
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
        Schema::dropIfExists('products');
    }
};
