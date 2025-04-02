<x-app-layout>
    <div class="py-8 px-4 max-w-2xl mx-auto bg-gray-50">
        <!-- Post Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-6">
            <div class="border-b border-gray-100 px-6 py-4 flex items-center">
                <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-800 font-bold mr-3">
                    {{ substr($post->user->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">{{ $post->user->name }}</h3>
                    <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>
            
            <div class="px-6 py-5">
                <p class="text-gray-800 text-lg leading-relaxed">{{ $post->content }}</p>
            </div>
            
            <div class="px-6 py-3 bg-gray-50 flex items-center justify-between">
                <div class="flex items-center space-x-6">
                    <div class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-red-500 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium">{{ count($post->likes) }} Likes</span>
                    </div>
                    <div class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-blue-500 mr-1.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium">{{ count($post->comments) }} Comments</span>
                    </div>
                </div>
                
            </div>
        </div>
            
        <!-- Comments Section -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-500 to-indigo-600">
                <h2 class="text-lg font-bold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                    </svg>
                    Comments ({{ count($post->comments) }})
                </h2>
            </div>
            
            <!-- Comments List -->
            <div class="divide-y divide-gray-100">
                @forelse ($post->comments as $comment)
                    <div class="px-6 py-4 hover:bg-gray-50 transition duration-150">
                        <div class="flex">
                            <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-800 font-bold mr-3 flex-shrink-0">
                                {{ substr($comment->user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="flex items-center">
                                    <h4 class="font-semibold text-gray-800">{{ $comment->user->name }}</h4>
                                    <span class="text-xs text-gray-500 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-800 mt-1">{{ $comment->content }}</p>
                                
                                <!-- Comment actions - add functionality as needed -->
                                <div class="mt-2 flex space-x-4">
                                    <button class="text-xs text-gray-500 hover:text-indigo-600 transition duration-150">Reply</button>
                                    <button class="text-xs text-gray-500 hover:text-indigo-600 transition duration-150">Like</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <p class="mt-2 text-gray-500 font-medium">No comments yet</p>
                        <p class="mt-1 text-sm text-gray-400">Be the first to share your thoughts!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>