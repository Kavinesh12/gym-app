<div class="py-8">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <p class="app-eyebrow mb-1">Track</p>
        <h1 class="app-heading text-4xl">Log a Workout</h1>
        <p class="mt-1 app-muted">Record what you trained today.</p>

        @if (session('status'))
            <div class="mt-4 rounded-md p-3 text-sm" style="background: rgba(46,204,113,.1); border: 1px solid rgba(46,204,113,.3); color: #6fe3a0;">
                {{ session('status') }}
            </div>
        @endif

        <form wire:submit="save" class="mt-6 app-card p-6 space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="app-label">Muscle Group</label>
                    <select wire:model.live="muscleGroupId" class="app-select">
                        <option value="0">Select a muscle group</option>
                        @foreach ($this->muscleGroups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                    @error('muscleGroupId') <p class="mt-1 text-sm" style="color: #ff6b6b;">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="app-label">Exercise</label>
                    <select wire:model="exerciseId" class="app-select" @disabled($this->exercises->isEmpty())>
                        <option value="0">Select an exercise</option>
                        @foreach ($this->exercises as $exercise)
                            <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                        @endforeach
                    </select>
                    @error('exerciseId') <p class="mt-1 text-sm" style="color: #ff6b6b;">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div>
                    <label class="app-label">Sets</label>
                    <input type="number" wire:model="sets" min="1" max="50" class="app-input">
                    @error('sets') <p class="mt-1 text-sm" style="color: #ff6b6b;">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="app-label">Reps</label>
                    <input type="number" wire:model="reps" min="1" max="100" class="app-input">
                    @error('reps') <p class="mt-1 text-sm" style="color: #ff6b6b;">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="app-label">Weight (kg)</label>
                    <input type="number" step="0.5" wire:model="weightKg" min="0" max="1000" class="app-input">
                    @error('weightKg') <p class="mt-1 text-sm" style="color: #ff6b6b;">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="app-label">Date</label>
                    <input type="date" wire:model="performedAt" class="app-input">
                    @error('performedAt') <p class="mt-1 text-sm" style="color: #ff6b6b;">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="app-label">Notes (optional)</label>
                <textarea wire:model="notes" rows="2" class="app-input"></textarea>
                @error('notes') <p class="mt-1 text-sm" style="color: #ff6b6b;">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="app-btn">
                    Save Workout
                </button>
            </div>
        </form>

        <h2 class="mt-10 mb-4 app-heading text-3xl">Recent Workouts</h2>
        @if ($recentLogs->isEmpty())
            <div class="app-card p-6 text-center app-muted">
                No workouts logged yet.
            </div>
        @else
            <div class="app-card overflow-hidden">
                <table class="min-w-full">
                    <thead style="background: var(--dark);">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider app-muted">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider app-muted">Exercise</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider app-muted">Muscle</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider app-muted">Sets x Reps</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider app-muted">Weight</th>
                        </tr>
                    </thead>
                    <tbody class="app-divide">
                        @foreach ($recentLogs as $log)
                            <tr>
                                <td class="px-4 py-3 text-sm app-muted">{{ $log->performed_at->format('M d, Y') }}</td>
                                <td class="px-4 py-3 text-sm" style="color: var(--white);">{{ $log->exercise->name }}</td>
                                <td class="px-4 py-3 text-sm app-muted">{{ $log->exercise->muscleGroup->name }}</td>
                                <td class="px-4 py-3 text-sm app-muted">{{ $log->sets }} x {{ $log->reps }}</td>
                                <td class="px-4 py-3 text-sm app-muted">{{ $log->weight_kg ? $log->weight_kg . ' kg' : '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
