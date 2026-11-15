@extends('layouts.admin')
@section('title', 'Exercise Log')
@section('content')

<div class="row mb-4">
    <div class="col-md-12">
        <div class="card bg-primary text-white shadow-sm border-0">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Calories Burned Today</h5>
                    <h2 class="mb-0">{{ number_format($totalBurned, 0) }} kcal</h2>
                </div>
                <a href="{{ route('exercise-logs.create') }}" class="btn btn-light btn-lg text-primary fw-bold">
                    <i class="bi bi-plus-lg"></i> Add Exercise
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Today's Exercises</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Exercise</th>
                    <th>Duration</th>
                    <th>Calories Burned</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td class="fw-bold">{{ $log->exercise->name }}</td>
                    <td>{{ $log->duration_minutes }} mins</td>
                    <td class="fw-bold text-primary">{{ $log->calories_burned }} kcal</td>
                    <td class="text-end">
                        <form action="{{ route('exercise-logs.destroy', $log->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this entry?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-4 text-muted">Aaj aapne koi exercise nahi ki.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection