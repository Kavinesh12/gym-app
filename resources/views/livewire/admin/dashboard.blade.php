<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
                <p class="text-gray-600">Overview of your gym app.</p>
            </div>
            <div class="flex gap-2 flex-wrap">
                <a href="{{ route('admin.muscle-groups') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">Muscle Groups</a>
                <a href="{{ route('admin.exercises') }}" class="px-4 py-2 bg-purple-600 text-white text-sm rounded-md hover:bg-purple-700">Exercises</a>
                <a href="{{ route('admin.diet-plans') }}" class="px-4 py-2 bg-pink-600 text-white text-sm rounded-md hover:bg-pink-700">Diet Plans</a>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="bg-white rounded-lg shadow p-5">
                <p class="text-sm text-gray-500">Total Users</p>
                <p class="mt-1 text-3xl font-bold text-gray-900">{{ $stats['users'] }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ $stats['admins'] }} admins &middot; {{ $stats['trainers'] }} trainers &middot; {{ $stats['registered'] }} users</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <p class="text-sm text-gray-500">Muscle Groups</p>
                <p class="mt-1 text-3xl font-bold text-gray-900">{{ $stats['muscle_groups'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <p class="text-sm text-gray-500">Exercises</p>
                <p class="mt-1 text-3xl font-bold text-gray-900">{{ $stats['exercises'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <p class="text-sm text-gray-500">Diet Plans</p>
                <p class="mt-1 text-3xl font-bold text-gray-900">{{ $stats['diet_plans'] }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-5 col-span-2 sm:col-span-4">
                <p class="text-sm text-gray-500">Workout Logs Recorded</p>
                <p class="mt-1 text-3xl font-bold text-gray-900">{{ $stats['workout_logs'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-900">Recent Sign-ups</h2>
            <ul class="mt-3 divide-y divide-gray-100">
                @forelse ($recentUsers as $u)
                    <li class="py-2 flex items-center justify-between text-sm">
                        <span><strong class="text-gray-900">{{ $u->name }}</strong> <span class="text-gray-500">({{ $u->email }})</span></span>
                        <span class="text-xs px-2 py-0.5 rounded-full bg-gray-100 text-gray-700">{{ $u->role }}</span>
                    </li>
                @empty
                    <li class="py-3 text-gray-500 text-sm">No users yet.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
