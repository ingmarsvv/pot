<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{   
    //show create form
    public function create(Request $request){
        if ($request->user()->cannot('create', Category::class)){
            abort(403);
        }
        return view('categories.create');
    }
    //store category
    //save video
    public function store(Request $request){
        if ($request->user()->cannot('create', Category::class)){
            abort(403);
        }
        $fields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image_file' => 'required|image',
        ]);
        //dd($request->all());
        if ($request->hasFile('image_file')) {
            $imagePath = $request->image_file->store('images', 'local');
        }

        $data = [
            'cat_name' => $fields['title'],
            'description' => $fields['description'],
            'image' => $imagePath ?? "",
        ];
    
        Category::create($data);
        return redirect('/admin');
    }

    public function filterCategory($cat_name){
        $category = Category::where('cat_name', $cat_name)->firstOrFail();
        $videos = $category->videos()->get();
        // if (Gate::denies('check-subscription', $category->id)){
        //     session()->flash('Warning', 'Jūs kategoriju "' . $category->cat_name. '" neesat abonējis. Lai aplūkotu tās saturu, lūdzu, abonējiet kategoriju!!');
        //     return to_route('subscription.index');
        // }
        return view('videos.categoryFilter', [
            'category' => $category,
            'videos' => $videos,
        ]);
    }

    // public function destroy(Request $request, Video $video){
    //     if ($request->user()->cannot('delete', Video::class)){
    //         abort(403);
    //     }
    //     $video->delete();
    //     $video->categories()->detach();
    //     Storage::delete($video->video_file);
    //     return redirect('/admin');
    // }

    public function destroy(Category $category){
        $category->delete();
        Storage::delete($category->image);
        return redirect('/admin');
    }


}
