<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6">
            <p class="app-eyebrow mb-1">Train</p>
            <h1 class="app-heading text-4xl">Workouts by Muscle Group</h1>
            <p class="mt-1 app-muted">Choose a muscle group to find exercises.</p>
        </div>

        @if ($muscleGroups->isEmpty())
            <div class="app-card p-6 text-center app-muted">
                No muscle groups available yet. Please run the database seeder.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($muscleGroups as $group)
                    <a href="{{ route('workouts.show', $group) }}"
                       class="app-card hoverable block p-6">
                        <div class="flex items-center justify-between">
                            <h2 class="app-heading text-2xl">{{ $group->name }}</h2>
                            <span class="app-badge app-badge-red">
                                {{ $group->exercises_count }} exercises
                            </span>
                        </div>
                        @if ($group->description)
                            <p class="mt-2 app-muted text-sm">{{ Str::limit($group->description, 100) }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
