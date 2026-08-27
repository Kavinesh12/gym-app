<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Workouts by Muscle Group</h1>
            <p class="mt-1 text-gray-600">Choose a muscle group to find exercises.</p>
        </div>

        @if ($muscleGroups->isEmpty())
            <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
                No muscle groups available yet. Please run the database seeder.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($muscleGroups as $group)
                    <a href="{{ route('workouts.show', $group) }}"
                       class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-900">{{ $group->name }}</h2>
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                {{ $group->exercises_count }} exercises
                            </span>
                        </div>
                        @if ($group->description)
                            <p class="mt-2 text-gray-600 text-sm">{{ Str::limit($group->description, 100) }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
