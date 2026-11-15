@extends('layouts.admin')
@section('title', 'Add Food Log')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">Log What You Ate</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('food-logs.store') }}" method="POST">
                    @csrf
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Meal Type <span class="text-danger">*</span></label>
                            <select name="meal_type" class="form-select form-select-lg bg-light" required>
                                <option value="breakfast">Breakfast (Nashta)</option>
                                <option value="lunch">Lunch (Dopahar)</option>
                                <option value="dinner">Dinner (Raat)</option>
                                <option value="snack">Snack</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Date <span class="text-danger">*</span></label>
                            <input type="date" name="log_date" class="form-control form-control-lg bg-light" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>

                    <hr>

                    <div id="foodItemsContainer">
                        <!-- Pehla Row (By Default) -->
                        <div class="row food-row mb-3 align-items-end">
                            <div class="col-md-6">
                                <label class="form-label">Select Food <span class="text-danger">*</span></label>
                                <select name="food_id[]" class="form-select" required>
                                    <option value="">-- Choose Food --</option>
                                    @foreach($foods as $food)
                                        <option value="{{ $food->id }}">
                                            {{ $food->name }} ({{ $food->calories }} kcal per {{ $food->unit }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Quantity <span class="text-danger">*</span></label>
                                <input type="number" step="0.1" name="quantity[]" class="form-control" value="1" required>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger w-100 remove-row" disabled><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button type="button" class="btn btn-outline-success" id="addMoreBtn">
                            <i class="bi bi-plus-circle"></i> Add Another Food Item
                        </button>
                    </div>

                    <hr>
                    
                    <button type="submit" class="btn btn-success btn-lg w-100">Save All Food Logs</button>
                    <a href="{{ route('food-logs.index') }}" class="btn btn-light w-100 mt-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('foodItemsContainer');
        const addBtn = document.getElementById('addMoreBtn');

        // Nayi row add karne ka function
        addBtn.addEventListener('click', function() {
            const newRow = document.createElement('div');
            newRow.className = 'row food-row mb-3 align-items-end';
            
            newRow.innerHTML = `
                <div class="col-md-6">
                    <label class="form-label">Select Food <span class="text-danger">*</span></label>
                    <select name="food_id[]" class="form-select" required>
                        <option value="">-- Choose Food --</option>
                        @foreach($foods as $food)
                            <option value="{{ $food->id }}">
                                {{ $food->name }} ({{ $food->calories }} kcal per {{ $food->unit }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Quantity <span class="text-danger">*</span></label>
                    <input type="number" step="0.1" name="quantity[]" class="form-control" value="1" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger w-100 remove-btn"><i class="bi bi-x-lg"></i></button>
                </div>
            `;
            
            container.appendChild(newRow);
            updateRemoveButtons();
        });

        // Row remove karne ka function
        container.addEventListener('click', function(e) {
            if (e.target.closest('.remove-btn')) {
                e.target.closest('.food-row').remove();
                updateRemoveButtons();
            }
        });

        // Agar sirf ek row bachi ho toh remove button disable kar dein
        function updateRemoveButtons() {
            const rows = container.querySelectorAll('.food-row');
            rows.forEach((row, index) => {
                const btn = row.querySelector('.remove-btn');
                if (rows.length === 1) {
                    if(btn) btn.disabled = true;
                } else {
                    if(btn) btn.disabled = false;
                }
            });
        }
    });
</script>
@endpush