@extends('layouts.app')

@section('title', '新規登録')

@section('content')
  <div>
    <div class="font-bold">
      アカウント新規登録
    </div>
    <!-- 新規登録フォーム -->
    <div>
      <form method="POST" action="{{ route('signup.store') }}">
        @csrf
        <!-- エラーメッセージの表示 -->
        @if ($errors->any())
          <div>
            <ul>
              @foreach ($errors->all() as $error)
                <li class="text-red-600">{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
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
