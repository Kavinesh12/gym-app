<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Trainer Dashboard</h1>
            <p class="text-gray-600">Track your clients' progress and exercise library.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white rounded-lg shadow p-5">
                <p class="text-sm text-gray-500">Active Clients</p>
                <p class="mt-1 text-3xl font-bold text-gray-900">{{ $activeClients }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <p class="text-sm text-gray-500">Workout Logs</p>
                <p class="mt-1 text-3xl font-bold text-gray-900">{{ $totalLogs }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <p class="text-sm text-gray-500">Muscle Groups</p>
                <p class="mt-1 text-3xl font-bold text-gray-900">{{ $muscleGroups->count() }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900">Recent Clients</h2>
                <ul class="mt-3 divide-y divide-gray-100">
                    @forelse ($clients as $c)
                        <li class="py-2 flex items-center justify-between text-sm">
                            <span><strong class="text-gray-900">{{ $c->name }}</strong> <span class="text-gray-500">({{ $c->email }})</span></span>
                            <span class="text-xs text-gray-500">{{ $c->workout_logs_count }} logs</span>
                        </li>
                    @empty
                        <li class="py-3 text-gray-500 text-sm">No clients yet.</li>
                    @endforelse
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold text-gray-900">Exercise Library</h2>
                <ul class="mt-3 space-y-1 text-sm">
                    @foreach ($muscleGroups as $mg)
                        <li class="flex items-center justify-between">
                            <a href="{{ route('workouts.show', $mg) }}" class="text-indigo-600 hover:text-indigo-800">{{ $mg->name }}</a>
                            <span class="text-xs text-gray-500">{{ $mg->exercises_count }} exercises</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
