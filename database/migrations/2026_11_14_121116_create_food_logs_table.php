<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('food_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
           $table->foreignId('food_id')->constrained('foods')->cascadeOnDelete();
            $table->decimal('quantity', 5, 2); // e.g., 2 (parathay)
            $table->enum('meal_type', ['breakfast', 'lunch', 'dinner', 'snack']);
            $table->date('log_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('food_logs');
    }
};