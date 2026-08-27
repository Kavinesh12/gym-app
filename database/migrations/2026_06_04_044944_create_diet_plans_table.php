<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diet_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('goal');
            $table->text('description')->nullable();
            $table->unsignedInteger('daily_calories');
            $table->unsignedInteger('protein_grams');
            $table->unsignedInteger('carbs_grams');
            $table->unsignedInteger('fats_grams');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diet_plans');
    }
};
