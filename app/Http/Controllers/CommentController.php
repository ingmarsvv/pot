<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $videoID){
        $request->validate([
            'comment' => 'required|max:255',
        ]);
        $comment = Comment::create([
            'text' => $request->input('comment'),
            'user_id' => Auth::id(),
            'video_id' => $videoID,
        ]);
        return redirect()->back();
    }

    public static function serve(Video $video){
        $comments = Comment::where('video_id', $video->id)->with('user:id,name')->orderBy('created_at')->get();
        return $comments;
    }

    public function destroy(Comment $comment){
        $user = Auth::user();
        if ($user->id == $comment->user_id){
            $comment->delete();
        }
        return redirect()->back();
    }
}
