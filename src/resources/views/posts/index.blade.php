@extends('layouts.app')

@section('title', '投稿作成')

@section('content')
    <div>
        @foreach ($posts as $post)
            <div class="flex space-y-4 mt-4">
                <div class="border">
                    {{ $post->body }}
                </div>
                <div>
                    <a href="{{ route('posts.edit', $post->id)}}" class="border px-2 py-1">編集</a>
                </div>
                <div>
                    <a href="{{ route('posts.destroy', $post) }}" class="border px-2 py-1">削除</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
