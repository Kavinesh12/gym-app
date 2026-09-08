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

        <div class="mt-8 bg-white rounded-lg shadow p-6">
            <div class="mb-5">
                <h2 class="text-2xl font-bold text-gray-900">Nutrition Guide</h2>
                <p class="mt-1 text-sm text-gray-600">Click a nutrient to see foods ranked by the amount they contain per 100g.</p>
            </div>

            <div class="flex flex-wrap gap-2 mb-6" role="tablist" aria-label="Nutrition categories">
                <button
                    type="button"
                    wire:click="setNutritionTab('protein')"
                    class="px-5 py-2.5 rounded-md text-sm font-semibold transition {{ $nutritionTab === 'protein' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                    role="tab"
                    aria-selected="{{ $nutritionTab === 'protein' ? 'true' : 'false' }}"
                >
                    Protein
                </button>
                <button
                    type="button"
                    wire:click="setNutritionTab('carbs')"
                    class="px-5 py-2.5 rounded-md text-sm font-semibold transition {{ $nutritionTab === 'carbs' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                    role="tab"
                    aria-selected="{{ $nutritionTab === 'carbs' ? 'true' : 'false' }}"
                >
                    Carbs
                </button>
                <button
                    type="button"
                    wire:click="setNutritionTab('fibre')"
                    class="px-5 py-2.5 rounded-md text-sm font-semibold transition {{ $nutritionTab === 'fibre' ? 'bg-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                    role="tab"
                    aria-selected="{{ $nutritionTab === 'fibre' ? 'true' : 'false' }}"
                >
                    Fibre
                </button>
            </div>

            <div class="overflow-x-auto border border-gray-200 rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Food</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-red-600 uppercase tracking-wider">
                                {{ ucfirst($nutritionTab) }} / 100g
                            </th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Protein</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Carbs</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Fibre</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Calories</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($nutritionFoods as $food)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $food->name }}</td>
                                <td class="px-4 py-3 text-sm font-bold text-red-600 text-right">
                                    {{ number_format($food->{$nutritionTab === 'carbs' ? 'carbs_grams' : ($nutritionTab === 'fibre' ? 'fibre_grams' : 'protein_grams')}, 1) }}g
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700 text-right">{{ number_format($food->protein_grams, 1) }}g</td>
                                <td class="px-4 py-3 text-sm text-gray-700 text-right">{{ number_format($food->carbs_grams, 1) }}g</td>
                                <td class="px-4 py-3 text-sm text-gray-700 text-right">{{ number_format($food->fibre_grams, 1) }}g</td>
                                <td class="px-4 py-3 text-sm text-gray-700 text-right">{{ $food->calories }} kcal</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p class="mt-3 text-xs text-gray-500">Nutrition values are approximate per 100g and may vary by brand and preparation.</p>
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
