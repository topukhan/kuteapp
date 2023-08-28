<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>
    <style>
        .notification-read {
            background-color: #dbdada;
            /* Styling for read notifications */
        }

        .notification-unread {
            background-color: #b7daa2;
            /* Styling for unread notifications */
        }
    </style>

    <div class="flex justify-center items-center bg-gray-100 mt-4">
        <div class="notifications-container bg-white rounded-lg shadow p-4">
            <h1 class="text-2xl font-semibold mb-4">Notifications</h1>

            @if (count(auth()->user()->notifications) > 0)
                @foreach (auth()->user()->notifications as $notification)
                    <div class="notification mb-4">
                        @if ($notification->type === 'App\Notifications\FriendRequestNotification')
                            <a href="{{route('friendList')}}">
                            {{-- Display friend request notification --}}
                            <p class="text-gray-700 @if (!$notification->read_at) font-bold @endif hover:bg-green-200 rounded-sm py-1 px-4 ">
                                @if ($notification->data['accepted'] == false)
                                    {{ $notification->data['sender_name'] }} sent you a friend request.
                                @else
                                    {{ $notification->data['sender_name'] }} Accepted your friend request.
                                @endif
                            </p>
                            
                            @if (!$notification->read_at)
                                {{ $notification->markAsRead() }}
                            @endif</a>
                        @endif
                        @if ($notification->type === 'App\Notifications\LikeNotification')
                            <a href="{{ route('post.details', $notification->data['post_id']) }}">
                                {{-- Display Like notification --}}
                                <p class="text-gray-700 @if (!$notification->read_at) font-bold @endif hover:bg-green-200 rounded-sm py-1 px-4">
                                    @if ($notification->data['sender_name'] !== auth()->user()->name)
                                        {{ $notification->data['sender_name'] }}
                                        {{ $notification->data['status'] == 'like' ? 'Liked' : 'Unliked' }} your Post.
                                    @else
                                        You {{ $notification->data['status'] == 'like' ? 'Liked' : 'Unliked' }} your
                                        Post.
                                    @endif
                                </p>
                                @if (!$notification->read_at)
                                    {{ $notification->markAsRead() }}
                                @endif
                            </a>
                        @endif
                        @if ($notification->type === 'App\Notifications\CommentNotification')
                            <a href="{{ route('post.details', $notification->data['post_id']) }}">
                                {{-- Display Comment notification --}}
                                <p class="text-gray-700 @if (!$notification->read_at) font-bold @endif hover:bg-green-200 rounded-sm py-1 px-4">
                                    @if ($notification->data['sender_name'] !== auth()->user()->name)
                                        {{ $notification->data['sender_name'] }} Commented on your Post.
                                    @else
                                        You Commented your Post.
                                    @endif
                                </p>
                                @if (!$notification->read_at)
                                    {{ $notification->markAsRead() }}
                                @endif
                            </a>
                        @endif
                        {{-- Add more conditionals for other notification types if needed --}}
                    </div>
                @endforeach
            @else
                <p class="text-gray-700">No notifications to display at this time.</p>
            @endif
        </div>
    </div>







</x-app-layout>
