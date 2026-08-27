<?php

namespace App\Livewire\Trainer;

use App\Models\MuscleGroup;
use App\Models\User;
use App\Models\WorkoutLog;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Trainer Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $clients = User::where('role', 'registered')
            ->withCount('workoutLogs')
            ->latest()
            ->limit(20)
            ->get();

        $totalLogs = WorkoutLog::count();
        $activeClients = User::where('role', 'registered')
            ->has('workoutLogs')
            ->count();
        $muscleGroups = MuscleGroup::withCount('exercises')->get();

        return view('livewire.trainer.dashboard', compact(
            'clients',
            'totalLogs',
            'activeClients',
            'muscleGroups'
        ));
    }
}
