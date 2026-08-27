<?php

use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\MuscleGroups as AdminMuscleGroups;
use App\Livewire\Admin\Exercises as AdminExercises;
use App\Livewire\Admin\DietPlans as AdminDietPlans;
use App\Livewire\Diets\Index as DietsIndex;
use App\Livewire\Diets\Show as DietsShow;
use App\Livewire\Exercises\Show as ExercisesShow;
use App\Livewire\Trainer\Dashboard as TrainerDashboard;
use App\Livewire\WorkoutLogger;
use App\Livewire\Workouts\Index as WorkoutsIndex;
use App\Livewire\Workouts\Show as WorkoutsShow;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'trainer') {
            return redirect()->route('trainer.dashboard');
        } else {
            return redirect()->route('workouts.index');
        }
    })->name('dashboard');

    Route::get('profile', function () {
        return view('profile');
    })->name('profile');
});

Route::middleware(['auth', 'role:registered,trainer,admin'])->group(function () {
    Route::get('log', WorkoutLogger::class)->name('workouts.log');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/', AdminDashboard::class)->name('dashboard');
    Route::get('/muscle-groups', AdminMuscleGroups::class)->name('muscle-groups');
    Route::get('/exercises', AdminExercises::class)->name('exercises');
    Route::get('/diet-plans', AdminDietPlans::class)->name('diet-plans');
});

Route::middleware(['auth', 'role:trainer,admin'])->prefix('trainer')->name('trainer.')->group(function () {
    Route::get('/', TrainerDashboard::class)->name('dashboard');
});

Route::get('workouts', WorkoutsIndex::class)->name('workouts.index');
Route::get('workouts/{muscleGroup}', WorkoutsShow::class)->name('workouts.show');
Route::get('exercises/{exercise}', ExercisesShow::class)->name('exercises.show');
Route::get('diets', DietsIndex::class)->name('diets.index');
Route::get('diets/{dietPlan}', DietsShow::class)->name('diets.show');

require __DIR__.'/auth.php';