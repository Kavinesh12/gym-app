<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable([
    'muscle_group_id',
    'name',
    'slug',
    'description',
    'difficulty',
    'equipment',
    'instructions',
    'image',
])]
class Exercise extends Model
{
    protected static function booted(): void
    {
        static::creating(function (Exercise $exercise) {
            if (empty($exercise->slug)) {
                $exercise->slug = Str::slug($exercise->name);
            }
        });
    }

    public function muscleGroup(): BelongsTo
    {
        return $this->belongsTo(MuscleGroup::class);
    }

    public function workoutLogs(): HasMany
    {
        return $this->hasMany(WorkoutLog::class);
    }
}
