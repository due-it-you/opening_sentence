<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>書き出し小説 - @yield('title')</title>
</head>

<body>
    <div>
        <header>
            <div class="bg-gray-200 h-16">
                <a href="{{ route('signup') }}">新規登録</a>
                <a href="{{ route('login') }}">ログイン</a>
                @auth
                    <div>
                      <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="border rounded-md bg-red-400 text-white font-bold px-2 py-1">ログアウト</button>
                      </form>
                    </div>
                @endauth
            </div>
        </header>
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>
