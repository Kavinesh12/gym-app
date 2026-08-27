<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Dashboard')]
class FitnessStats extends Component
{
    public ?int $age = null;
    public ?string $gender = null;
    public ?float $heightCm = null;
    public ?float $weightKg = null;
    public ?string $goal = null;
    public ?string $activityLevel = null;

    public function mount()
    {
        $profile = Auth::user()->profile;
        if ($profile) {
            $this->age = $profile->age;
            $this->gender = $profile->gender;
            $this->heightCm = $profile->height_cm;
            $this->weightKg = $profile->weight_kg;
            $this->goal = $profile->goal;
            $this->activityLevel = $profile->activity_level;
        }
    }

    #[Computed]
    public function bmi(): ?float
    {
        if (! $this->heightCm || ! $this->weightKg || $this->heightCm <= 0) {
            return null;
        }
        $heightM = $this->heightCm / 100;
        return round($this->weightKg / ($heightM * $heightM), 1);
    }

    #[Computed]
    public function bmiCategory(): ?string
    {
        $bmi = $this->bmi;
        if ($bmi === null) {
            return null;
        }
        return match (true) {
            $bmi < 18.5 => 'Underweight',
            $bmi < 25 => 'Normal weight',
            $bmi < 30 => 'Overweight',
            default => 'Obese',
        };
    }

    #[Computed]
    public function bmr(): ?int
    {
        if (! $this->weightKg || ! $this->heightCm || ! $this->age || ! $this->gender) {
            return null;
        }
        $bmr = match ($this->gender) {
            'male' => 10 * $this->weightKg + 6.25 * $this->heightCm - 5 * $this->age + 5,
            'female' => 10 * $this->weightKg + 6.25 * $this->heightCm - 5 * $this->age - 161,
            default => 10 * $this->weightKg + 6.25 * $this->heightCm - 5 * $this->age - 78,
        };
        return (int) round($bmr);
    }

    #[Computed]
    public function tdee(): ?int
    {
        $bmr = $this->bmr;
        if (! $bmr) {
            return null;
        }
        $multiplier = match ($this->activityLevel) {
            'sedentary' => 1.2,
            'light' => 1.375,
            'moderate' => 1.55,
            'active' => 1.725,
            'very_active' => 1.9,
            default => 1.2,
        };
        return (int) round($bmr * $multiplier);
    }

    #[Computed]
    public function recommendedCalories(): ?int
    {
        $tdee = $this->tdee;
        if (! $tdee) {
            return null;
        }
        return match ($this->goal) {
            'bulking' => $tdee + 400,
            'cutting' => $tdee - 500,
            default => $tdee,
        };
    }

    public function save()
    {
        $data = $this->validate([
            'age' => 'nullable|integer|min:10|max:100',
            'gender' => 'nullable|in:male,female,other',
            'heightCm' => 'nullable|numeric|min:50|max:250',
            'weightKg' => 'nullable|numeric|min:20|max:300',
            'goal' => 'nullable|in:bulking,cutting,maintenance',
            'activityLevel' => 'nullable|in:sedentary,light,moderate,active,very_active',
        ]);

        Auth::user()->profile()->updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'age' => $data['age'] ?? null,
                'gender' => $data['gender'] ?? null,
                'height_cm' => $data['heightCm'] ?? null,
                'weight_kg' => $data['weightKg'] ?? null,
                'goal' => $data['goal'] ?? null,
                'activity_level' => $data['activityLevel'] ?? null,
            ]
        );

        session()->flash('fitness-status', 'Fitness stats saved!');
    }

    public function render()
    {
        return view('livewire.dashboard.fitness-stats');
    }
}
