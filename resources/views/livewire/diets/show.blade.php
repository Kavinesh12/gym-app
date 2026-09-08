<div class="py-8">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('diets.index') }}" class="app-link text-sm">
            &larr; All diet plans
        </a>

        <div class="mt-2 app-card p-6">
            <div class="flex items-start justify-between flex-wrap gap-3">
                <div>
                    <h1 class="app-heading text-3xl">{{ $dietPlan->name }}</h1>
                    <p class="mt-1">
                        <span class="app-badge
                            @switch($dietPlan->goal)
                                @case('bulking') app-badge-blue @break
                                @case('cutting') app-badge-red @break
                                @case('maintenance') app-badge-green @break
                                @default app-badge-gray
                            @endswitch">
                            {{ ucfirst($dietPlan->goal) }}
                        </span>
                    </p>
                </div>
                <div class="text-right text-sm app-muted">
                    <p><strong style="color: var(--white);">{{ number_format($dietPlan->daily_calories) }}</strong> kcal / day</p>
                    <p>P: {{ $dietPlan->protein_grams }}g &middot; C: {{ $dietPlan->carbs_grams }}g &middot; F: {{ $dietPlan->fats_grams }}g</p>
                </div>
            </div>

            @if ($dietPlan->description)
                <p class="mt-4 app-muted">{{ $dietPlan->description }}</p>
            @endif
        </div>

        <h2 class="mt-8 mb-4 app-heading text-3xl">Daily Meals</h2>

        @if ($meals->isEmpty())
            <div class="app-card p-6 text-center app-muted">
                No meals defined for this plan.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($meals as $meal)
                    <div class="app-card p-6">
                        <div class="flex items-center justify-between gap-2">
                            <h3 class="text-lg font-semibold" style="color: var(--white);">{{ $meal->name }}</h3>
                            <span class="app-badge app-badge-gray">
                                {{ $meal->meal_type }}
                            </span>
                        </div>
                        <p class="mt-1 text-sm font-medium" style="color: var(--red2);">{{ $meal->calories }} kcal</p>
                        @if ($meal->description)
                            <p class="mt-2 app-muted">{{ $meal->description }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
