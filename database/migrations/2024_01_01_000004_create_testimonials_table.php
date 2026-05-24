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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name_ar');
            $table->string('client_name_en');
            $table->string('company_ar')->nullable();
            $table->string('company_en')->nullable();
            $table->string('position_ar')->nullable();
            $table->string('position_en')->nullable();
            $table->text('review_ar');
            $table->text('review_en');
            $table->string('image')->nullable();
            $table->tinyInteger('rating')->default(5);
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
        Schema::dropIfExists('testimonials');
    }
};
