@extends('layouts.app')

@section('title', '投稿作成')

@section('content')
    <!-- エラーメッセージの表示 -->
    <x-alert :$errors />
    <div>
        投稿作成フォーム
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <div>
                <label for="body">書き出し小説の内容：</label>
                <input type="text" name="body" id="body" class="border">
            </div>
            <div>
                <input type="submit" class="border">
            </div>
        </form>
    </div>
@endsection
