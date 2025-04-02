<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required',
        ]);
        $user = auth()->user();
        try {
            $comment = new Comment;
            $comment->user_id = $user->id;
            $comment->content = $request->input('comment');
            $post->comments()->save($comment);

            $post->user->notify(new CommentNotification($user, $post->id));

            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
