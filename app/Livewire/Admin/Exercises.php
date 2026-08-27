<?php

namespace App\Livewire\Admin;

use App\Models\Exercise;
use App\Models\MuscleGroup;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Manage Exercises')]
class Exercises extends Component
{
    public ?int $editingId = null;

    #[Validate('required|exists:muscle_groups,id')]
    public int $muscleGroupId = 0;

    #[Validate('required|string|max:150')]
    public string $name = '';

    #[Validate('required|in:beginner,intermediate,advanced')]
    public string $difficulty = 'beginner';

    #[Validate('nullable|string|max:150')]
    public ?string $equipment = null;

    #[Validate('nullable|string')]
    public ?string $description = null;

    #[Validate('nullable|string')]
    public ?string $instructions = null;

    public function create()
    {
        $this->reset(['editingId', 'name', 'equipment', 'description', 'instructions']);
        $this->difficulty = 'beginner';
    }

    public function edit(int $id)
    {
        $ex = Exercise::findOrFail($id);
        $this->editingId = $ex->id;
        $this->muscleGroupId = $ex->muscle_group_id;
        $this->name = $ex->name;
        $this->difficulty = $ex->difficulty;
        $this->equipment = $ex->equipment;
        $this->description = $ex->description;
        $this->instructions = $ex->instructions;
    }

    public function save()
    {
        $data = $this->validate();
        $data['slug'] = Str::slug($data['name']);

        if ($this->editingId) {
            Exercise::findOrFail($this->editingId)->update($data);
            session()->flash('status', 'Exercise updated.');
        } else {
            Exercise::create($data);
            session()->flash('status', 'Exercise created.');
        }

        $this->reset(['editingId', 'name', 'equipment', 'description', 'instructions']);
    }

    public function delete(int $id)
    {
        Exercise::findOrFail($id)->delete();
        session()->flash('status', 'Exercise deleted.');
    }

    public function render()
    {
        $exercises = Exercise::with('muscleGroup')->orderBy('name')->get();
        $muscleGroups = MuscleGroup::orderBy('name')->get();
        return view('livewire.admin.exercises', compact('exercises', 'muscleGroups'));
    }
}
