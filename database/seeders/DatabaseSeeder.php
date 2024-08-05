<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Category::factory(8)->create();

        
        // Category::create([
        //     'cat_name' => 'Workouts'
        // ]);
        // Category::create([
        //     'cat_name' => 'Cooking'
        // ]);
        // Category::create([
        //     'cat_name' => 'Sports'
        // ]);



        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
