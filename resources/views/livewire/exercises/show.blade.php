<div class="py-8">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('workouts.show', $exercise->muscleGroup) }}" class="app-link text-sm">
            &larr; Back to {{ $exercise->muscleGroup->name }}
        </a>

        <div class="mt-2 app-card p-6">
            <div class="flex items-start justify-between flex-wrap gap-3">
                <div>
                    <h1 class="app-heading text-3xl">{{ $exercise->name }}</h1>
                    <p class="mt-1 app-muted">{{ $exercise->muscleGroup->name }}</p>
                </div>
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

            @if ($exercise->image)
                <div class="mt-4">
                    <img src="{{ Str::startsWith($exercise->image, ['http://', 'https://']) ? $exercise->image : asset($exercise->image) }}"
                         alt="{{ $exercise->name }}"
                         loading="lazy"
                         class="w-full max-w-md rounded-lg mx-auto" style="border: 1px solid rgba(255,255,255,.08);">
                </div>
            @endif

            @if ($exercise->equipment)
                <p class="mt-4 text-sm"><strong style="color: var(--white);">Equipment:</strong> <span class="app-muted">{{ $exercise->equipment }}</span></p>
            @endif

            @if ($exercise->description)
                <div class="mt-4">
                    <h2 class="text-lg font-semibold" style="color: var(--white);">Description</h2>
                    <p class="mt-1 app-muted">{{ $exercise->description }}</p>
                </div>
            @endif

            @if ($exercise->instructions)
                <div class="mt-4">
                    <h2 class="text-lg font-semibold" style="color: var(--white);">Instructions</h2>
                    <p class="mt-1 app-muted whitespace-pre-line">{{ $exercise->instructions }}</p>
                </div>
            @endif

            @auth
                <div class="mt-6">
                    <a href="{{ route('workouts.log') }}" class="app-btn">
                        Log this exercise
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>
