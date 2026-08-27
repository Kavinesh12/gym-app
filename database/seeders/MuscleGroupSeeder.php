<?php

namespace Database\Seeders;

use App\Models\MuscleGroup;
use Illuminate\Database\Seeder;

class MuscleGroupSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            ['name' => 'Chest',     'description' => 'Pectoralis major and minor.'],
            ['name' => 'Back',      'description' => 'Lats, traps, rhomboids and spinal erectors.'],
            ['name' => 'Legs',      'description' => 'Quads, hamstrings, glutes and calves.'],
            ['name' => 'Shoulders', 'description' => 'Deltoids (front, side, rear) and traps.'],
            ['name' => 'Arms',      'description' => 'Biceps, triceps and forearms.'],
            ['name' => 'Abs',       'description' => 'Rectus abdominis, obliques and core.'],
        ];

        foreach ($groups as $group) {
            $group['slug'] = \Illuminate\Support\Str::slug($group['name']);
            MuscleGroup::updateOrCreate(['name' => $group['name']], $group);
        }
    }
}
