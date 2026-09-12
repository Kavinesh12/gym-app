<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionFood extends Model
{
    use HasFactory;

    protected $table = 'nutrition_food';

    protected $fillable = [
        'name',
        'protein_grams',
        'carbs_grams',
        'fibre_grams',
        'calories',
    ];

    protected $casts = [
        'protein_grams' => 'float',
        'carbs_grams' => 'float',
        'fibre_grams' => 'float',
        'calories' => 'integer',
    ];
}