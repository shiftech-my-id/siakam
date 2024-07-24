<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Masuk {{ env('APP_NAME') }}</title>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" rel="stylesheet">
  <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">
  @vite([])
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center text-muted">
        <div class="h3">Masuk</div>
        <div>Sistem Informasi Akademik Madrasah</div>
        <div class="h5"><b>{{ App\Models\Setting::value('school.name', 'Ma\'had ...') }}</b></div>
      </div>
      <div class="card-body">
        @if (Session::has('error'))
          <p class="login-box-msg text-danger">{{ Session::get('error') }}</p>
        @else
          <p class="login-box-msg">Masuk untuk memulai sesi anda.</p>
        @endif
        <form action="{{ route('auth.login') }}" method="post">
          @csrf
          <div class="my-3">
            <div class="input-group">
              <input class="form-control @error('username') is-invalid @enderror" name="username" type="text"
                value="{{ old('username') }}" autofocus placeholder="ID Pengguna">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            @error('username')
              <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
          </div>
          <div class="my-3">
            <div class="input-group">
              <input class="form-control @error('username') is-invalid @enderror" name="password" type="password"
                value="" placeholder="Kata Sandi">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            @error('password')
              <p class="text-danger"><small>{{ $message }}</small></p>
            @enderror
          </div>
          <div class="row">
            <div class="col-12">
              <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-right-to-bracket mr-2"></i>
                Masuk</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="mt-4 text-muted"> {{ env('APP_NAME') }}<sup>v{{ env('APP_VERSION_STR') }}</sup></div>
  <div class="mt-4 text-muted">&copy; Shift IT Solution 2024</div>
  <div class="mt-0 text-muted"><a href="https://shiftech.my.id">www.shiftech.my.id</a></div>
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
