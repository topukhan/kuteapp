<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div class="text-center">
            <a href="{{ route('app')}}" class="bg-black text-white px-2 py-2 rounded-lg shadow text-center">Open App </a>
        </div>
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

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="my-3 p-2">
                        <span class="bg-gray-300 p-2 rounded-md m-2">
                            All notifications
                        </span>
                        <span
                            class="bg-blue-600 px-3 py-2 rounded-xl text-white">{{ count(auth()->user()->notifications) }}</span>
                        @forelse (auth()->user()->notifications as $notification)
                            <div
                                class="bg-blue-300 p-3 m-3 rounded-sm {{ $notification->read_at ? 'notification-read' : 'notification-unread' }}">
                                {{ $notification->data['name'] }} Started Following you
                                @if ($notification->read_at)
                                    <button class="p-2 bg-slate-400 text-black rounded-lg">Viewed
                                    </button>
                                @else
                                    <a href="{{ route('markAsRead', $notification->id) }}"
                                        class="p-2 bg-slate-400 text-black rounded-lg">Mark As Read
                                    </a>
                                @endif
                            </div>
                        @empty
                            <span>No Notifications Found</span>
                        @endforelse
                    </div>
                    <div class="my-3 p-2">
                        <span class="bg-gray-300 p-2 rounded-md m-2">
                            Unread notifications
                        </span>
                        <span
                            class="bg-yellow-600 px-3 py-2 rounded-xl text-white">{{ count(auth()->user()->unreadnotifications) }}</span>
                        @forelse (auth()->user()->unreadnotifications as $notification)
                            <div class="bg-yellow-200 p-3 m-3 rounded-sm">
                                {{ $notification->data['name'] }} Started Following you
                                @if ($notification->read_at)
                                    <button class="p-2 bg-slate-400 text-black rounded-lg">Viewed
                                    </button>
                                @else
                                    <a href="{{ route('markAsRead', $notification->id) }}"
                                        class="p-2 bg-slate-400 text-black rounded-lg">Mark As Read
                                    </a>
                                @endif
                            </div>
                        @empty
                            <span>No Notifications Found</span>
                        @endforelse
                    </div>
                    <div class="my-3 p-2">
                        <span class="bg-gray-300 p-2 rounded-md m-2">
                            Read Notifications
                        </span>
                        <span
                            class="bg-gray-600 px-3 py-2 rounded-xl text-white">{{ count(auth()->user()->readnotifications) }}</span>
                        @forelse (auth()->user()->readnotifications as $notification)
                            <div class="bg-gray-300 p-3 m-3 rounded-sm">
                                {{ $notification->data['name'] }} Started Following you
                                @if ($notification->read_at)
                                    <button class="p-2 bg-slate-400 text-black rounded-lg">Viewed
                                    </button>
                                @else
                                    <a href="{{ route('markAsRead', $notification->id) }}"
                                        class="p-2 bg-slate-400 text-black rounded-lg">Mark As Read
                                    </a>
                                @endif
                            </div>
                        @empty
                            <span>No Notifications Found</span>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div> --}}

</x-app-layout>
