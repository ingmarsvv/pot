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
            'categories' => Category::all(),

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
    //save video
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
    // to display video
    public function serve($fileName){
        // 
        // if($exists) {
      
        //     //get content of image
        //     $content = Storage::get('videos/'.$fileName);
            
        //     //get mime type of image
        //     $mime = Storage::mimeType('videos/'.$fileName);      //prepare response with image content and response code
        //     $response = Response::make($content, 200);      //set header 
        //     $response->header("Content-Type", $mime);      // return response
        //     return $response;
        //  } else {
        //     abort(404);
        //  }

    $exists = Storage::disk('local')->exists('videos/'.$fileName);
    $filePath = storage_path('app/videos/'.$fileName);
    if (!$exists) {
        abort(404);
    }
    $fileSize = filesize($filePath);
    $mime = mime_content_type($filePath);
    $headers = [
        'Content-Type' => $mime,
        'Content-Length' => $fileSize,
        'Accept-Ranges' => 'bytes',
    ];
    $start = 0;
    $length = $fileSize;
    $status = 200;
    if (isset($_SERVER['HTTP_RANGE'])) {
        $range = $_SERVER['HTTP_RANGE'];
        list($param, $range) = explode('=', $range);
        if (strtolower(trim($param)) === 'bytes') {
            $ranges = explode('-', $range);
            $start = intval($ranges[0]);
            $end = isset($ranges[1]) && is_numeric($ranges[1]) ? intval($ranges[1]) : $fileSize - 1;
            $length = $end - $start + 1;
            $status = 206;  // Partial content status code
            $headers['Content-Range'] = "bytes $start-$end/$fileSize";
            $headers['Content-Length'] = $length;
        }
    }
    $file = fopen($filePath, 'rb');
    fseek($file, $start);
    $content = fread($file, $length);
    fclose($file);
    return response($content, $status, $headers);
    }

    //delete video
    public function destroy(Video $video){
        $video->delete();
        $video->categories()->detach();
        return redirect('/');
    }
    
}
