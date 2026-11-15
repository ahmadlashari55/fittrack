@extends('layouts.admin')
@section('title', 'Smart Analyzer')
@section('content')

<div class="row mb-4">
    <!-- Calories Eaten -->
    <div class="col-md-4">
        <div class="card text-white bg-success shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <h6 class="text-uppercase mb-2">Calories Eaten</h6>
                <h1 class="display-5 fw-bold">{{ number_format($caloriesEaten, 0) }}</h1>
                <small>kcal</small>
            </div>
        </div>
    </div>

    <!-- Calories Burned -->
    <div class="col-md-4">
        <div class="card text-white bg-primary shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <h6 class="text-uppercase mb-2">Calories Burned</h6>
                <h1 class="display-5 fw-bold">{{ number_format($caloriesBurned, 0) }}</h1>
                <small>kcal</small>
            </div>
        </div>
    </div>

    <!-- Net Calories vs Goal -->
    <div class="col-md-4">
        <div class="card text-dark bg-warning shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <h6 class="text-uppercase mb-2">Net Intake (Target: {{ $targetGoal }})</h6>
                <h1 class="display-5 fw-bold">{{ number_format($netCalories, 0) }}</h1>
                <small>kcal</small>
            </div>
        </div>
    </div>
</div>

<!-- Smart Suggestions -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-dark text-white py-3">
        <h5 class="mb-0"><i class="bi bi-stars"></i> Aapke Liye Smart Suggestions</h5>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @foreach($suggestions as $suggestion)
                <li class="list-group-item d-flex align-items-start border-0 mb-2">
                    <i class="bi bi-check-circle-fill text-success me-3 fs-5"></i>
                    <span class="fs-6">{{ $suggestion }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="text-center text-muted mt-4">
    <small>Note: Yeh analyzer aapke logged data aur profile ke mutabiq suggestions de raha hai. Yeh kisi doctor ka substitute nahi hai.</small>
</div>

@endsection