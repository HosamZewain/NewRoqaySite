<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Map of slot-key → uploaded image path. Used by the iRes product
            // page to fill the 11 screenshot frames; other products are free
            // to use it for any structured image set.
            $table->json('screenshots')->nullable()->after('og_image');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('screenshots');
        });
    }
};
