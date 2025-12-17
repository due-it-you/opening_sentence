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
        @yield('header')
      </header>
      <main>
        <div class="container">
          @yield('content')
        </div>
      </main>
    </div>
  </body>
</html>