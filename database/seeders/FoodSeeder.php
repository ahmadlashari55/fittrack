<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    public function run(): void
    {
        $foods = [
            // --- Nashta (Breakfast) ---
            ['name' => 'Paratha', 'unit' => '1 piece', 'calories' => 250, 'protein' => 4, 'carbs' => 30, 'fats' => 12],
            ['name' => 'Omelet (Anda)', 'unit' => '1 egg', 'calories' => 90, 'protein' => 6, 'carbs' => 1, 'fats' => 7],
            ['name' => 'Channay (Boiled)', 'unit' => '1 bowl', 'calories' => 160, 'protein' => 8, 'carbs' => 27, 'fats' => 3],
            ['name' => 'Halwa Puri', 'unit' => '1 plate', 'calories' => 450, 'protein' => 6, 'carbs' => 55, 'fats' => 25],
            ['name' => 'Anda Paratha', 'unit' => '1 piece', 'calories' => 350, 'protein' => 10, 'carbs' => 32, 'fats' => 20],
            ['name' => 'Toast (Brown Bread)', 'unit' => '1 slice', 'calories' => 70, 'protein' => 3, 'carbs' => 12, 'fats' => 1],
            ['name' => 'Cornflakes with Milk', 'unit' => '1 bowl', 'calories' => 150, 'protein' => 4, 'carbs' => 30, 'fats' => 2],
            ['name' => 'Oats (Daliya)', 'unit' => '1 bowl', 'calories' => 120, 'protein' => 5, 'carbs' => 20, 'fats' => 2],
            ['name' => 'Lassi (Sweet)', 'unit' => '1 glass', 'calories' => 180, 'protein' => 6, 'carbs' => 20, 'fats' => 8],
            
            // --- Lunch / Dinner (Main Course) ---
            ['name' => 'Roti (Wheat)', 'unit' => '1 piece', 'calories' => 120, 'protein' => 3, 'carbs' => 25, 'fats' => 1],
            ['name' => 'Daal (Cooked)', 'unit' => '1 bowl', 'calories' => 180, 'protein' => 9, 'carbs' => 30, 'fats' => 2],
            ['name' => 'Chicken Karahi', 'unit' => '1 plate', 'calories' => 350, 'protein' => 25, 'carbs' => 5, 'fats' => 25],
            ['name' => 'Chicken Biryani', 'unit' => '1 plate', 'calories' => 400, 'protein' => 15, 'carbs' => 50, 'fats' => 15],
            ['name' => 'Beef Pulao', 'unit' => '1 plate', 'calories' => 450, 'protein' => 20, 'carbs' => 55, 'fats' => 18],
            ['name' => 'White Rice (Boiled)', 'unit' => '1 bowl', 'calories' => 200, 'protein' => 4, 'carbs' => 45, 'fats' => 0],
            ['name' => 'Aloo Gosht', 'unit' => '1 plate', 'calories' => 380, 'protein' => 22, 'carbs' => 20, 'fats' => 24],
            ['name' => 'Vegetable Sabzi', 'unit' => '1 bowl', 'calories' => 120, 'protein' => 3, 'carbs' => 15, 'fats' => 5],
            ['name' => 'Chicken Tikka', 'unit' => '1 piece', 'calories' => 220, 'protein' => 25, 'carbs' => 2, 'fats' => 12],
            ['name' => 'Nihari', 'unit' => '1 plate', 'calories' => 500, 'protein' => 30, 'carbs' => 10, 'fats' => 40],
            ['name' => 'Haleem', 'unit' => '1 bowl', 'calories' => 300, 'protein' => 15, 'carbs' => 35, 'fats' => 12],
            ['name' => 'Chana Chaat', 'unit' => '1 bowl', 'calories' => 200, 'protein' => 8, 'carbs' => 30, 'fats' => 5],
            ['name' => 'Beef Burger', 'unit' => '1 piece', 'calories' => 450, 'protein' => 20, 'carbs' => 40, 'fats' => 25],
            ['name' => 'Pizza (Chicken Fajita)', 'unit' => '1 slice', 'calories' => 280, 'protein' => 12, 'carbs' => 30, 'fats' => 12],
            ['name' => 'Zinger Burger', 'unit' => '1 piece', 'calories' => 500, 'protein' => 25, 'carbs' => 45, 'fats' => 25],
            ['name' => 'French Fries', 'unit' => '1 small', 'calories' => 300, 'protein' => 3, 'carbs' => 40, 'fats' => 15],
            
            // --- Snacks & Drinks ---
            ['name' => 'Chai (With Sugar)', 'unit' => '1 cup', 'calories' => 80, 'protein' => 2, 'carbs' => 12, 'fats' => 3],
            ['name' => 'Chai (Without Sugar)', 'unit' => '1 cup', 'calories' => 30, 'protein' => 2, 'carbs' => 2, 'fats' => 3],
            ['name' => 'Green Tea', 'unit' => '1 cup', 'calories' => 2, 'protein' => 0, 'carbs' => 0, 'fats' => 0],
            ['name' => 'Coffee (With Milk)', 'unit' => '1 cup', 'calories' => 100, 'protein' => 3, 'carbs' => 15, 'fats' => 4],
            ['name' => 'Samosa', 'unit' => '1 piece', 'calories' => 150, 'protein' => 3, 'carbs' => 18, 'fats' => 8],
            ['name' => 'Pakora', 'unit' => '1 piece', 'calories' => 70, 'protein' => 2, 'carbs' => 6, 'fats' => 4],
            ['name' => 'Coca Cola / Pepsi', 'unit' => '1 glass', 'calories' => 100, 'protein' => 0, 'carbs' => 25, 'fats' => 0],
            ['name' => 'Water', 'unit' => '1 glass', 'calories' => 0, 'protein' => 0, 'carbs' => 0, 'fats' => 0],
            ['name' => 'Fresh Juice (Orange)', 'unit' => '1 glass', 'calories' => 110, 'protein' => 2, 'carbs' => 26, 'fats' => 0],
            ['name' => 'Biscuits (Sooper)', 'unit' => '4 pieces', 'calories' => 150, 'protein' => 2, 'carbs' => 20, 'fats' => 7],
            
            // --- Fruits & Nuts ---
            ['name' => 'Banana', 'unit' => '1 medium', 'calories' => 105, 'protein' => 1, 'carbs' => 27, 'fats' => 0],
            ['name' => 'Apple', 'unit' => '1 medium', 'calories' => 95, 'protein' => 0, 'carbs' => 25, 'fats' => 0],
            ['name' => 'Mango', 'unit' => '1 medium', 'calories' => 150, 'protein' => 1, 'carbs' => 38, 'fats' => 1],
            ['name' => 'Orange', 'unit' => '1 medium', 'calories' => 62, 'protein' => 1, 'carbs' => 15, 'fats' => 0],
            ['name' => 'Dates (Khajoor)', 'unit' => '2 pieces', 'calories' => 55, 'protein' => 0, 'carbs' => 15, 'fats' => 0],
            ['name' => 'Almonds (Badam)', 'unit' => '10 pieces', 'calories' => 70, 'protein' => 3, 'carbs' => 3, 'fats' => 6],
            ['name' => 'Egg (Boiled)', 'unit' => '1 piece', 'calories' => 78, 'protein' => 6, 'carbs' => 1, 'fats' => 5],
        ];

        foreach ($foods as $food) {
            Food::create([
                'name' => $food['name'],
                'unit' => $food['unit'],
                'calories' => $food['calories'],
                'protein_g' => $food['protein'],
                'carbs_g' => $food['carbs'],
                'fats_g' => $food['fats'],
            ]);
        }
    }
}