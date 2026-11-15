<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\ExerciseLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExerciseLogController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::today();

        $logs = ExerciseLog::with('exercise')
            ->where('user_id', $user->id)
            ->whereDate('log_date', $today)
            ->latest()
            ->get();

        $totalBurned = $logs->sum('calories_burned');

        return view('exercise-logs.index', compact('logs', 'totalBurned'));
    }

    public function create()
    {
        $exercises = Exercise::orderBy('name')->get();
        return view('exercise-logs.create', compact('exercises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'exercise_id' => 'required|exists:exercises,id',
            'duration_minutes' => 'required|integer|min:1',
            'log_date' => 'required|date'
        ]);

        $exercise = Exercise::findOrFail($request->exercise_id);
        $userWeight = auth()->user()->current_weight_kg ?? 70; // Default 70kg

        // MET Formula: Calories = MET * Weight(kg) * Time(hours)
        $durationHours = $request->duration_minutes / 60;
        $caloriesBurned = round($exercise->met_value * $userWeight * $durationHours);

        ExerciseLog::create([
            'user_id' => auth()->id(),
            'exercise_id' => $request->exercise_id,
            'duration_minutes' => $request->duration_minutes,
            'calories_burned' => $caloriesBurned,
            'log_date' => $request->log_date,
        ]);

        return redirect()->route('exercise-logs.index')->with('success', 'Exercise logged! You burned ' . $caloriesBurned . ' kcal.');
    }

    public function destroy(ExerciseLog $exerciseLog)
    {
        if ($exerciseLog->user_id !== auth()->id()) {
            abort(403);
        }

        $exerciseLog->delete();
        return redirect()->route('exercise-logs.index')->with('success', 'Exercise log deleted.');
    }
}