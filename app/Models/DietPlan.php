<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable([
    'name',
    'slug',
    'goal',
    'description',
    'daily_calories',
    'protein_grams',
    'carbs_grams',
    'fats_grams',
])]
class DietPlan extends Model
{
    protected static function booted(): void
    {
        static::creating(function (DietPlan $plan) {
            if (empty($plan->slug)) {
                $plan->slug = Str::slug($plan->name);
            }
        });
    }

    public function meals(): HasMany
    {
        return $this->hasMany(DietMeal::class);
    }
}
