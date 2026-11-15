@extends('layouts.admin')
@section('title', 'Food Log')
@section('content')

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card bg-success text-white shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Today's Calorie Intake</h5>
                    <h2 class="mb-0">{{ number_format($totalCalories, 0) }} / {{ $user->daily_calorie_goal }} kcal</h2>
                </div>
                <a href="{{ route('food-logs.create') }}" class="btn btn-light btn-lg text-success fw-bold">
                    <i class="bi bi-plus-lg"></i> Add Food
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Today's Food History</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Meal</th>
                    <th>Food Item</th>
                    <th>Quantity</th>
                    <th>Calories</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td class="text-capitalize">
                        @if($log->meal_type == 'breakfast') <span class="badge bg-warning text-dark">Breakfast</span>
                        @elseif($log->meal_type == 'lunch') <span class="badge bg-info text-dark">Lunch</span>
                        @elseif($log->meal_type == 'dinner') <span class="badge bg-primary">Dinner</span>
                        @else <span class="badge bg-secondary">Snack</span> @endif
                    </td>
                    <td>{{ $log->food->name }}</td>
                    <td>{{ $log->quantity }} x ({{ $log->food->unit }})</td>
                    <td class="fw-bold text-success">{{ $log->food->calories * $log->quantity }} kcal</td>
                    <td class="text-end">
                        <form action="{{ route('food-logs.destroy', $log->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this entry?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-4 text-muted">Aaj aapne abhi tak kuch log nahi kiya.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection