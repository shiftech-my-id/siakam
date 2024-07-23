<?php $title = isset($title) ? $title: '' ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }}</title>
  @vite([asset('css/app.css'), asset('css/app.js')])
</head>
<body>
  @yield('content')
</body>

</html>
