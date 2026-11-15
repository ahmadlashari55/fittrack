@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

@if(!$isProfileComplete)
    <!-- Profile Setup Form -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-person-badge text-primary me-2"></i> Complete Your Profile</h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted mb-4">To give you accurate suggestions, we need to know a bit about your body.</p>
                    <form action="{{ route('dashboard.profile.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Age (Years)</label>
                                <input type="number" name="age" class="form-control form-control-lg bg-light" value="{{ old('age', $user->age) }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Gender</label>
                                <select name="gender" class="form-select form-select-lg bg-light" required>
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Height (cm)</label>
                                <input type="number" step="0.1" name="height_cm" class="form-control form-control-lg bg-light" value="{{ old('height_cm', $user->height_cm) }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Current Weight (kg)</label>
                                <input type="number" step="0.1" name="current_weight_kg" class="form-control form-control-lg bg-light" value="{{ old('current_weight_kg', $user->current_weight_kg) }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Target Weight (kg)</label>
                                <input type="number" step="0.1" name="target_weight_kg" class="form-control form-control-lg bg-light" value="{{ old('target_weight_kg', $user->target_weight_kg) }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-muted">Daily Calorie Goal</label>
                                <input type="number" name="daily_calorie_goal" class="form-control form-control-lg bg-light" value="{{ old('daily_calorie_goal', $user->daily_calorie_goal ?? 2000) }}" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 mt-4 shadow-sm" style="border-radius: 10px;">Save Profile & Continue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <!-- Main Dashboard -->
    
    <!-- Stat Cards -->
    <div class="row mb-4 g-4">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 text-white h-100" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                <div class="card-body p-4 position-relative">
                    <i class="bi bi-egg-fried position-absolute top-0 end-0 p-3 fs-1 opacity-25"></i>
                    <h6 class="text-uppercase mb-1 text-white-50 fw-semibold">Calories Eaten</h6>
                    <h2 class="mb-0 fw-bold">{{ number_format($caloriesEaten, 0) }}</h2>
                    <small class="text-white-50">of {{ number_format($targetGoal, 0) }} target</small>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 text-white h-100" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                <div class="card-body p-4 position-relative">
                    <i class="bi bi-fire position-absolute top-0 end-0 p-3 fs-1 opacity-25"></i>
                    <h6 class="text-uppercase mb-1 text-white-50 fw-semibold">Calories Burned</h6>
                    <h2 class="mb-0 fw-bold">{{ number_format($caloriesBurned, 0) }}</h2>
                    <small class="text-white-50">from exercises</small>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 text-white h-100" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <div class="card-body p-4 position-relative">
                    <i class="bi bi-calculator position-absolute top-0 end-0 p-3 fs-1 opacity-25"></i>
                    <h6 class="text-uppercase mb-1 text-white-50 fw-semibold">Net Intake</h6>
                    <h2 class="mb-0 fw-bold">{{ number_format($netCalories, 0) }}</h2>
                    <small class="text-white-50">kcal today</small>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 text-white h-100" style="background: linear-gradient(135deg, #1e1e2d 0%, #374151 100%);">
                <div class="card-body p-4 position-relative">
                    <i class="bi bi-speedometer2 position-absolute top-0 end-0 p-3 fs-1 opacity-25"></i>
                    <h6 class="text-uppercase mb-1 text-white-50 fw-semibold">Current Weight</h6>
                    <h2 class="mb-0 fw-bold">{{ $user->current_weight_kg }} <span class="fs-6">kg</span></h2>
                    <small class="text-white-50">Target: {{ $user->target_weight_kg }} kg</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Chart -->
        <div class="col-12 col-lg-8">
            <div class="card border-0 h-100">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold">Today's Calorie Breakdown</h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="calorieChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Progress & Quick Actions -->
        <div class="col-12 col-lg-4">
            <div class="card border-0 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Daily Goal</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Progress</span>
                        <span class="fw-bold text-primary">{{ $progressPercent }}%</span>
                    </div>
                    <div class="progress mb-4" style="height: 10px; border-radius: 5px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: {{ $progressPercent }}%; border-radius: 5px;"></div>
                    </div>
                    
                    <a href="{{ route('food-logs.create') }}" class="btn btn-success w-100 mb-2 py-2" style="border-radius: 10px;">
                        <i class="bi bi-plus-lg"></i> Log Food
                    </a>
                    <a href="{{ route('exercise-logs.create') }}" class="btn btn-outline-primary w-100 py-2" style="border-radius: 10px;">
                        <i class="bi bi-plus-lg"></i> Log Exercise
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('calorieChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Eaten', 'Burned'],
                    datasets: [{
                        data: [{{ $caloriesEaten }}, {{ $caloriesBurned }}],
                        backgroundColor: ['#10b981', '#3b82f6'],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { usePointStyle: true, padding: 20 }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
@endif

@endsection