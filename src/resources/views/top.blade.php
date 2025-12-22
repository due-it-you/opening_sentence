@extends('layouts.app')

@section('title', 'トップページ')

@section('header')
  <div class="bg-gray-200 h-16">
    <a href="{{ route('signup') }}">新規登録</a>
  </div>
@endsection

@section('content')
  <div>
    @if (session('success'))
      <div class="text-green-400">
        {{ session('success') }}
      </div>
    @endif
  </div>
  <div>
    トップページです！
  </div>
@endsection
