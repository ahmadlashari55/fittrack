<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Paratha, Omelet, Channay
            $table->string('unit'); // e.g., 1 piece, 1 bowl, 100g
            $table->integer('calories');
            $table->decimal('protein_g', 5, 2)->default(0);
            $table->decimal('carbs_g', 5, 2)->default(0);
            $table->decimal('fats_g', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};