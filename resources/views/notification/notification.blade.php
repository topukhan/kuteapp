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

    <div class="notifications-container">
        {{count(auth()->user()->notifications)}}
        @forelse (auth()->user()->notifications as $notification)
            <div class="notification">
                @if ($notification->type === 'App\Notifications\FriendRequestNotification')
                    {{-- Display friend request notification --}}
                    <p>{{ $notification->data['sender_name'] }} sent you a friend request.</p>
                    @if ($notification->data['accepted'])
                        <p>You accepted the friend request.</p>
                    @endif
                @endif
                {{-- Add more conditionals for other notification types if needed --}}
            </div>
        @empty
            <p>No notifications to display at this time.</p>
        @endforelse
    </div>




</x-app-layout>
