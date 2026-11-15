@extends('layouts.admin')
@section('title', 'Add Exercise')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Log Your Exercise</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('exercise-logs.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Select Exercise <span class="text-danger">*</span></label>
                        <select name="exercise_id" id="exerciseSelect" class="form-select" required>
                            <option value="">-- Choose Exercise --</option>
                            @foreach($exercises as $ex)
                                <option value="{{ $ex->id }}" data-met="{{ $ex->met_value }}" {{ old('exercise_id') == $ex->id ? 'selected' : '' }}>
                                    {{ $ex->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Duration (Minutes) <span class="text-danger">*</span></label>
                            <input type="number" name="duration_minutes" id="durationInput" class="form-control" value="{{ old('duration_minutes', 30) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Estimated Calories Burned</label>
                            <input type="text" id="caloriesPreview" class="form-control bg-light fw-bold text-primary" value="0 kcal" readonly>
                            <small class="text-muted">Auto-calculated based on your weight ({{ auth()->user()->current_weight_kg ?? 70 }} kg)</small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Date <span class="text-danger">*</span></label>
                            <input type="date" name="log_date" class="form-control" value="{{ old('log_date', date('Y-m-d')) }}" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 mt-3">Save Exercise</button>
                    <a href="{{ route('exercise-logs.index') }}" class="btn btn-secondary w-100 mt-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userWeight = {{ auth()->user()->current_weight_kg ?? 70 }};
        const exerciseSelect = document.getElementById('exerciseSelect');
        const durationInput = document.getElementById('durationInput');
        const caloriesPreview = document.getElementById('caloriesPreview');

        function calculateCalories() {
            const selectedOption = exerciseSelect.options[exerciseSelect.selectedIndex];
            const met = selectedOption.getAttribute('data-met');
            const duration = parseFloat(durationInput.value) || 0;

            if (met && duration > 0) {
                const hours = duration / 60;
                const calories = Math.round(met * userWeight * hours);
                caloriesPreview.value = calories + ' kcal';
            } else {
                caloriesPreview.value = '0 kcal';
            }
        }

        exerciseSelect.addEventListener('change', calculateCalories);
        durationInput.addEventListener('input', calculateCalories);
        
        // Initial calculation on page load
        calculateCalories();
    });
</script>
@endpush