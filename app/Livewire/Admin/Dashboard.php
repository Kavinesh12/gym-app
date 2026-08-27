<?php

namespace App\Livewire\Admin;

use App\Models\DietPlan;
use App\Models\Exercise;
use App\Models\MuscleGroup;
use App\Models\User;
use App\Models\WorkoutLog;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Admin Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'users' => User::count(),
            'admins' => User::where('role', 'admin')->count(),
            'trainers' => User::where('role', 'trainer')->count(),
            'registered' => User::where('role', 'registered')->count(),
            'muscle_groups' => MuscleGroup::count(),
            'exercises' => Exercise::count(),
            'diet_plans' => DietPlan::count(),
            'workout_logs' => WorkoutLog::count(),
        ];

        $recentUsers = User::latest()->limit(5)->get();

        return view('livewire.admin.dashboard', compact('stats', 'recentUsers'));
    }
}
