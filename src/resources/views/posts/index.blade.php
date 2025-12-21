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
                    <a href="" class="border px-2 py-1">編集</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
