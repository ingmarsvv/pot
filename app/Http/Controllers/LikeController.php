<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
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

    public static function checkUserLiked(Video $video) :bool
    {
        $user = Auth::user();
        if (DB::table('likes')->where('video_id', $video->id)->where('user_id', $user->id)->exists()){
            return true;
        } else {
            return false;
        }
    }
}
