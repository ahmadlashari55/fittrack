<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    // YEH LINE ADD KAREIN
    protected $table = 'foods'; 

    protected $fillable = ['name', 'unit', 'calories', 'protein_g', 'carbs_g', 'fats_g'];

    public function logs()
    {
        return $this->hasMany(FoodLog::class);
    }
}