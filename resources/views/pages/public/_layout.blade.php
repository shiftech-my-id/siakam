<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel</title>
  @vite([asset('css/app.css'), asset('css/app.js')])
</head>

<body>
  <ul>
    <li><a href="{{ route('home') }}">Beranda</a></li>
    <li><a href="{{ route('contact') }}">Kontak</a></li>
    <li><a href="{{ route('auth.login') }}">Masuk</a></li>
  </ul>

  @yield('content')
</body>

</html>
