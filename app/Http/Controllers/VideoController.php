<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class VideoController extends Controller
{
    //show all videos
    public function index(){
        return view('videos.index', [
            // 'videos' => Video::all(),
            'categories' => Category::all(),

        ]);
    }
    public function admin(){
        if (Gate::denies('check-admin')){
            abort(403);
        }
        $categories = Category::all();
        if(request('category')){
            $videos = Video::latest()->filterByCategory(request('category'))->get();
        } else {
            $videos = Video::all();
        }
        return view('videos.admin', [
            'videos' => $videos,
            'categories' => $categories,
        ]);
    }

    //show single video
    public function show(Video $video, $categoryID){

        if (Gate::denies('check-subscription', $categoryID )){
            abort(403);
        }
        $comments = CommentController::serve($video);
        return view('videos.show', compact('video', 'comments'));
    }
    //show create form
    public function create(Request $request){
        if ($request->user()->cannot('create', Video::class)){
            abort(403);
        }
        $categories = Category::all();
        return view('videos.create', compact('categories'));
    }
    //save video
    public function store(Request $request){
        if ($request->user()->cannot('create', Video::class)){
            abort(403);
        }
        $fields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'video_file' => 'required',
            'categories' => 'required',
        ]);
        //dd($request->all());
        if ($request->hasFile('video_file')) {
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
        return redirect('/admin');
    }
    // to display video
    public function serve($fileName){
        
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
    public function destroy(Request $request, Video $video){
        if ($request->user()->cannot('delete', Video::class)){
            abort(403);
        }
        $video->delete();
        $video->categories()->detach();
        Storage::delete($video->video_file);
        return redirect('/admin');
    }

    //show edit form
    
    public function edit(Request $request, Video $video){
        if ($request->user()->cannot('update', Video::class)){
            abort(403);
        }
        return view('videos.edit',[
            'belongToCategories' => $video->categories()->get(),
            'categories' => Category::all(),
            'video' => $video,
        ]);
    }
    //update video
    public function update(Request $request, Video $video){
        if ($request->user()->cannot('update', Video::class)){
            abort(403);
        }
        $fields = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        //dd($request->all());
        if ($request->hasFile('video_file')) {
            $videoPath = $request->video_file->store('videos', 'local');
        }

        $data = [
            'title' => $fields['title'],
            'description' => $fields['description'],
            'video_file' => $videoPath ?? $video->video_file,
            'categories' => $request["categories"],
        ];
    
        $video->update($data);
        $video->categories()->sync($data['categories']);
        return redirect('/admin');
    }
    
}
