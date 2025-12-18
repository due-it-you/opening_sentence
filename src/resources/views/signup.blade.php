@extends('layouts.app')

@section('title', '新規登録')

@section('header')
  <div class="bg-gray-200 h-16">
    <a href="">新規登録</a>
  </div>
@endsection

@section('content')
  <div>
    <div class="font-bold">
      アカウント新規登録
    </div>
    <!-- 新規登録フォーム -->
    <div>
      <form action="POST" action="">
        @csrf
        <div>
          <label for="name">ユーザーネーム</label>
          <input id="name" name="name" type="text" class="border border-gray-600">
        </div>
        <div>
          <label for="email">メールアドレス</label>
          <input id="email" name="email" type="email" class="border border-gray-600" placeholder="xxxx@example.com">
        </div>
        <div class="mt-4">
          <label for="password">パスワード</label>
          <input id="password" name="password" type="password" class="border border-gray-600" placeholder="パスワード">
        </div>
        <div class="mt-4">
          <input type="submit" value="送信" class="border px-2 rounded-md">
        </div>
      </form>
    </div>
  </div>
@endsection
