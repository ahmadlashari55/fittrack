<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'age', 'gender', 'height_cm', 
        'current_weight_kg', 'target_weight_kg', 'daily_calorie_goal',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function foodLogs()
    {
        return $this->hasMany(FoodLog::class);
    }

    public function exerciseLogs()
    {
        return $this->hasMany(ExerciseLog::class);
    }
}