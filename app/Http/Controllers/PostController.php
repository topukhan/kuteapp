<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {}

    public function create()
    {
        return view('post.create');
    }

    public function show() {}

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|min:5',
        ]);
        try {
            auth()->user()->posts()->create([
                'content' => $request['content'],
            ]);

            return redirect('/app')->with(['message' => 'Post Created Successfully']);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit() {}

    public function update() {}

    public function destroy() {}
}
