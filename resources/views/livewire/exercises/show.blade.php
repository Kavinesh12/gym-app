<div class="py-8">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('workouts.show', $exercise->muscleGroup) }}" class="text-sm text-indigo-600 hover:text-indigo-800">
            &larr; Back to {{ $exercise->muscleGroup->name }}
        </a>

        <div class="mt-2 bg-white rounded-lg shadow p-6">
            <div class="flex items-start justify-between flex-wrap gap-3">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $exercise->name }}</h1>
                    <p class="mt-1 text-gray-600">{{ $exercise->muscleGroup->name }}</p>
                </div>
                <span class="text-xs font-medium px-2.5 py-0.5 rounded-full
                    @switch($exercise->difficulty)
                        @case('beginner') bg-green-100 text-green-800 @break
                        @case('intermediate') bg-yellow-100 text-yellow-800 @break
                        @case('advanced') bg-red-100 text-red-800 @break
                        @default bg-gray-100 text-gray-800
                    @endswitch">
                    {{ ucfirst($exercise->difficulty) }}
                </span>
            </div>

            @if ($exercise->image)
                <div class="mt-4">
                    <img src="{{ Str::startsWith($exercise->image, ['http://', 'https://']) ? $exercise->image : asset($exercise->image) }}"
                         alt="{{ $exercise->name }}"
                         loading="lazy"
                         class="w-full max-w-md rounded-lg shadow-sm mx-auto">
                </div>
            @endif

            @if ($exercise->equipment)
                <p class="mt-4 text-sm text-gray-700"><strong>Equipment:</strong> {{ $exercise->equipment }}</p>
            @endif

            @if ($exercise->description)
                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-gray-900">Description</h2>
                    <p class="mt-1 text-gray-700">{{ $exercise->description }}</p>
                </div>
            @endif

            @if ($exercise->instructions)
                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-gray-900">Instructions</h2>
                    <p class="mt-1 text-gray-700 whitespace-pre-line">{{ $exercise->instructions }}</p>
                </div>
            @endif

            @auth
                <div class="mt-6">
                    <a href="{{ route('workouts.log') }}"
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700">
                        Log this exercise
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>