<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index');
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
}
