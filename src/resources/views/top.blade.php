@extends('layouts.app')

@section('title', 'トップページ')

@section('header')
  <div class="bg-gray-200 h-16">
    <a href="{{ route('signup') }}">新規登録</a>
  </div>
@endsection

@section('content')
  <div>
    トップページです！
  </div>
@endsection
