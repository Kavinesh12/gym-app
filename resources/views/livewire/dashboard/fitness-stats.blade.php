<div>
    @if (session('fitness-status'))
        <div class="mb-3 bg-green-50 border border-green-200 text-green-800 rounded-md p-2 text-sm">
            {{ session('fitness-status') }}
        </div>
    @endif

    <h3 class="text-lg font-semibold text-gray-900">Your Fitness Stats</h3>
    <p class="text-sm text-gray-500">Used to calculate BMI and calorie targets.</p>

    <form wire:submit="save" class="mt-4 space-y-3">
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block text-xs font-medium text-gray-700">Age</label>
                <input type="number" wire:model="age" min="10" max="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700">Gender</label>
                <select wire:model="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700">Height (cm)</label>
                <input type="number" step="0.1" wire:model.live="heightCm" min="50" max="250" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700">Weight (kg)</label>
                <input type="number" step="0.1" wire:model.live="weightKg" min="20" max="300" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700">Goal</label>
                <select wire:model="goal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select</option>
                    <option value="bulking">Bulking</option>
                    <option value="cutting">Cutting</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700">Activity</label>
                <select wire:model="activityLevel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select</option>
                    <option value="sedentary">Sedentary</option>
                    <option value="light">Light</option>
                    <option value="moderate">Moderate</option>
                    <option value="active">Active</option>
                    <option value="very_active">Very Active</option>
                </select>
            </div>
        </div>

        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700">
            Save Stats
        </button>
    </form>

    @if ($this->bmi !== null)
        <div class="mt-4 bg-indigo-50 border border-indigo-200 rounded-md p-3 text-sm">
            <p><strong>BMI:</strong> {{ $this->bmi }} &middot; <span class="text-indigo-700">{{ $this->bmiCategory }}</span></p>
            @if ($this->tdee)
                <p class="mt-1"><strong>Maintenance calories:</strong> {{ number_format($this->tdee) }} kcal/day</p>
            @endif
            @if ($this->recommendedCalories)
                <p class="mt-1"><strong>Recommended for goal:</strong> {{ number_format($this->recommendedCalories) }} kcal/day</p>
            @endif
        </div>
    @endif
</div>
