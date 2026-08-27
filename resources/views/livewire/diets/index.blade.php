<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Diet Plans</h1>
            <p class="mt-1 text-gray-600">Find a plan that matches your goal.</p>
        </div>

        <div class="mb-6">
            <div class="flex flex-wrap gap-2">
                <button wire:click="$set('goal', '')"
                        class="px-4 py-2 rounded-md text-sm font-medium {{ $goal === '' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50' }}">
                    All
                </button>
                <button wire:click="$set('goal', 'bulking')"
                        class="px-4 py-2 rounded-md text-sm font-medium {{ $goal === 'bulking' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50' }}">
                    Bulking
                </button>
                <button wire:click="$set('goal', 'cutting')"
                        class="px-4 py-2 rounded-md text-sm font-medium {{ $goal === 'cutting' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50' }}">
                    Cutting
                </button>
                <button wire:click="$set('goal', 'maintenance')"
                        class="px-4 py-2 rounded-md text-sm font-medium {{ $goal === 'maintenance' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50' }}">
                    Maintenance
                </button>
            </div>
        </div>

        @if ($dietPlans->isEmpty())
            <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
                No diet plans found.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($dietPlans as $plan)
                    <a href="{{ route('diets.show', $plan) }}"
                       class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6 border border-gray-100">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="text-xl font-semibold text-gray-900">{{ $plan->name }}</h2>
                            <span class="text-xs font-medium px-2 py-0.5 rounded-full
                                @switch($plan->goal)
                                    @case('bulking') bg-blue-100 text-blue-800 @break
                                    @case('cutting') bg-red-100 text-red-800 @break
                                    @case('maintenance') bg-green-100 text-green-800 @break
                                    @default bg-gray-100 text-gray-800
                                @endswitch">
                                {{ ucfirst($plan->goal) }}
                            </span>
                        </div>
                        <div class="text-sm text-gray-600 space-y-1">
                            <p><strong>{{ number_format($plan->daily_calories) }}</strong> kcal / day</p>
                            <p>P: {{ $plan->protein_grams }}g &middot; C: {{ $plan->carbs_grams }}g &middot; F: {{ $plan->fats_grams }}g</p>
                        </div>
                        @if ($plan->description)
                            <p class="mt-3 text-sm text-gray-600">{{ Str::limit($plan->description, 100) }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
