<?php

namespace App\Livewire\Admin;

use App\Models\DietMeal;
use App\Models\DietPlan;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Manage Diet Plans')]
class DietPlans extends Component
{
    public ?int $editingId = null;

    #[Validate('required|string|max:150')]
    public string $name = '';

    #[Validate('required|in:bulking,cutting,maintenance')]
    public string $goal = 'maintenance';

    #[Validate('required|integer|min:1000|max:6000')]
    public int $dailyCalories = 2000;

    #[Validate('required|integer|min:50|max:400')]
    public int $proteinGrams = 150;

    #[Validate('required|integer|min:50|max:600')]
    public int $carbsGrams = 200;

    #[Validate('required|integer|min:20|max:200')]
    public int $fatsGrams = 60;

    #[Validate('nullable|string')]
    public ?string $description = null;

    public function create()
    {
        $this->reset(['editingId', 'name', 'description']);
        $this->goal = 'maintenance';
        $this->dailyCalories = 2000;
        $this->proteinGrams = 150;
        $this->carbsGrams = 200;
        $this->fatsGrams = 60;
    }

    public function edit(int $id)
    {
        $p = DietPlan::findOrFail($id);
        $this->editingId = $p->id;
        $this->name = $p->name;
        $this->goal = $p->goal;
        $this->dailyCalories = $p->daily_calories;
        $this->proteinGrams = $p->protein_grams;
        $this->carbsGrams = $p->carbs_grams;
        $this->fatsGrams = $p->fats_grams;
        $this->description = $p->description;
    }

    public function save()
    {
        $data = $this->validate();
        $data['slug'] = Str::slug($data['name']);
        $data['daily_calories'] = $data['dailyCalories'];
        $data['protein_grams'] = $data['proteinGrams'];
        $data['carbs_grams'] = $data['carbsGrams'];
        $data['fats_grams'] = $data['fatsGrams'];
        unset($data['dailyCalories'], $data['proteinGrams'], $data['carbsGrams'], $data['fatsGrams']);

        if ($this->editingId) {
            DietPlan::findOrFail($this->editingId)->update($data);
            session()->flash('status', 'Diet plan updated.');
        } else {
            DietPlan::create($data);
            session()->flash('status', 'Diet plan created.');
        }

        $this->reset(['editingId', 'name', 'description']);
    }

    public function delete(int $id)
    {
        DietPlan::findOrFail($id)->delete();
        session()->flash('status', 'Diet plan deleted.');
    }

    public function render()
    {
        $plans = DietPlan::withCount('meals')->orderBy('daily_calories')->get();
        return view('livewire.admin.diet-plans', compact('plans'));
    }
}
