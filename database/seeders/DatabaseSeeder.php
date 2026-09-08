<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $users = [
            ['name' => 'Test User',  'email' => 'test@example.com',  'role' => 'registered', 'password' => 'password'],
            ['name' => 'Coach Mike', 'email' => 'trainer@example.com','role' => 'trainer',    'password' => 'password'],
            ['name' => 'Admin Anna', 'email' => 'admin@example.com',  'role' => 'admin',      'password' => 'password'],
        ];

        foreach ($users as $u) {
            User::updateOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'role' => $u['role'],
                    'password' => Hash::make($u['password']),
                ]
            );
        }

        $this->call([
            MuscleGroupSeeder::class,
            ExerciseSeeder::class,
            DietPlanSeeder::class,
            NutritionFoodSeeder::class,
        ]);
    }
}
