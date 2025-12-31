@extends('layouts.app')

@section('title', '投稿作成')

@section('content')
    <div>
        投稿編集ページ
        <div>
            <!-- 投稿編集フォーム -->
            <form action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PATCH')
                <div>
                    <input type="text" name="body" id="body" class="border" value="{{ $post->body }}">
                    <input type="submit" class="border">
                </div>
            </form>
        </div>
    </div>
@endsection