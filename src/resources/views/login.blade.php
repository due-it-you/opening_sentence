@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
    <div>
        ログイン
        <!-- ログインフォーム -->
        <form action="{{ route('login.authenticate') }}" method="POST">
            @csrf
            <div>
                <!-- エラーメッセージ -->
                <x-alert :$errors />
                @if ($errors->has('login'))
                    <div class="alert alert-danger">
                        {{ $errors->first('login') }}
                    </div>
                @endif
            </div>
            <div>
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" class="border">
            </div>
            <div>
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" class="border">
            </div>
            <div>
                <input type="submit" value="送信" class="border">
            </div>
        </form>
    </div>
@endsection
