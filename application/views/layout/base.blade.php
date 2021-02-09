
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>C030318077 | @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

  @stack('styles')
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ site_url() }}" class="nav-link">Beranda</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ site_url('mahasiswa') }}" class="nav-link">Mahasiswa</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ site_url('keahlian') }}" class="nav-link">Keahlian</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-cog"></i>
        </a>
        <div class="dropdown-menu dropdown-menu dropdown-menu-right">
          {{-- <div class="dropdown-divider"></div> --}}
          <a href="#" class="dropdown-item">
            <i class="fas fa-user-edit mr-2"></i> Profil
          </a>
          {{-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
          </a> --}}
          <div class="dropdown-divider"></div>
          {{-- <a href="#" class="dropdown-item dropdown-footer">Keluar</a> --}}
          <a href="{{ site_url('auth/logout') }}" class="dropdown-item">
            <i class="fas fa-door-open mr-2"></i> Keluar
            </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ site_url() }}" class="brand-link">
      <img src="{{ asset('img/c030318077.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text">C030318077 <span class="font-weight-light">UAS</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar sidebar-dark-olive">
      <!-- Sidebar user (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Usern</a>
        </div>
      </div> --}}


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ site_url('') }}" class="nav-link {{ active_sidebar('dasbor', $sidebar) }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dasbor
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          <li class="nav-item {{ active_sidebar('master', $sidebar) }}">
            <a href="#" class="nav-link {{ active_sidebar('master', $sidebar) }}">
              <i class="nav-icon fas fa-server"></i>
              <p>
                Data Induk
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ site_url('mahasiswa') }}" class="nav-link {{ active_sidebar('mahasiswa', $sidebar) }}">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Mahasiswa</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ site_url('keahlian') }}" class="nav-link {{ active_sidebar('keahlian', $sidebar) }}">
                  <i class="fas fa-cogs nav-icon"></i>
                  <p>Keahlian</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->

  <footer class="main-footer text-sm">
    <div class="float-right d-none d-sm-block">
        Sistem Keahlian by M. Iqbal Effendi C030318077
    </div>
    <strong>Copyright &copy; {{ date('Y') }} <a href="https://github.com/iqbaleff214" target="_blank">iqbaleff214</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- MomentJS -->
<script src="{{ asset('plugins/moment/moment-with-locales.min.js') }}"></script>
<script>
  moment.locale('id');
</script>
@stack('scripts')
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('js/demo.js') }}"></script> --}}
<script>
  const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
</script>


@if (message())
<script>
      Toast.fire({
        icon: '{{ message(true) }}',
        title: '<span class="mx-2">{{ message() }}</span>'
      })
</script>
@endif

</body>
</html>
