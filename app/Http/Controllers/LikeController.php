<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{   
    //store like
    public function store(Video $video){
        $user = Auth::user();
        if(!($user->likes()->get()->contains($video))){
            $user->likes()->attach($video->id);
        }
        return back();
    }
    //show likes
    public static function countLikes(Video $video){
        $likeCount = $video->likes()->get()->count();
        return $likeCount;
    }
}
