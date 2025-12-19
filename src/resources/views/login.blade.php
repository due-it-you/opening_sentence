@extends('layouts.app')

@section('title', '新規登録')

@section('content')
    <div>
        ログイン
        <form action="" method="POST">
            @csrf
            <div>
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" class="border">
            </div>
            <div>
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" class="border">
            </div>
        </form>
    </div>
@endsection
