<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-900">Diet Plans</h1>
            <button wire:click="create" class="px-4 py-2 bg-pink-600 text-white text-sm rounded-md hover:bg-pink-700">+ New</button>
        </div>

        @if (session('status'))
            <div class="bg-green-50 border border-green-200 text-green-800 rounded-md p-3 text-sm">{{ session('status') }}</div>
        @endif

        <div class="bg-white rounded-lg shadow p-6">
            <form wire:submit="save" class="space-y-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Goal</label>
                        <select wire:model="goal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="bulking">Bulking</option>
                            <option value="cutting">Cutting</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Daily Calories</label>
                        <input type="number" wire:model="dailyCalories" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Protein (g)</label>
                        <input type="number" wire:model="proteinGrams" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Carbs (g)</label>
                        <input type="number" wire:model="carbsGrams" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fats (g)</label>
                        <input type="number" wire:model="fatsGrams" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea wire:model="description" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-pink-600 text-white text-sm rounded-md hover:bg-pink-700">
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
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Goal</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">kcal</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">P/C/F</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($plans as $p)
                        <tr>
                            <td class="px-4 py-2 text-sm font-medium text-gray-900">{{ $p->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ ucfirst($p->goal) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ number_format($p->daily_calories) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">{{ $p->protein_grams }}/{{ $p->carbs_grams }}/{{ $p->fats_grams }}</td>
                            <td class="px-4 py-2 text-right text-sm space-x-2">
                                <button wire:click="edit({{ $p->id }})" class="text-indigo-600 hover:text-indigo-800">Edit</button>
                                <button wire:click="delete({{ $p->id }})" wire:confirm="Delete this diet plan?" class="text-red-600 hover:text-red-800">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
