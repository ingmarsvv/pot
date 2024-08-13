<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function filterCategory($id){
        // Fetch the category by ID
        $category = Category::findOrFail($id);

        // Fetch videos associated with the category
        $videos = $category->videos()->get();

        return view('videos.index', [
            'categories' => Category::all(),
            'videos' => $videos,
        ]);
    }
}
