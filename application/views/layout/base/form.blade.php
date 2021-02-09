@extends('layout.base')

@section('title', $title)

@push('styles')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush

@push('scripts')
  <!-- Select2 -->
  <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
  <script>
    $('.select2').select2()
  </script>
@endpush

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $title }}</h1>
          </div>
          <div class="col-sm-6">
            {{-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol> --}}
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        
      <form action="{{ current_url() }}" method="post" class="form-horizontal">
        {!! csrf_field() !!}
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
            @foreach ($input as $key => $val)

              @switch($val['type'])
                  @case('option')
                  <div class="form-group row">
                      <label for="{{ $key }}" class="col-sm-2 col-form-label">{{ $val['label'] }}</label>
                      <div class="col-sm-10">
                        <select class="form-control select2 @if(form_error($key)) is-invalid @endif" id="{{ $key }}" name="{{ $key }}">
                            @foreach ($val['options'] as $item)
                              @if ($val['option-type']=='enum')
                                <option value="{{ $item }}" @isset($val['value']) @if($item==$val['value']) selected="selected" @endif @endisset >{{ $item }}</option>
                              @else
                                <option value="{{ $item['keahlian_id'] }}" @isset($val['value']) @if($item['keahlian_id']==$val['value']) selected="selected" @endif @endisset >{{ $item['keahlian'] }} ({{ $item['bidang'] }})</option>
                              @endif
                            @endforeach
                        </select>
                    </div>
                  </div>
                      @break
                    
                  @case('textarea')
                  <div class="form-group row">
                      <label for="{{ $key }}" class="col-sm-2 col-form-label">{{ $val['label'] }}</label>
                      <div class="col-sm-10">
                          <textarea class="form-control @if(form_error($key)) is-invalid @endif" id="{{ $key }}" rows="3" name="{{ $key }}" {{ isset($val['readonly']) ? 'disabled' : '' }} autocomplete="off">{{ set_value($key, (isset($val['value'])) ? $val['value'] : '') }}</textarea>
                      </div>
                  </div>
                      @break

                  @default
                  <div class="form-group row">
                      <label for="{{ $key }}" class="col-sm-2 col-form-label">{{ $val['label'] }}</label>
                      <div class="col-sm-10">
                          <input type="{{ $val['type'] }}" class="form-control  @if(form_error($key)) is-invalid @endif" id="{{ $key }}" value="{{ set_value($key, (isset($val['value'])) ? $val['value'] : '') }}" placeholder="Masukkan {{ $val['label'] }}" name="{{ $key }}" {{ isset($val['readonly']) ? 'disabled' : '' }} autocomplete="off">
                      </div>
                  </div>
                  
                      
              @endswitch
                
            @endforeach
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="javascript:history.go(-1)" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
            <span class="float-right text-sm">*) Wajib diisi <br> **) Dibuat otomatis jika kosong</span>
        </div>
        </form>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --> 
@endsection