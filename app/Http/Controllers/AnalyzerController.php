<?php

namespace App\Http\Controllers;

use App\Models\FoodLog;
use App\Models\ExerciseLog;
use Carbon\Carbon;

class AnalyzerController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::today();

        // Khai hui calories
        $foodLogs = FoodLog::with('food')->where('user_id', $user->id)->whereDate('log_date', $today)->get();
        $caloriesEaten = 0;
        foreach ($foodLogs as $log) {
            $caloriesEaten += ($log->food->calories * $log->quantity);
        }

        // Burn hui calories
        $exerciseLogs = ExerciseLog::where('user_id', $user->id)->whereDate('log_date', $today)->get();
        $caloriesBurned = $exerciseLogs->sum('calories_burned');

        $targetGoal = $user->daily_calorie_goal ?? 2000;
        $netCalories = $caloriesEaten - $caloriesBurned;
        $weightGoal = $user->current_weight_kg - $user->target_weight_kg;

        $suggestions = [];

        if ($caloriesEaten == 0) {
            $suggestions[] = "Aapne aaj abhi tak kuch nahi khaya. Nashta na choren, din ki shuruwat healthy nashty se karein.";
        } elseif ($netCalories > $targetGoal) {
            $suggestions[] = "Aapne aaj apne target se zyada calories khai hain. Aaj raat ko halka khana khayen aur 30 minute tez chal kar calories burn karein.";
        } elseif ($netCalories < ($targetGoal - 500)) {
            $suggestions[] = "Aapne aaj bohat kam calories khai hain. Aapko apni body ko energy chahiye, thora protein (jaise anda, daal) aur carbs khayen.";
        } else {
            $suggestions[] = "Aaj aapka calorie intake bilkul target ke mutabiq hai. Aap sahi track par hain!";
        }

        if ($weightGoal > 0) { 
            $suggestions[] = "Aapka goal weight kam karna hai. Sugary drinks (Pepsi, Chai with sugar) avoid karein aur Parathay ki jagah Oats ya Boiled Anday khayen.";
            $suggestions[] = "Rozana kam az kam 40 minute walk ya running karein.";
        } elseif ($weightGoal < 0) { 
            $suggestions[] = "Aapka goal weight barhana hai. Apni diet mein healthy fats (badam, akhrot) aur protein (chicken, daal) shamil karein.";
            $suggestions[] = "Heavy weight training (Gym) par focus karein, taake muscle mass barhe.";
        } else {
            $suggestions[] = "Aapka weight aapke goal ke barabar hai. Ab apni fitness maintain karne ke liye daily walk aur healthy diet jari rakhein.";
        }

        return view('analyzer.index', compact(
            'caloriesEaten', 'caloriesBurned', 'netCalories', 'targetGoal', 'suggestions'
        ));
    }
}