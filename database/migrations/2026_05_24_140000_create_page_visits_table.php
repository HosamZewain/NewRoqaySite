<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_visits', function (Blueprint $table) {
            $table->id();
            // Logical page identifier — stable across deploys.
            //  'home', 'products', 'product:ires-system', 'blog:my-post', 'about', 'contact', etc.
            $table->string('page_key');
            // Locale variant — same page can be visited in 'ar' or 'en'.
            $table->string('locale', 5);
            // Human-friendly label shown in the admin (product/post title or section name).
            $table->string('label');
            // Canonical URL captured at first visit; updated if it ever changes.
            $table->string('url');
            $table->unsignedBigInteger('visit_count')->default(0);
            $table->timestamp('last_visited_at')->nullable();
            $table->timestamps();

            $table->unique(['page_key', 'locale']);
            $table->index('visit_count');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_visits');
    }
};
