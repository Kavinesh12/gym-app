<?php

namespace App\Livewire\Exercises;

use App\Models\Exercise;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Exercise Details')]
class Show extends Component
{
    public Exercise $exercise;

    public function mount(Exercise $exercise)
    {
        $this->exercise = $exercise->load('muscleGroup');
    }

    public function render()
    {
        return view('livewire.exercises.show');
    }
}
