<?php

namespace Database\Seeders;

use App\Models\DietMeal;
use App\Models\DietPlan;
use Illuminate\Database\Seeder;

class DietPlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'plan' => [
                    'name' => 'Lean Bulk',
                    'goal' => 'bulking',
                    'description' => 'Calorie surplus with high protein for muscle growth.',
                    'daily_calories' => 2800,
                    'protein_grams' => 180,
                    'carbs_grams' => 350,
                    'fats_grams' => 80,
                ],
                'meals' => [
                    ['meal_type' => 'breakfast', 'name' => 'Oats & Eggs', 'calories' => 700,
                        'description' => 'Oats with milk, banana, 3 scrambled eggs.'],
                    ['meal_type' => 'lunch', 'name' => 'Chicken & Rice', 'calories' => 800,
                        'description' => 'Grilled chicken breast, white rice, veggies.'],
                    ['meal_type' => 'dinner', 'name' => 'Salmon & Sweet Potato', 'calories' => 750,
                        'description' => 'Baked salmon, sweet potato, broccoli.'],
                    ['meal_type' => 'snack', 'name' => 'Protein Shake & Nuts', 'calories' => 550,
                        'description' => 'Whey protein shake with almonds.'],
                ],
            ],
            [
                'plan' => [
                    'name' => 'Standard Cut',
                    'goal' => 'cutting',
                    'description' => 'Calorie deficit with high protein to preserve muscle.',
                    'daily_calories' => 1800,
                    'protein_grams' => 170,
                    'carbs_grams' => 150,
                    'fats_grams' => 55,
                ],
                'meals' => [
                    ['meal_type' => 'breakfast', 'name' => 'Egg Whites & Toast', 'calories' => 400,
                        'description' => 'Egg white omelet, whole wheat toast.'],
                    ['meal_type' => 'lunch', 'name' => 'Grilled Chicken Salad', 'calories' => 500,
                        'description' => 'Chicken breast on mixed greens, light dressing.'],
                    ['meal_type' => 'dinner', 'name' => 'White Fish & Veggies', 'calories' => 550,
                        'description' => 'Grilled white fish, asparagus, quinoa.'],
                    ['meal_type' => 'snack', 'name' => 'Greek Yogurt', 'calories' => 350,
                        'description' => 'Plain Greek yogurt with berries.'],
                ],
            ],
            [
                'plan' => [
                    'name' => 'Balanced Maintenance',
                    'goal' => 'maintenance',
                    'description' => 'Balanced macros for general fitness.',
                    'daily_calories' => 2200,
                    'protein_grams' => 140,
                    'carbs_grams' => 250,
                    'fats_grams' => 70,
                ],
                'meals' => [
                    ['meal_type' => 'breakfast', 'name' => 'Yogurt Parfait', 'calories' => 500,
                        'description' => 'Greek yogurt, granola, mixed fruit.'],
                    ['meal_type' => 'lunch', 'name' => 'Turkey Wrap', 'calories' => 600,
                        'description' => 'Whole wheat wrap with turkey, veggies, hummus.'],
                    ['meal_type' => 'dinner', 'name' => 'Stir Fry Beef', 'calories' => 700,
                        'description' => 'Lean beef with mixed veggies and brown rice.'],
                    ['meal_type' => 'snack', 'name' => 'Fruit & Peanut Butter', 'calories' => 400,
                        'description' => 'Apple slices with peanut butter.'],
                ],
            ],
        ];

        foreach ($plans as $entry) {
            $entry['plan']['slug'] = \Illuminate\Support\Str::slug($entry['plan']['name']);
            $plan = DietPlan::updateOrCreate(
                ['name' => $entry['plan']['name']],
                $entry['plan']
            );

            foreach ($entry['meals'] as $meal) {
                DietMeal::updateOrCreate(
                    [
                        'diet_plan_id' => $plan->id,
                        'meal_type' => $meal['meal_type'],
                        'name' => $meal['name'],
                    ],
                    array_merge($meal, ['diet_plan_id' => $plan->id])
                );
            }
        }
    }
}
