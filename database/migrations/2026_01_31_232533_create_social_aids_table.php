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
        Schema::create('social_aids', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "BLT Dana Desa 2024"
            $table->decimal('amount', 15, 2)->default(0); // Nominal
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_aids');
    }
};