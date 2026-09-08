<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'protein_grams',
    'carbs_grams',
    'fibre_grams',
    'calories',
])]
class NutritionFood extends Model
{
}
