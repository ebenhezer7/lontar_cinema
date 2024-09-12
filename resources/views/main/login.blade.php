<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lontar Cinema | {{ $subtittle }}</title>

  <style>
    /* CSS untuk mengatur gambar ke tengah halaman */
    .center-image {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 30; /* Mengisi tinggi layar sepenuhnya */
    }
    .center-image img {
        max-width: 50%; /* Ukuran gambar sedang (50% lebar) */
        height: auto; /* Biarkan tinggi mengikuti lebar asli */
    }
    .card-pink{
      color: rgb(59, 213, 255)
    }
</style>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="dashboard" class="h1"><b>Lontar</b>Cinema</a>
    </div>
    <br>
    <div class="center-image">
      <img src="../../logo_jerbe.jpg" alt="AdminLTE Logo" class="brand-image img-30 img-circle elevation-3" style="opacity: .8">
    </div>
    <div class="card-body">
      <p class="login-box-msg">Login Sebelum Masuk Ke Aplikasi</p>

      @if($errors->any())
      @foreach($errors->all() as $err)
      <p class="alert alert-danger">{{ $err }}</p>
      @endforeach
      @endif
      
      <form action="{{ route('login.action') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input name="username" type="text" value="{{ old('username') }}" class="form-control" placeholder="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="password" type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
