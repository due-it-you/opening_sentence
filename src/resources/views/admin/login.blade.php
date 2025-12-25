@extends('layouts.app')

@section('管理者ログイン')

@section('content')
  <div>
    <form action="{{ route('admin.login') }}" method="POST">
      @csrf
      <div>
        <label for="email">メールアドレス：</label>
        <input type="email" name="email" id="email" class="border">
      </div>
      <div>
        <label for="password">パスワード：</label>
        <input type="password" name="password" id="password" class="border">
      </div>
      <input type="submit">
    </form>
  </div>
@endsection