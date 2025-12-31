@extends('layouts.app')

@section('title', '投稿作成')

@section('content')
    <div>
        <div>
            <!-- 検索フォーム -->
            <form action="{{ route('posts.index') }}" method="GET">
                @csrf
                <div>
                    <label for="keyword">本文検索：</label>
                    <input type="text" name="keyword" id="keyword" class="border">
                </div>
                <input type="submit" class="border">
            </form>
        </div>
        <!-- 投稿一覧表示 -->
        @foreach ($posts as $post)
            <div class="flex space-y-4 mt-4">
                <div class="border">
                    {{ $post->body }}
                </div>
                <div>
                    <a href="{{ route('posts.edit', $post->id) }}" class="border px-2 py-1">編集</a>
                </div>
                <div>
                    <form 
                        action="{{ route('posts.destroy', $post) }}" 
                        method="POST"
                        onsubmit="return confirm('本当に削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border">削除</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
