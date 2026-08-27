<?php

namespace App\Livewire;

use App\Models\Exercise;
use App\Models\MuscleGroup;
use App\Models\WorkoutLog;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Log Workout')]
class WorkoutLogger extends Component
{
    #[Rule('required|exists:muscle_groups,id')]
    public int $muscleGroupId = 0;

    #[Rule('required|exists:exercises,id')]
    public int $exerciseId = 0;

    #[Rule('required|integer|min:1|max:50')]
    public int $sets = 3;

    #[Rule('required|integer|min:1|max:100')]
    public int $reps = 10;

    #[Rule('nullable|numeric|min:0|max:1000')]
    public ?float $weightKg = null;

    #[Rule('nullable|string|max:500')]
    public ?string $notes = null;

    #[Rule('required|date')]
    public string $performedAt = '';

    public function mount()
    {
        $this->performedAt = now()->toDateString();
    }

    #[Computed]
    public function muscleGroups()
    {
        return MuscleGroup::orderBy('name')->get();
    }

    #[Computed]
    public function exercises()
    {
        if (! $this->muscleGroupId) {
            return collect();
        }

        return Exercise::where('muscle_group_id', $this->muscleGroupId)
            ->orderBy('name')
            ->get();
    }

    public function updatedMuscleGroupId()
    {
        $this->exerciseId = 0;
    }

    public function save()
    {
        $this->validate();

        WorkoutLog::create([
            'user_id' => Auth::id(),
            'exercise_id' => $this->exerciseId,
            'sets' => $this->sets,
            'reps' => $this->reps,
            'weight_kg' => $this->weightKg,
            'notes' => $this->notes,
            'performed_at' => $this->performedAt,
        ]);

        session()->flash('status', 'Workout logged successfully!');

        $this->reset(['exerciseId', 'notes', 'weightKg']);
        $this->sets = 3;
        $this->reps = 10;
    }

    public function render()
    {
        $recentLogs = Auth::user()
            ->workoutLogs()
            ->with('exercise.muscleGroup')
            ->latest('performed_at')
            ->limit(10)
            ->get();

        return view('livewire.workout-logger', compact('recentLogs'));
    }
}
