<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class VideoController extends Controller
{
    //show all videos
    public function index(){
        return view('videos.index', [
            'videos' => Video::all(),

        ]);
    }
    //show single video
    public function show(Video $video){
        return view('videos.show', compact('video'));
    }
    //show create form
    public function create(){
        $categories = Category::all();
         return view('videos.create', compact('categories'));
    }

    public function store(Request $request){
        $fields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'video_file' => 'required',
            'categories' => 'required',
        ]);
        //dd($request->all());
        if ($request->hasFile('video_file')) {
            echo "There is a file";
            //dd($request->all());
            $videoPath = $request->video_file->store('videos', 'local');
        }

        $data = [
            'title' => $fields['title'],
            'description' => $fields['description'],
            'video_file' => $videoPath ?? "",
            'categories' => $fields['categories']
        ];
    
        $video = Video::create($data);
        $video->categories()->attach($fields['categories']);
        return redirect('/');
    }

    public function serve($fileName){
        $exists = Storage::disk('local')->exists('videos/'.$fileName);
        if($exists) {
      
            //get content of image
            $content = Storage::get('videos/'.$fileName);
            
            //get mime type of image
            $mime = Storage::mimeType('videos/'.$fileName);      //prepare response with image content and response code
            $response = Response::make($content, 200);      //set header 
            $response->header("Content-Type", $mime);      // return response
            return $response;
         } else {
            abort(404);
         }
    }
    
}
