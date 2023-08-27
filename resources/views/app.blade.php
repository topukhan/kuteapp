<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Social App') }}
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
        <h1 class="text-3xl font-semibold mb-2">Welcome to Social App</h1>
        <div class="flex justify-between items-center mb-6">
            <div class="space-x-4">
                <!-- Button to create a post -->
                <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow">Create
                    Post</a>
                <!-- Button to send a friend request -->
                <a href="{{ route('friendList') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow">
                    Friends</a>
                <a href="{{route('notifications')}}" class="bg-black text-white px-2 py-2 rounded-lg shadow">Notifications
                    <span class="bg-white text-black px-2 ml-1 rounded-md ">
                        {{ count(auth()->user()->notifications) }}
                    </span>
                </a>
            </div>
        </div>
        <!-- Placeholder content for posts and notifications -->
        <div class="bg-white rounded-lg shadow p-2 my-2">
            <h2 class="text-xl font-semibold mb-4">Latest Posts</h2>
        </div>
        <!-- Example post -->
        @forelse ($posts as $post)
            {{-- @dd($post) --}}
            <div class="bg-white rounded-lg shadow p-2 my-3">
                <div class="  mb-2 px-4">
                    <p class="text-gray-600 py-4">
                        <strong>{{ $post->user->name }}:</strong> <br>
                        "{{ $post->content }}"
                    </p>
                    <span class="text-sm text-gray-600">{{ count($post->likes) }} Likes</span>
                    <span class="text-sm text-gray-600 mx-4">{{ count($post->comments) }} Comments</span>
                    <div class="my-2 flex space-x-4 justify-between">

                        @if (!$post->likes->contains('user_id', auth()->user()->id))
                            <form action="{{ route('posts.like', ['post' => $post->id]) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-white bg-purple-600 hover:bg-purple-800 px-3 rounded-md">
                                    Like
                                </button>
                            </form>
                        @else
                            <form action="{{ route('posts.unlike', ['post' => $post->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-purple-600 hover:bg-purple-800 px-3 rounded-md">
                                    Unlike
                                </button>
                            </form>
                        @endif
                        <button class="text-blue-500 hover:underline">Share</button>
                    </div>
                    <div class="relative">
                        <form action="{{ route('comments.store', ['post' => $post->id]) }}" method="POST">
                            @csrf
                            <input class="rounded-full w-full h-fit border-gray-400 pl-4 pr-12 py-2" type="text"
                                name="comment" id="comment" placeholder="Write a comment...">
                            <button
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-blue-500 hover:text-blue-700"
                                type="submit">
                                Submit
                            </button>
                        </form>
                    </div>
                    <x-input-error :messages="$errors->first('comment')" class="text-red-500 mt-2 font-semibold" />

                </div>
            </div>
        @empty
            <div class="mt-2 flex space-x-4">
                No Post Available
            </div>
        @endforelse
        <!-- More posts... -->
        {{-- <div class="bg-white rounded-lg shadow mt-4 p-4">
            <h2 class="text-xl font-semibold mb-4">Notifications</h2>
            <!-- Example notification -->
            <div class="border-b border-gray-300 pb-2 mb-2">
                <p class="text-gray-600">User456 liked your post: "Enjoying the weekend vibes!"</p>
            </div>
            <!-- More notifications... -->
        </div> --}}
    </div>


</x-app-layout>
