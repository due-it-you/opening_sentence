@extends('layouts.app')

@section('管理者ダッシュボード')

@section('content')
  <div>
    管理者ダッシュボード
    <div>
      <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" class="bg-red-500 text-white font-bold">ログアウト</button>
      </form>
    </div>
  </div>
@endsection