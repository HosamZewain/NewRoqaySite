<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Visibility toggle for the per-product pricing section.
            $table->boolean('pricing_enabled')->default(false)->after('screenshots');

            // Section headers + currency + packages array stored as one JSON blob.
            // Shape:
            // {
            //   "title_ar": "...", "title_en": "...",
            //   "subtitle_ar": "...", "subtitle_en": "...",
            //   "currency_ar": "ر.س", "currency_en": "SAR",
            //   "footnote_ar": "...", "footnote_en": "...",
            //   "packages": [
            //     { name_ar, name_en, description_ar, description_en,
            //       yearly_price, quarterly_price,
            //       features_ar: [...], features_en: [...],
            //       is_featured, cta_text_ar, cta_text_en }
            //   ]
            // }
            $table->json('pricing')->nullable()->after('pricing_enabled');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['pricing_enabled', 'pricing']);
        });
    }
};
