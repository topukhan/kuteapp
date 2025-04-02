<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-indigo-700 leading-tight flex items-center">
                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                </svg>
                {{ __('Notifications') }}
            </h2>
            @php
                $unreadCount = auth()->user()->unreadNotifications->count();
            @endphp
            @if($unreadCount > 0)
                <span class="bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">
                    {{ $unreadCount }} New
                </span>
            @endif
        </div>
    </x-slot>

    <div class="py-8 px-4 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                        </svg>
                        Activity Updates
                    </h2>
                </div>

                <div class="divide-y divide-gray-100">
                    @if (count(auth()->user()->notifications) > 0)
                        @foreach (auth()->user()->notifications as $notification)
                            @php
                                $bgColor = $notification->read_at ? 'hover:bg-gray-50' : 'bg-indigo-50 hover:bg-indigo-100';
                                $icon = '';
                                $color = '';
                                
                                if ($notification->type === 'App\Notifications\FriendRequestNotification') {
                                    $icon = $notification->data['accepted'] ? 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z' : 'M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z';
                                    $color = 'text-blue-500';
                                } elseif ($notification->type === 'App\Notifications\LikeNotification') {
                                    $icon = $notification->data['status'] == 'like' ? 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z' : 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z';
                                    $color = $notification->data['status'] == 'like' ? 'text-red-500' : 'text-gray-500';
                                } elseif ($notification->type === 'App\Notifications\CommentNotification') {
                                    $icon = 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z';
                                    $color = 'text-green-500';
                                }
                            @endphp

                            <div class="px-6 py-4 {{ $bgColor }} transition duration-150">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="h-10 w-10 rounded-full {{ $color }} bg-white flex items-center justify-center shadow-sm">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        @if ($notification->type === 'App\Notifications\FriendRequestNotification')
                                            <a href="{{route('friendList')}}" class="block">
                                                <p class="text-gray-800 {{ !$notification->read_at ? 'font-semibold' : '' }}">
                                                    @if ($notification->data['accepted'] == false)
                                                        <span class="font-medium text-blue-600">{{ $notification->data['sender_name'] }}</span> sent you a friend request.
                                                    @else
                                                        <span class="font-medium text-blue-600">{{ $notification->data['sender_name'] }}</span> accepted your friend request.
                                                    @endif
                                                </p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </p>
                                            </a>
                                        @endif

                                        @if ($notification->type === 'App\Notifications\LikeNotification')
                                            <a href="{{ route('post.details', $notification->data['post_id']) }}" class="block">
                                                <p class="text-gray-800 {{ !$notification->read_at ? 'font-semibold' : '' }}">
                                                    @if ($notification->data['sender_name'] !== auth()->user()->name)
                                                        <span class="font-medium text-blue-600">{{ $notification->data['sender_name'] }}</span>
                                                        {{ $notification->data['status'] == 'like' ? 'liked' : 'unliked' }} your post
                                                    @else
                                                        You {{ $notification->data['status'] == 'like' ? 'liked' : 'unliked' }} your post
                                                    @endif
                                                </p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </p>
                                            </a>
                                        @endif

                                        @if ($notification->type === 'App\Notifications\CommentNotification')
                                            <a href="{{ route('post.details', $notification->data['post_id']) }}" class="block">
                                                <p class="text-gray-800 {{ !$notification->read_at ? 'font-semibold' : '' }}">
                                                    @if ($notification->data['sender_name'] !== auth()->user()->name)
                                                        <span class="font-medium text-blue-600">{{ $notification->data['sender_name'] }}</span> commented on your post
                                                    @else
                                                        You commented on your post
                                                    @endif
                                                </p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </p>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if (!$notification->read_at)
                                {{ $notification->markAsRead() }}
                            @endif
                        @endforeach
                    @else
                        <div class="px-6 py-16 text-center">
                            <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No notifications</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                You're all caught up! New activity will appear here.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>