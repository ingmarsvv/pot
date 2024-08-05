<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    //
    public function index(){
        return view('videos.index', [
            'videos' => Video::all(),
        ]);
    }

    public function show(Video $video){
        return view('videos.show', compact('video'));
    }

    public function create(Video $video){
        return view('videos.show', compact('video'));
    }


}
