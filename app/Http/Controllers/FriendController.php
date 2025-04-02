<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use App\Models\User;
use App\Notifications\FriendRequestNotification;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function sendFriendRequest(User $user)
    {
        $currentUser = auth()->user();

        try {
            // Check if a friend request already exists or if the users are already friends.
            if (! $currentUser->hasSentFriendRequestTo($user) && ! $currentUser->isFriendWith($user)) {
                $friendRequest = new FriendRequest;
                $friendRequest->sender_id = $currentUser->id;
                $friendRequest->receiver_id = $user->id;
                $friendRequest->save();
                // Optionally, you can add a notification here to notify the receiver about the friend request.
                $user->notify(new FriendRequestNotification($currentUser));

                return redirect()->back();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function acceptFriendRequest(User $user)
    {
        $currentUser = auth()->user();
        $friendRequest = FriendRequest::where('sender_id', $user->id)
            ->where('receiver_id', $currentUser->id)
            ->first();

        try {
            if ($friendRequest) {
                // Check if the friendship already exists to avoid duplicates
                if (! $currentUser->isFriendWith($user)) {
                    // Create the friendship relationship between users
                    $currentUser->friends()->attach($user->id);
                    $user->friends()->attach($currentUser->id);

                    // Delete the friend request
                    $friendRequest->delete();

                    // Optionally, you can add a notification here to notify the sender that the request was accepted.
                    $user->notify(new FriendRequestNotification($currentUser, true));

                    return redirect()->back()->with('message', 'Friend request accepted.');
                } else {
                    return redirect()->back()->with('error', 'You are already friends.');
                }
            }

            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    // remove friend from friend list
    public function removeFriend(User $user)
    {
        $currentUser = auth()->user();

        // Check if the friendship exists before attempting to remove
        if ($currentUser->isFriendWith($user)) {
            $currentUser->friends()->detach($user->id);
            $user->friends()->detach($currentUser->id);

            return redirect()->back()->with('message', 'Friend removed successfully.');
        } else {
            return redirect()->back()->with('error', 'You are not friends with this user.');
        }
    }
}
