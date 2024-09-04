<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_authorized_user_can_open_category_page(): void
    {
        Category::create([
            'cat_name' => 'Cooking',
            'description' => 'This is cooking category',
            'image' => 'image.jpg',
        ]);

        Video::create([
            'title' => '1. video',
            'description' => 'This is 1st video',
            'video_file' => 'image.mp4',
            
        ]);
        $user = User::factory()->create();
 
        $response = $this->actingAs($user)->get('/categories/Cooking');

        $response->assertStatus(200);
    }

    public function test_unauthorized_user_can_open_category_page(): void
    {
        Category::create([
            'cat_name' => 'Cooking',
            'description' => 'This is cooking category',
            'image' => 'image.jpg',
        ]);
        $response = $this->get('/categories/Cooking');

        $response->assertStatus(200);
    }

    public function test_can_create_category(): void
    {
        $user = User::factory()->create();

        $response = $this->post('categories',[
            'title' => 'Test title',
            'description'=> 'Test desscr',
            'image_file' => 'dasasd.jpg',
        ]);

        $response->assertStatus(302);
    }
}
