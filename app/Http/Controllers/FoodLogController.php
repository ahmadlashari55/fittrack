<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\FoodLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FoodLogController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::today();

        // Aaj ke saare food logs nikalna
        $logs = FoodLog::with('food')
            ->where('user_id', $user->id)
            ->whereDate('log_date', $today)
            ->latest()
            ->get();

        // Total calories calculate karna
        $totalCalories = 0;
        foreach ($logs as $log) {
            $totalCalories += ($log->food->calories * $log->quantity);
        }

        return view('food-logs.index', compact('logs', 'totalCalories', 'user'));
    }

    public function create()
    {
        // Saara khana list mein dikhane ke liye
        $foods = Food::orderBy('name')->get();
        return view('food-logs.create', compact('foods'));
    }

        public function store(Request $request)
    {
        $request->validate([
            'food_id' => 'required|array', // Array validate kar rahe hain
            'food_id.*' => 'exists:foods,id',
            'quantity' => 'required|array',
            'quantity.*' => 'numeric|min:0.1',
            'meal_type' => 'required|in:breakfast,lunch,dinner,snack',
            'log_date' => 'required|date'
        ]);

        // Loop chala kar ek sath multiple food items save karenge
        foreach ($request->food_id as $index => $foodId) {
            FoodLog::create([
                'user_id' => auth()->id(),
                'food_id' => $foodId,
                'quantity' => $request->quantity[$index],
                'meal_type' => $request->meal_type,
                'log_date' => $request->log_date,
            ]);
        }

        return redirect()->route('food-logs.index')->with('success', 'All food items logged successfully!');
    }

    public function destroy(FoodLog $foodLog)
    {
        // Security check: Sirf apna log delete kar sake
        if ($foodLog->user_id !== auth()->id()) {
            abort(403);
        }

        $foodLog->delete();
        return redirect()->route('food-logs.index')->with('success', 'Food log deleted.');
    }
}