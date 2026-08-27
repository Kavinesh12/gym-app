<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-900">Exercises</h1>
            <button wire:click="create" class="px-4 py-2 bg-purple-600 text-white text-sm rounded-md hover:bg-purple-700">+ New</button>
        </div>

        @if (session('status'))
            <div class="bg-green-50 border border-green-200 text-green-800 rounded-md p-3 text-sm">{{ session('status') }}</div>
        @endif

        <div class="bg-white rounded-lg shadow p-6">
            <form wire:submit="save" class="space-y-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Muscle Group</label>
                        <select wire:model="muscleGroupId" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="0">Select</option>
                            @foreach ($muscleGroups as $mg)
                                <option value="{{ $mg->id }}">{{ $mg->name }}</option>
                            @endforeach
                        </select>
                        @error('muscleGroupId') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Difficulty</label>
                        <select wire:model="difficulty" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Equipment</label>
                        <input type="text" wire:model="equipment" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea wire:model="description" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Instructions</label>
                    <textarea wire:model="instructions" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white text-sm rounded-md hover:bg-purple-700">
                        {{ $editingId ? 'Update' : 'Create' }}
                    </button>
                    @if ($editingId)
                        <button type="button" wire:click="create" class="px-4 py-2 bg-gray-200 text-gray-800 text-sm rounded-md hover:bg-gray-300">Cancel</button>
                    @endif
                </div>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Muscle</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Difficulty</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Equipment</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($exercises as $ex)
                        <tr>
                            <td class="px-4 py-2 text-sm font-medium text-gray-900">{{ $ex->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $ex->muscleGroup->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ ucfirst($ex->difficulty) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">{{ $ex->equipment ?? '—' }}</td>
                            <td class="px-4 py-2 text-right text-sm space-x-2">
                                <button wire:click="edit({{ $ex->id }})" class="text-indigo-600 hover:text-indigo-800">Edit</button>
                                <button wire:click="delete({{ $ex->id }})" wire:confirm="Delete this exercise?" class="text-red-600 hover:text-red-800">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
