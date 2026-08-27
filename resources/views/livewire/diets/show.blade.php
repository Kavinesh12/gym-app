<div class="py-8">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('diets.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
            &larr; All diet plans
        </a>

        <div class="mt-2 bg-white rounded-lg shadow p-6">
            <div class="flex items-start justify-between flex-wrap gap-3">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $dietPlan->name }}</h1>
                    <p class="mt-1">
                        <span class="text-xs font-medium px-2 py-0.5 rounded-full
                            @switch($dietPlan->goal)
                                @case('bulking') bg-blue-100 text-blue-800 @break
                                @case('cutting') bg-red-100 text-red-800 @break
                                @case('maintenance') bg-green-100 text-green-800 @break
                                @default bg-gray-100 text-gray-800
                            @endswitch">
                            {{ ucfirst($dietPlan->goal) }}
                        </span>
                    </p>
                </div>
                <div class="text-right text-sm text-gray-700">
                    <p><strong>{{ number_format($dietPlan->daily_calories) }}</strong> kcal / day</p>
                    <p>P: {{ $dietPlan->protein_grams }}g &middot; C: {{ $dietPlan->carbs_grams }}g &middot; F: {{ $dietPlan->fats_grams }}g</p>
                </div>
            </div>

            @if ($dietPlan->description)
                <p class="mt-4 text-gray-700">{{ $dietPlan->description }}</p>
            @endif
        </div>

        <h2 class="mt-8 mb-4 text-2xl font-bold text-gray-900">Daily Meals</h2>

        @if ($meals->isEmpty())
            <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
                No meals defined for this plan.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($meals as $meal)
                    <div class="bg-white rounded-lg shadow p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $meal->name }}</h3>
                            <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-gray-100 text-gray-700 uppercase">
                                {{ $meal->meal_type }}
                            </span>
                        </div>
                        <p class="mt-1 text-sm text-indigo-600 font-medium">{{ $meal->calories }} kcal</p>
                        @if ($meal->description)
                            <p class="mt-2 text-gray-700">{{ $meal->description }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
