<?php

namespace App\Http\Controllers;

use App\Models\FoodLog;
use App\Models\ExerciseLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::today();

        // Profile complete check
        $isProfileComplete = $user->age && $user->height_cm && $user->current_weight_kg;

        if (!$isProfileComplete) {
            return view('dashboard', compact('user', 'isProfileComplete'));
        }

        // Aaj ki khai hui calories
        $foodLogs = FoodLog::with('food')->where('user_id', $user->id)->whereDate('log_date', $today)->get();
        $caloriesEaten = 0;
        foreach ($foodLogs as $log) {
            $caloriesEaten += ($log->food->calories * $log->quantity);
        }

        // Aaj ki burn hui calories
        $exerciseLogs = ExerciseLog::where('user_id', $user->id)->whereDate('log_date', $today)->get();
        $caloriesBurned = $exerciseLogs->sum('calories_burned');

        $netCalories = $caloriesEaten - $caloriesBurned;
        $targetGoal = $user->daily_calorie_goal ?? 2000;
        
        // Kitne percent goal poora hua
        $progressPercent = ($targetGoal > 0) ? min(round(($caloriesEaten / $targetGoal) * 100), 100) : 0;

        return view('dashboard', compact(
            'user', 'isProfileComplete', 'caloriesEaten', 'caloriesBurned', 'netCalories', 'targetGoal', 'progressPercent'
        ));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'age' => 'required|integer|min:10|max:100',
            'gender' => 'required|in:male,female',
            'height_cm' => 'required|numeric|min:100|max:250',
            'current_weight_kg' => 'required|numeric|min:30|max:200',
            'target_weight_kg' => 'required|numeric|min:30|max:200',
            'daily_calorie_goal' => 'required|integer|min:1000|max:5000',
        ]);

        auth()->user()->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }
}