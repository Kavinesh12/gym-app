<?php

namespace Database\Seeders;

use App\Models\NutritionFood;
use Illuminate\Database\Seeder;

class NutritionFoodSeeder extends Seeder
{
    public function run(): void
    {
        // Approximate values per 100g of edible food. Values can vary by brand,
        // cooking method and preparation, so they are intended as a guide.
        $foods = [
            ['name' => 'Chicken Breast (cooked)', 'protein_grams' => 31.00, 'carbs_grams' => 0.00, 'fibre_grams' => 0.00, 'calories' => 165],
            ['name' => 'Tuna (canned in water)', 'protein_grams' => 26.00, 'carbs_grams' => 0.00, 'fibre_grams' => 0.00, 'calories' => 116],
            ['name' => 'Soy Chunks (dry)', 'protein_grams' => 52.00, 'carbs_grams' => 33.00, 'fibre_grams' => 13.00, 'calories' => 345],
            ['name' => 'Paneer', 'protein_grams' => 18.00, 'carbs_grams' => 3.50, 'fibre_grams' => 0.00, 'calories' => 265],
            ['name' => 'Tofu', 'protein_grams' => 8.00, 'carbs_grams' => 2.00, 'fibre_grams' => 0.90, 'calories' => 76],
            ['name' => 'Eggs (whole)', 'protein_grams' => 12.60, 'carbs_grams' => 1.10, 'fibre_grams' => 0.00, 'calories' => 143],
            ['name' => 'Greek Yogurt', 'protein_grams' => 10.00, 'carbs_grams' => 3.60, 'fibre_grams' => 0.00, 'calories' => 73],
            ['name' => 'Lentils (cooked)', 'protein_grams' => 9.00, 'carbs_grams' => 20.00, 'fibre_grams' => 7.90, 'calories' => 116],
            ['name' => 'Chickpeas (cooked)', 'protein_grams' => 8.90, 'carbs_grams' => 27.40, 'fibre_grams' => 7.60, 'calories' => 164],
            ['name' => 'Black Beans (cooked)', 'protein_grams' => 8.90, 'carbs_grams' => 23.70, 'fibre_grams' => 8.70, 'calories' => 132],
            ['name' => 'Oats (dry)', 'protein_grams' => 13.20, 'carbs_grams' => 67.70, 'fibre_grams' => 10.10, 'calories' => 389],
            ['name' => 'Quinoa (cooked)', 'protein_grams' => 4.40, 'carbs_grams' => 21.30, 'fibre_grams' => 2.80, 'calories' => 120],
            ['name' => 'Brown Rice (cooked)', 'protein_grams' => 2.60, 'carbs_grams' => 23.00, 'fibre_grams' => 1.80, 'calories' => 123],
            ['name' => 'Sweet Potato (cooked)', 'protein_grams' => 1.60, 'carbs_grams' => 20.70, 'fibre_grams' => 3.30, 'calories' => 90],
            ['name' => 'Potato (boiled)', 'protein_grams' => 1.90, 'carbs_grams' => 20.10, 'fibre_grams' => 1.80, 'calories' => 87],
            ['name' => 'Banana', 'protein_grams' => 1.10, 'carbs_grams' => 22.80, 'fibre_grams' => 2.60, 'calories' => 89],
            ['name' => 'Apple', 'protein_grams' => 0.30, 'carbs_grams' => 13.80, 'fibre_grams' => 2.40, 'calories' => 52],
            ['name' => 'Guava', 'protein_grams' => 2.60, 'carbs_grams' => 14.30, 'fibre_grams' => 5.40, 'calories' => 68],
            ['name' => 'Pear', 'protein_grams' => 0.40, 'carbs_grams' => 15.20, 'fibre_grams' => 3.10, 'calories' => 57],
            ['name' => 'Broccoli', 'protein_grams' => 2.80, 'carbs_grams' => 6.60, 'fibre_grams' => 2.60, 'calories' => 34],
            ['name' => 'Spinach', 'protein_grams' => 2.90, 'carbs_grams' => 3.60, 'fibre_grams' => 2.20, 'calories' => 23],
            ['name' => 'Carrot', 'protein_grams' => 0.90, 'carbs_grams' => 9.60, 'fibre_grams' => 2.80, 'calories' => 41],
            ['name' => 'Avocado', 'protein_grams' => 2.00, 'carbs_grams' => 8.50, 'fibre_grams' => 6.70, 'calories' => 160],
            ['name' => 'Chia Seeds', 'protein_grams' => 16.50, 'carbs_grams' => 42.10, 'fibre_grams' => 34.40, 'calories' => 486],
            ['name' => 'Flax Seeds', 'protein_grams' => 18.30, 'carbs_grams' => 28.90, 'fibre_grams' => 27.30, 'calories' => 534],
            ['name' => 'Almonds', 'protein_grams' => 21.20, 'carbs_grams' => 21.70, 'fibre_grams' => 12.50, 'calories' => 579],
            ['name' => 'Peanuts', 'protein_grams' => 25.80, 'carbs_grams' => 16.10, 'fibre_grams' => 8.50, 'calories' => 567],
            ['name' => 'Pumpkin Seeds', 'protein_grams' => 30.20, 'carbs_grams' => 10.70, 'fibre_grams' => 6.00, 'calories' => 559],
        ];

        foreach ($foods as $food) {
            NutritionFood::updateOrCreate(
                ['name' => $food['name']],
                $food
            );
        }
    }
}
