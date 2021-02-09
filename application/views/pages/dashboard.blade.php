@extends('layout.base')

@section('title', $title)

@push('styles')
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endpush

@push('scripts')
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('js/pages/dashboard.js') }}"></script>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{ $title }}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol> --}}
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $count['mahasiswa'] }} orang</h3>

                <p>Mahasiswa</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="{{ site_url('mahasiswa') }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $count['keahlian'] }}</h3>

                <p>Keahlian</p>
              </div>
              <div class="icon">
                <i class="fas fa-cogs"></i>
              </div>
              <a href="{{ site_url('keahlian') }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $count['bidang'] }}</h3>

                <p>Bidang Prospek Kerja</p>
              </div>
              <div class="icon">
                <i class="fas fa-briefcase"></i>
              </div>
              <a href="{{ site_url('keahlian') }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  C030318077
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>M. Iqbal Effendi</b></h2>
                      <p class="text-muted text-sm"><b>Minat: </b> Back-end Developer / Fullstack Developer / Graphic Artist / Mobile App Developer </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small my-2"><span class="fa-li"><i class="mr-2 fas fa-lg fa-building"></i></span> Alamat: Sungai Andai, Banjarmasin</li>
                        <li class="small my-2"><span class="fa-li"><i class="mr-2 fas fa-lg fa-phone"></i></span> Telegram: @iqbaleff214</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="{{ asset('img/c030318077_2.jpg') }}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="#" class="btn btn-sm bg-teal">
                      <i class="fas fa-comments"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> View Profile
                    </a>
                  </div>
                </div>
              </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
          </section>
          <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
