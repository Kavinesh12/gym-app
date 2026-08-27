<?php

namespace App\Livewire\Diets;

use App\Models\DietPlan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Diet Plans')]
class Index extends Component
{
    public string $goal = '';

    public function render()
    {
        $dietPlans = DietPlan::query()
            ->when($this->goal, fn ($q) => $q->where('goal', $this->goal))
            ->orderBy('daily_calories')
            ->get();

        return view('livewire.diets.index', compact('dietPlans'));
    }
}
