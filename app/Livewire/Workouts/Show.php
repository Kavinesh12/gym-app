<?php

namespace App\Livewire\Workouts;

use App\Models\MuscleGroup;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Exercises')]
class Show extends Component
{
    use WithPagination;

    public MuscleGroup $muscleGroup;
    public string $search = '';
    public string $difficulty = '';

    public function mount(MuscleGroup $muscleGroup)
    {
        $this->muscleGroup = $muscleGroup;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDifficulty()
    {
        $this->resetPage();
    }

    public function render()
    {
        $exercises = $this->muscleGroup->exercises()
            ->when($this->search, fn ($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->difficulty, fn ($q) => $q->where('difficulty', $this->difficulty))
            ->orderBy('name')
            ->paginate(9);

        return view('livewire.workouts.show', [
            'exercises' => $exercises,
        ]);
    }
}
