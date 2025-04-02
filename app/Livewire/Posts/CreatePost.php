<?php

namespace App\Livewire\Posts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreatePost extends Component
{
    public $title = 'Post Title....';

    // private $index = 3 + 5;
    public function render()
    {
        $data = Auth::user();

        // dd($data);
        return view('livewire.posts.create-post', compact('data'));
    }
}
