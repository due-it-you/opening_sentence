<html>
  <head>
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