@extends('layouts.app')

@section('管理者ログイン')

@section('content')
  <div>
    <form action="{{ route('admin.login') }}" method="POST">
      @csrf
      <input type="email" name="email" id="email" class="border">
      <input type="password" name="password" id="password" class="border">
      <input type="submit">
    </form>
  </div>
@endsection