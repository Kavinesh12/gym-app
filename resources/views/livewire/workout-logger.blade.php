<div class="py-8">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">Log a Workout</h1>
        <p class="mt-1 text-gray-600">Record what you trained today.</p>

        @if (session('status'))
            <div class="mt-4 bg-green-50 border border-green-200 text-green-800 rounded-md p-3 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form wire:submit="save" class="mt-6 bg-white rounded-lg shadow p-6 space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Muscle Group</label>
                    <select wire:model.live="muscleGroupId"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="0">Select a muscle group</option>
                        @foreach ($this->muscleGroups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                    @error('muscleGroupId') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Exercise</label>
                    <select wire:model="exerciseId"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            @disabled($this->exercises->isEmpty())>
                        <option value="0">Select an exercise</option>
                        @foreach ($this->exercises as $exercise)
                            <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                        @endforeach
                    </select>
                    @error('exerciseId') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Sets</label>
                    <input type="number" wire:model="sets" min="1" max="50"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('sets') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Reps</label>
                    <input type="number" wire:model="reps" min="1" max="100"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('reps') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Weight (kg)</label>
                    <input type="number" step="0.5" wire:model="weightKg" min="0" max="1000"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('weightKg') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" wire:model="performedAt"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('performedAt') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Notes (optional)</label>
                <textarea wire:model="notes" rows="2"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                @error('notes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700">
                    Save Workout
                </button>
            </div>
        </form>

        <h2 class="mt-10 mb-4 text-2xl font-bold text-gray-900">Recent Workouts</h2>
        @if ($recentLogs->isEmpty())
            <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
                No workouts logged yet.
            </div>
        @else
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Exercise</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Muscle</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Sets x Reps</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Weight</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($recentLogs as $log)
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $log->performed_at->format('M d, Y') }}</td>
                                <td class="px-4 py-2 text-sm text-gray-900">{{ $log->exercise->name }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $log->exercise->muscleGroup->name }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $log->sets }} x {{ $log->reps }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $log->weight_kg ? $log->weight_kg . ' kg' : '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
