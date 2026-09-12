<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nutrition_food', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();

            $table->decimal('protein_grams', 6, 2)->default(0);
            $table->decimal('carbs_grams', 6, 2)->default(0);
            $table->decimal('fibre_grams', 6, 2)->default(0);

            $table->unsignedInteger('calories')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nutrition_food');
    }
};