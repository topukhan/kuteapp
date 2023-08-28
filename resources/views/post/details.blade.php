<x-app-layout>
    <div class="py-8 px-4 max-w-xl mx-auto">
        <div class="bg-white rounded-lg shadow p-4 mb-4">
            <p class="text-gray-600 py-4">
                <strong>{{ $post->user->name }} posted:</strong> <br>
                "{{ $post->content }}"
            </p>
            <span class="text-sm text-gray-600">{{ count($post->likes) }} Likes</span>
            <span class="text-sm text-gray-600 mx-4">{{ count($post->comments) }} Comments</span>
        </div>

        <h2 class="text-lg font-semibold mb-2">Comments {{ count($post->comments) }}</h2>
        <ul class="bg-white rounded-lg shadow p-4">
            @forelse ($post->comments as $comment)
                <li class="flex items-center  border-b border-gray-300 py-2">
                    <span>{{ $comment->user->name }} : </span>
                    <span class="ml-1">{{ $comment->content }}</span>
                </li>
            @empty
                <li>No comments yet.</li>
            @endforelse
        </ul>
    </div>
</x-app-layout>
