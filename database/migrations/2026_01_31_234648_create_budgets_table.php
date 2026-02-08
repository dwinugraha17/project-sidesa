<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['income', 'expense']); // Pendapatan / Belanja
            $table->string('category'); // e.g., Dana Desa, ADD, Bidang Pemerintahan
            $table->year('year');
            $table->decimal('amount', 15, 2); // Pagu Anggaran
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};