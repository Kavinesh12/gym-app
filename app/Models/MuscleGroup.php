<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable([
    'name',
    'slug',
    'description',
    'image',
])]
class MuscleGroup extends Model
{
    protected static function booted(): void
    {
        static::creating(function (MuscleGroup $muscleGroup) {
            if (empty($muscleGroup->slug)) {
                $muscleGroup->slug = Str::slug($muscleGroup->name);
            }
        });
    }

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class);
    }
}
