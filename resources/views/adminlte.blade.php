<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lontar Cinema | {{ $subtittle }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{ url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
  
  <link rel="stylesheet" href="{{ url('//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css') }}">

  <link rel="stylesheet" href="{{ url('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css') }}">

  <link href="{{ url('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css') }}" rel="stylesheet"/>

  <style>
    .user-panel {
    align-items: center;
    }
    .info {
      margin-left: 1px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('home') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="//wa.me/message/Y26F7JNHO6TGO1 " class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="\logo_jerbe.jpg" alt="lontarlab logo" class="brand-image img-circle elevation-3" style="opacity: .8"> 
      <span class="brand-text font-weight-light">Lontar Cinema</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> 
        <div class="info">
         <a href="#" class="d-block">{{ Auth::user()->nama }}</a>
         <a href="#" class="d-block">{{ Auth::user()->role }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('home') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          @if (Auth::user()->role == 'admin')
          <li class="nav-item">
            <a href="{{ url('product') }}" class="nav-link">
              <i class="nav-icon fas fa-film"></i>
              <p>
                Film
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('kursi') }}" class="nav-link">
              <i class="nav-icon fas fa-chair"></i>
              <p>
                kursi
              </p>
            </a>
          </li>
          @endif
          
          <li class="nav-item">
            <a href="{{ url('transaction') }}" class="nav-link">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                Transactions
              </p>
            </a>
          </li>
          
          @if (Auth::user()->role == 'admin')
          <li class="nav-item">
            <a href="{{ url('user') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          @endif

          @if (Auth::user()->role !== 'kasir')
          <li class="nav-item">
            <a href="{{ url('log') }}" class="nav-link">
              <i class="nav-icon fas fa-history"></i>
              <p>
                log
              </p>
            </a>
          </li>
          @endif
          <form action="{{ route('logout') }}" method="post" class="nav-item ">
            @csrf
            <button type="submit" class="nav-link btn-danger text-white">Logout</button>
          </form>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="">Eben Hezer Wangsa djaja</a>.</strong> Lontar Cinema
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dist/js/adminlte.min.js') }}"></script>

<script src="{{ url('https://code.jquery.com/jquery-3.5.1.slim.min.js') }}"></script>
<script src="{{ url('https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js') }}"></script>
<script src="{{ url('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js') }}"></script>
<script src="{{ url('https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js') }}"></script>
<script src="{{ url('https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js') }}"></script>


<!-- OPTIONAL SCRIPTS -->
<script src="{{ url('plugins/chart.js/Chart.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('dist/js/pages/dashboard3.js') }}"></script>
<script src="{{ url('https://code.jquery.com/jquery-3.7.1.min.js') }}" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        let table = new DataTable('#users');
</script>
</body>

</html>