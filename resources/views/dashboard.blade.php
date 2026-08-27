<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900">Welcome back, {{ auth()->user()->name }}!</h3>
                    <p class="mt-1 text-sm text-gray-600">Quick links:</p>
                    <div class="mt-3 flex flex-wrap gap-3">
                        <a href="{{ route('workouts.index') }}" class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">Browse Workouts</a>
                        <a href="{{ route('diets.index') }}" class="inline-flex items-center px-3 py-2 bg-purple-600 text-white text-sm rounded-md hover:bg-purple-700">Diet Plans</a>
                        <a href="{{ route('workouts.log') }}" class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm rounded-md hover:bg-green-700">Log Workout</a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <livewire:dashboard.fitness-stats />

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Workouts</h3>
                        @php
                            $logs = auth()->user()->workoutLogs()
                                ->with('exercise.muscleGroup')
                                ->latest('performed_at')
                                ->limit(5)
                                ->get();
                        @endphp
                        @if ($logs->isEmpty())
                            <p class="mt-2 text-sm text-gray-500">No workouts logged yet.</p>
                            <a href="{{ route('workouts.log') }}" class="mt-3 inline-block text-sm text-indigo-600 hover:text-indigo-800">Log your first workout &rarr;</a>
                        @else
                            <ul class="mt-3 divide-y divide-gray-100">
                                @foreach ($logs as $log)
                                    <li class="py-2 text-sm flex justify-between">
                                        <span>
                                            <strong class="text-gray-900">{{ $log->exercise->name }}</strong>
                                            <span class="text-gray-500">({{ $log->exercise->muscleGroup->name }})</span>
                                        </span>
                                        <span class="text-gray-500">{{ $log->performed_at->format('M d') }} &middot; {{ $log->sets }}x{{ $log->reps }}{{ $log->weight_kg ? ' @ '.$log->weight_kg.'kg' : '' }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
