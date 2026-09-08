<div>
    @if (session('fitness-status'))
        <div class="mb-3 rounded-md p-2 text-sm" style="background: rgba(46,204,113,.1); border: 1px solid rgba(46,204,113,.3); color: #6fe3a0;">
            {{ session('fitness-status') }}
        </div>
    @endif

    <h3 class="app-heading text-xl">Your Fitness Stats</h3>
    <p class="text-sm app-muted">Used to calculate BMI and calorie targets.</p>

    <form wire:submit="save" class="mt-4 space-y-3">
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="app-label">Age</label>
                <input type="number" wire:model="age" min="10" max="100" class="app-input text-sm">
            </div>
            <div>
                <label class="app-label">Gender</label>
                <select wire:model="gender" class="app-select text-sm">
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div>
                <label class="app-label">Height (cm)</label>
                <input type="number" step="0.1" wire:model.live="heightCm" min="50" max="250" class="app-input text-sm">
            </div>
            <div>
                <label class="app-label">Weight (kg)</label>
                <input type="number" step="0.1" wire:model.live="weightKg" min="20" max="300" class="app-input text-sm">
            </div>
            <div>
                <label class="app-label">Goal</label>
                <select wire:model="goal" class="app-select text-sm">
                    <option value="">Select</option>
                    <option value="bulking">Bulking</option>
                    <option value="cutting">Cutting</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
            <div>
                <label class="app-label">Activity</label>
                <select wire:model="activityLevel" class="app-select text-sm">
                    <option value="">Select</option>
                    <option value="sedentary">Sedentary</option>
                    <option value="light">Light</option>
                    <option value="moderate">Moderate</option>
                    <option value="active">Active</option>
                    <option value="very_active">Very Active</option>
                </select>
            </div>
        </div>

        <button type="submit" class="app-btn w-full">
            Save Stats
        </button>
    </form>

    @if ($this->bmi !== null)
        <div class="mt-4 rounded-md p-3 text-sm" style="background: rgba(230,59,46,.08); border: 1px solid rgba(230,59,46,.25);">
            <p><strong>BMI:</strong> {{ $this->bmi }} &middot; <span style="color: var(--red2);">{{ $this->bmiCategory }}</span></p>
            @if ($this->tdee)
                <p class="mt-1"><strong>Maintenance calories:</strong> {{ number_format($this->tdee) }} kcal/day</p>
            @endif
            @if ($this->recommendedCalories)
                <p class="mt-1"><strong>Recommended for goal:</strong> {{ number_format($this->recommendedCalories) }} kcal/day</p>
            @endif
        </div>
    @endif
</div>
