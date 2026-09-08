<?php

namespace App\Livewire\Diets;

use App\Models\DietPlan;
use App\Models\NutritionFood;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Diet Plan Details')]
class Show extends Component
{
    public DietPlan $dietPlan;

    public string $nutritionTab = 'protein';

    public function mount(DietPlan $dietPlan)
    {
        $this->dietPlan = $dietPlan;
    }

    public function setNutritionTab(string $tab): void
    {
        if (in_array($tab, ['protein', 'carbs', 'fibre'], true)) {
            $this->nutritionTab = $tab;
        }
    }

    public function render()
    {
        $meals = $this->dietPlan->meals()
            ->orderByRaw("FIELD(meal_type, 'breakfast', 'lunch', 'dinner', 'snack')")
            ->get();

        $nutritionColumn = match ($this->nutritionTab) {
            'carbs' => 'carbs_grams',
            'fibre' => 'fibre_grams',
            default => 'protein_grams',
        };

        $nutritionFoods = NutritionFood::query()
            ->orderByDesc($nutritionColumn)
            ->orderBy('name')
            ->get();

        return view('livewire.diets.show', compact('meals', 'nutritionFoods'));
    }
}
