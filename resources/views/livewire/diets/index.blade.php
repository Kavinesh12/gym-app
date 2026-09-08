<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6">
            <p class="app-eyebrow mb-1">Nutrition</p>
            <h1 class="app-heading text-4xl">Diet Plans</h1>
            <p class="mt-1 app-muted">Find a plan that matches your goal.</p>
        </div>

        <div class="mb-6">
            <div class="flex flex-wrap gap-2">
                <button wire:click="$set('goal', '')"
                        class="app-btn {{ $goal === '' ? '' : 'app-btn-outline' }}">
                    All
                </button>
                <button wire:click="$set('goal', 'bulking')"
                        class="app-btn {{ $goal === 'bulking' ? '' : 'app-btn-outline' }}">
                    Bulking
                </button>
                <button wire:click="$set('goal', 'cutting')"
                        class="app-btn {{ $goal === 'cutting' ? '' : 'app-btn-outline' }}">
                    Cutting
                </button>
                <button wire:click="$set('goal', 'maintenance')"
                        class="app-btn {{ $goal === 'maintenance' ? '' : 'app-btn-outline' }}">
                    Maintenance
                </button>
            </div>
        </div>

        @if ($dietPlans->isEmpty())
            <div class="app-card p-6 text-center app-muted">
                No diet plans found.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($dietPlans as $plan)
                    <a href="{{ route('diets.show', $plan) }}"
                       class="app-card hoverable block p-6">
                        <div class="flex items-center justify-between mb-2 gap-2">
                            <h2 class="app-heading text-xl">{{ $plan->name }}</h2>
                            <span class="app-badge
                                @switch($plan->goal)
                                    @case('bulking') app-badge-blue @break
                                    @case('cutting') app-badge-red @break
                                    @case('maintenance') app-badge-green @break
                                    @default app-badge-gray
                                @endswitch">
                                {{ ucfirst($plan->goal) }}
                            </span>
                        </div>
                        <div class="text-sm app-muted space-y-1">
                            <p><strong style="color: var(--white);">{{ number_format($plan->daily_calories) }}</strong> kcal / day</p>
                            <p>P: {{ $plan->protein_grams }}g &middot; C: {{ $plan->carbs_grams }}g &middot; F: {{ $plan->fats_grams }}g</p>
                        </div>
                        @if ($plan->description)
                            <p class="mt-3 text-sm app-muted">{{ Str::limit($plan->description, 100) }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
