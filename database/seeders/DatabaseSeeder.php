<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Video;
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
        //Category::factory(8)->create();

        
        Video::create([
            'title' => 'BE FIT',
            'video_file' => 'videos/Vy9U4iQQYjoUIzXMAcPF7uLGe5BHBzyJEmaKBgmE.mp4',
            'description' => 'Watch this to be fit'
        ]);

        Video::create([
            'title' => 'BE A GOOD COOK',
            'video_file' => 'videos/Vy9U4iQQYjoUIzXMAcPF7uLGe5BHBzyJEmaKBgmE.mp4',
            'description' => 'Watch this to be a good cook'
        ]);

        Category::create([
             'cat_name' => 'Workouts',
             'description' => 'Try this to be in your dream shape',
        ]);
         Category::create([
             'cat_name' => 'Cooking',
             'description' => 'Try this to make the best meals',
        ]);
         Category::create([
             'cat_name' => 'Sports',
             'description' => 'Try this to be a star on the pitch',
        ]);



        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
