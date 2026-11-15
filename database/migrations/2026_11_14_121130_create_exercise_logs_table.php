<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exercise_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('exercise_id')->constrained()->cascadeOnDelete();
            $table->integer('duration_minutes');
            $table->integer('calories_burned');
            $table->date('log_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercise_logs');
    }
};