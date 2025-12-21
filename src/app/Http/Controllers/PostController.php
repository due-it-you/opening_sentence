<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    /**
     * 書き出し小説の投稿の新規作成
     */
    public function store(PostStoreRequest $request)
    {
        $validated = $request->validated();

        $request->user()->posts()->create($validated);

        return redirect('/')->with('success', '新しく投稿をしました。');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(PostStoreRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $validated = $request->validated();
        $post->update($validated);
        return redirect('/posts')->with('success', '投稿の内容を更新しました。');
    }
}
