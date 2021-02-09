@extends('layout.base')

@section('title', $title)

@push('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
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

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
              <a href="{{ current_url().'/create' }}" class="btn btn-sm btn-success">Tambah data </a>
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
            <table id="pegawai_table" class="table table-bordered table-striped">
                @yield('thead')
                @yield('tbody')
            </table>
        </div>
        <!-- /.card-body -->
        {{-- <div class="card-footer">
          Footer
        </div> --}}
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --> 
  <!-- Modal -->
<div class="modal fade" id="modalShow" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalShowLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalShowLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ..
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
    
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Page specific script -->
<script>
  const _title = document.querySelector('#modalShowLabel');
  const _body = document.querySelector('.modal-body');

  const formatter = new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
  });

  const parseUrl = endpoint => `${location.protocol}//${location.host}/iqbal-c030318077/ajax/${endpoint}`;

  $(function () {
    const title = "Data {{ $title }}";
    const totalColumn = document.getElementsByTagName('th').length;
    const colIndex = Array.apply(null, {length: totalColumn-1}).map(Number.call, Number);
    const colWidth = colIndex.map(el => {
      if(el==0) {
        return '5%';
      }
      return `${95/(totalColumn-2)}%`
    })

    $("#pegawai_table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": {
            dom: {
                button: {
                    className: 'btn btn-light btn-sm btn-rounded'
                },
                input: {
                    className: 'bg-dark'
                }
            },
            buttons: [
                {
                    //EXCEL
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel mr-1"></i> Excel', //u can define a diferent text or icon
                    title: title,
                    exportOptions: {
                        columns: colIndex,
                        search: 'applied',
                        order: 'applied'
                    },
                },
                {
                    //EXCEL
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf mr-1"></i>PDF', //u can define a diferent text or icon
                    title: title,
                    exportOptions: {
                        columns: colIndex,
                        search: 'applied',
                        order: 'applied'
                    },
                    customize : function(doc) {
                        doc.content[1].table.widths = colWidth;
                        // doc.content[0].layout = 'lightHorizontalLines';
                        let objLayout = {};
                        objLayout['hLineWidth'] = function(i) { return .8; };
                        objLayout['vLineWidth'] = function(i) { return .5; };
                        objLayout['hLineColor'] = function(i) { return '#aaa'; };
                        objLayout['vLineColor'] = function(i) { return '#aaa'; };
                        objLayout['paddingLeft'] = function(i) { return 8; };
                        objLayout['paddingRight'] = function(i) { return 8; };
                        doc.content[1].layout = objLayout;
                    }
                },
                {
                    //PRINT
                    extend: 'print',
                    text: '<i class="fas fa-print mr-1"></i> Cetak',
                    title: title,
                    exportOptions: {
                        columns: colIndex,
                        search: 'applied',
                        order: 'applied'
                    },
                },
                // {
                //     //COPY
                //     extend: 'copy',
                //     text: '<i class="far fa-copy mr-1"></i> Salin',
                //     title: title,
                // },
                {
                    extend:'colvis',
                    text: 'Kolom'
                }
            ]
        },
    }).buttons().container().appendTo('#pegawai_table_wrapper .col-md-6:eq(0)');

  });
</script>
@endpush