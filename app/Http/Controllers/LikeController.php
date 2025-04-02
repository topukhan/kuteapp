<?php

namespace App\Http\Controllers;

use App\Mail\LikeMail;
use App\Models\Like;
use App\Models\Post;
use App\Notifications\LikeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LikeController extends Controller
{
    public function like(Request $request, Post $post)
    {
        $user = auth()->user();
        try {
            if (! $post->likes->contains($user)) {
                $like = new Like;
                $like->user_id = $user->id;
                $post->likes()->save($like);
            }
            if ($post->user != $user) {
                $post->user->notify(new LikeNotification($user, $post, 'like'));
                Mail::to($post->user?->email)->send(new LikeMail($user, $post, 'like'));
            }

            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function unlike(Request $request, Post $post)
    {
        $user = auth()->user();
        $like = $post->likes->where('user_id', $user->id)->first();
        try {
            if ($like) {
                $like->delete();
            }

            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
