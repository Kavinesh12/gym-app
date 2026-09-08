<x-app-layout>
    <x-slot name="header">
        <p class="app-eyebrow mb-1">Overview</p>
        <h2 class="app-heading text-3xl">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="app-card overflow-hidden">
                <div class="p-6">
                    <h3 class="app-heading text-2xl">Welcome back, {{ auth()->user()->name }}!</h3>
                    <p class="mt-1 text-sm app-muted">Quick links:</p>
                    <div class="mt-4 flex flex-wrap gap-3">
                        <a href="{{ route('workouts.index') }}" class="app-btn">Browse Workouts</a>
                        <a href="{{ route('diets.index') }}" class="app-btn app-btn-outline">Diet Plans</a>
                        <a href="{{ route('workouts.log') }}" class="app-btn app-btn-outline">Log Workout</a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="app-card p-6">
                    <livewire:dashboard.fitness-stats />
                </div>

                <div class="app-card overflow-hidden">
                    <div class="p-6">
                        <h3 class="app-heading text-xl">Recent Workouts</h3>
                        @php
                            $logs = auth()->user()->workoutLogs()
                                ->with('exercise.muscleGroup')
                                ->latest('performed_at')
                                ->limit(5)
                                ->get();
                        @endphp
                        @if ($logs->isEmpty())
                            <p class="mt-2 text-sm app-muted">No workouts logged yet.</p>
                            <a href="{{ route('workouts.log') }}" class="mt-3 inline-block text-sm app-link">Log your first workout &rarr;</a>
                        @else
                            <ul class="mt-3 app-divide">
                                @foreach ($logs as $log)
                                    <li class="py-3 text-sm flex justify-between gap-4 flex-wrap">
                                        <span>
                                            <strong style="color: var(--white);">{{ $log->exercise->name }}</strong>
                                            <span class="app-muted">({{ $log->exercise->muscleGroup->name }})</span>
                                        </span>
                                        <span class="app-muted">{{ $log->performed_at->format('M d') }} &middot; {{ $log->sets }}x{{ $log->reps }}{{ $log->weight_kg ? ' @ '.$log->weight_kg.'kg' : '' }}</span>
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
