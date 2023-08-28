<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Friend List ') }}
        </h2>
    </x-slot>


    <div class="py-12 px-4 mx-auto max-w-xl">
        @if (session('message'))
            <div class="bg-blue-200 rounded-lg flex">
                <p class="text-sm px-4 py-3 font-bold">{{ session('message') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-200 rounded-lg flex">
                <p class="text-sm px-4 py-3 font-bold">{{ session('error') }}</p>
            </div>
        @endif
        <div class="py-8 px-4 max-w-xl mx-auto">
            <h1 class="text-2xl font-semibold mb-4">Friend List</h1>

            <h2 class="text-xl font-semibold mb-2">Your Friends</h2>
            <ul class="bg-white rounded-lg shadow p-4 mb-4">
                @forelse ($friends as $friend)
                    <li class="flex items-center justify-between border-b border-gray-300 py-2">
                        <span>{{ $friend->name }}</span>
                        <form action="{{ route('removeFriend', ['user' => $friend->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>
                        </form>
                    </li>
                @empty
                    <p>No friends.</p>
                @endforelse
            </ul>


            <h2 class="text-xl font-semibold mb-2">Friend Requests</h2>
            <ul class="bg-white rounded-lg shadow p-4">
                @forelse ($receivedRequests as $request)
                    <li class="flex items-center justify-between border-b border-gray-300 py-2">
                        <span>{{ $request->sender->name }}</span>
                        <form action="{{ route('acceptFriendRequest', ['user' => $request->sender->id]) }}"
                            method="POST">
                            @csrf
                            <button class="bg-green-500 text-white px-3 py-1 rounded-md" type="submit">Accept</button>
                        </form>

                    </li>
                @empty
                    <p>No friend requests.</p>
                @endforelse
            </ul>

            <h2 class="text-xl font-semibold mb-2">Other Users</h2>
            <ul class="bg-white rounded-lg shadow p-4">
                @forelse ($nonFriends as $nonFriend)
                    <li class="flex items-center justify-between border-b border-gray-300 py-2">
                        <span>{{ $nonFriend->name }}</span>
                        @if (!auth()->user()->hasSentFriendRequestTo($nonFriend))
                            <form action="{{ route('sendFriendRequest', ['user' => $nonFriend->id]) }}" method="POST">
                                @csrf
                                <button class="bg-green-500 text-white px-3 py-1 rounded-md" type="submit">Send
                                    Request</button>
                            </form>
                        @else
                            <span class="text-gray-500">Request Sent</span>
                        @endif
                    </li>
                @empty
                    <p>No friend requests.</p>
                @endforelse
            </ul>
        </div>
    </div>



</x-app-layout>
