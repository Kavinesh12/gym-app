<?php

namespace App\Livewire\Diets;

use App\Models\DietPlan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Diet Plan Details')]
class Show extends Component
{
    public DietPlan $dietPlan;

    public function mount(DietPlan $dietPlan)
    {
        $this->dietPlan = $dietPlan;
    }

    public function render()
    {
        $meals = $this->dietPlan->meals()
            ->orderByRaw("FIELD(meal_type, 'breakfast', 'lunch', 'dinner', 'snack')")
            ->get();

        return view('livewire.diets.show', compact('meals'));
    }
}
