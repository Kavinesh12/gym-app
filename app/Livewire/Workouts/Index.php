<?php

namespace App\Livewire\Workouts;

use App\Models\MuscleGroup;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Workouts by Muscle Group')]
class Index extends Component
{
    public function render()
    {
        $muscleGroups = MuscleGroup::withCount('exercises')
            ->orderBy('name')
            ->get();

        return view('livewire.workouts.index', compact('muscleGroups'));
    }
}
