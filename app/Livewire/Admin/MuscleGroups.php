<?php

namespace App\Livewire\Admin;

use App\Models\MuscleGroup;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Manage Muscle Groups')]
class MuscleGroups extends Component
{
    public ?int $editingId = null;

    #[Validate('required|string|max:100')]
    public string $name = '';

    #[Validate('nullable|string')]
    public ?string $description = null;

    public function create()
    {
        $this->reset(['editingId', 'name', 'description']);
    }

    public function edit(int $id)
    {
        $group = MuscleGroup::findOrFail($id);
        $this->editingId = $group->id;
        $this->name = $group->name;
        $this->description = $group->description;
    }

    public function save()
    {
        $data = $this->validate();
        $data['slug'] = Str::slug($data['name']);

        if ($this->editingId) {
            MuscleGroup::findOrFail($this->editingId)->update($data);
            session()->flash('status', 'Muscle group updated.');
        } else {
            MuscleGroup::create($data);
            session()->flash('status', 'Muscle group created.');
        }

        $this->reset(['editingId', 'name', 'description']);
    }

    public function delete(int $id)
    {
        MuscleGroup::findOrFail($id)->delete();
        session()->flash('status', 'Muscle group deleted.');
    }

    public function render()
    {
        $groups = MuscleGroup::withCount('exercises')->orderBy('name')->get();
        return view('livewire.admin.muscle-groups', compact('groups'));
    }
}
