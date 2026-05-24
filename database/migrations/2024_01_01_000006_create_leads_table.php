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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('business_type')->nullable();
            $table->string('interested_product')->nullable();
            $table->text('message')->nullable();
            $table->string('source')->default('contact_form');
            $table->enum('status', ['new', 'contacted', 'qualified', 'closed', 'rejected'])->default('new');
            $table->text('admin_notes')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('email');
            $table->index('source');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
