@extends('layouts.app')

@section('title', '投稿作成')

@section('content')
    <div>
        @foreach ($posts as $post)
            <div class="border">
                {{ $post->body }}
            </div>
        @endforeach
    </div>
@endsection
