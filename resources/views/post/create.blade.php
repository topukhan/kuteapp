<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>
    <div class="max-w-5xl mx-auto ">
        <div class="container mt-5  max-w-2xl px-4">

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-800">Content</label>
                    <textarea class="mt-1 p-2 block w-full border rounded-md shadow-sm focus:ring focus:ring-opacity-50" name="content"
                        rows="3"></textarea>
                    <x-input-error :messages="$errors->first('content')" class="text-red-500 mt-2 font-semibold" />
                </div>

                <div class="my-3">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-opacity-50">Create
                        Post</button>
                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring focus:ring-opacity-50 ml-2">Back</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
