<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between flex-wrap gap-4">
            <div>
                <a href="{{ route('workouts.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">&larr; All muscle groups</a>
                <h1 class="mt-1 text-3xl font-bold text-gray-900">{{ $muscleGroup->name }}</h1>
                @if ($muscleGroup->description)
                    <p class="mt-1 text-gray-600">{{ $muscleGroup->description }}</p>
                @endif
            </div>
            @auth
                <a href="{{ route('workouts.log') }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700">
                    Log a workout
                </a>
            @endauth
        </div>

        <div class="mb-6 bg-white rounded-lg shadow p-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Search</label>
                <input type="text" wire:model.live.debounce.300ms="search"
                       placeholder="Exercise name..."
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Difficulty</label>
                <select wire:model.live="difficulty"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">All levels</option>
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
            </div>
        </div>

        @if ($exercises->isEmpty())
            <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
                No exercises found.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($exercises as $exercise)
                    <a href="{{ route('exercises.show', $exercise) }}"
                       class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6 border border-gray-100">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $exercise->name }}</h3>
                            <span class="text-xs font-medium px-2 py-0.5 rounded-full
                                @switch($exercise->difficulty)
                                    @case('beginner') bg-green-100 text-green-800 @break
                                    @case('intermediate') bg-yellow-100 text-yellow-800 @break
                                    @case('advanced') bg-red-100 text-red-800 @break
                                    @default bg-gray-100 text-gray-800
                                @endswitch">
                                {{ ucfirst($exercise->difficulty) }}
                            </span>
                        </div>
                        @if ($exercise->equipment)
                            <p class="text-sm text-gray-500">Equipment: {{ $exercise->equipment }}</p>
                        @endif
                        @if ($exercise->description)
                            <p class="mt-2 text-sm text-gray-600">{{ Str::limit($exercise->description, 100) }}</p>
                        @endif
                    </a>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $exercises->links() }}
            </div>
        @endif
    </div>
</div>
