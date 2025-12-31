<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $escaped_target = '%_\\';

        # 検索ワードが入力された場合に一致する投稿を検索
        if ($keyword) {
            # ワイルドカードをエスケープして文字列として認識させる
            $pattern = '%' . addcslashes($keyword, $escaped_target) . '%';
            $posts = Post::query()->where('body', 'LIKE', $pattern)->get();
        } else {
            $posts = Post::all();
        }

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
        $this->authorize('edit', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(PostStoreRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $validated = $request->validated();
        $post->update($validated);
        return redirect('/posts')->with('success', '投稿の内容を更新しました。');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->authorize('destroy', $post);
        $post->delete();
        return redirect('/posts')->with('success', '投稿を削除しました。');
    }
}
