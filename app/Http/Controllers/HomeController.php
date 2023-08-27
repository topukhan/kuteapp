<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use App\Models\Post;
use App\Models\User;
use App\Notifications\UserFollowNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function notify()
    {
        if (auth()->user()) {
            $i = 1;
            for ($i; $i < 4; $i++) {
                $user = User::Where('id', $i)->first();
                auth()->user()->notify(new UserFollowNotification($user));
            }
            dd('done');
        }
    }

    public function markAsRead($id)
    {
        if ($id) {
            auth()->user()->notifications->where('id', $id)->markAsRead();
        }
        return back();
    }

    public function app()
    {
        $posts = Post::all();
        return view('app', compact('posts'));
    }

    public function friendList()
    {
        $user = auth()->user();
        $friends = $user->friends;
    
        // Fetch received friend requests
        $receivedRequests = FriendRequest::where('receiver_id', $user->id)
            ->with('sender') // Eager load the sender's information
            ->get();
    
        $nonFriends = User::whereNotIn('id', $friends->pluck('id'))
            ->where('id', '!=', $user->id)
            ->get();
    
        return view('friend.friendList', compact('friends', 'receivedRequests', 'nonFriends'));
    }

    public function notifications(){
        return view('notification.notification');
    }
    
}
