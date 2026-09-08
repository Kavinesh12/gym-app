<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between flex-wrap gap-4">
            <div>
                <a href="{{ route('workouts.index') }}" class="app-link text-sm">&larr; All muscle groups</a>
                <h1 class="mt-1 app-heading text-4xl">{{ $muscleGroup->name }}</h1>
                @if ($muscleGroup->description)
                    <p class="mt-1 app-muted">{{ $muscleGroup->description }}</p>
                @endif
            </div>
            @auth
                <a href="{{ route('workouts.log') }}" class="app-btn">
                    Log a workout
                </a>
            @endauth
        </div>

        <div class="mb-6 app-card p-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="app-label">Search</label>
                <input type="text" wire:model.live.debounce.300ms="search"
                       placeholder="Exercise name..."
                       class="app-input">
            </div>
            <div>
                <label class="app-label">Difficulty</label>
                <select wire:model.live="difficulty" class="app-select">
                    <option value="">All levels</option>
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
            </div>
        </div>

        @if ($exercises->isEmpty())
            <div class="app-card p-6 text-center app-muted">
                No exercises found.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($exercises as $exercise)
                    <a href="{{ route('exercises.show', $exercise) }}"
                       class="app-card hoverable block p-6">
                        <div class="flex items-center justify-between mb-2 gap-2">
                            <h3 class="text-lg font-semibold" style="color: var(--white);">{{ $exercise->name }}</h3>
                            <span class="app-badge
                                @switch($exercise->difficulty)
                                    @case('beginner') app-badge-green @break
                                    @case('intermediate') app-badge-yellow @break
                                    @case('advanced') app-badge-red @break
                                    @default app-badge-gray
                                @endswitch">
                                {{ ucfirst($exercise->difficulty) }}
                            </span>
                        </div>
                        @if ($exercise->equipment)
                            <p class="text-sm app-muted">Equipment: {{ $exercise->equipment }}</p>
                        @endif
                        @if ($exercise->description)
                            <p class="mt-2 text-sm app-muted">{{ Str::limit($exercise->description, 100) }}</p>
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
