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
        $user = Auth::user();
        # ログイン済みならユーザーの全ての投稿を取得 / ログインしていないなら空のコレクション
        $posts = $user
            ? Auth::user()->posts()->get()
            : collect();

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
}
