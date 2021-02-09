@extends('layout.base.table')

@section('thead')
<thead>
    <tr>
        <th>No.</th>
        <th>Foto</th>
        <th>NIP</th>
        <th>Nama</th>
        <th>Jabatan</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>
</thead>
@endsection

@section('tbody')
<tbody>
    @foreach ($items as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ null_field($item['foto']) }}</td>
        <td>{{ null_field($item['nip']) }}</td>
        <td>{{ null_field($item['nama']) }}</td>
        <td>{{ null_field($item['jabatan']) }}</td>
        <td>{{ null_field($item['alamat']) }}</td>
        <td class="text-center">
            {!! action_menu($item['id']) !!}
        </td>
    </tr>
    @endforeach
</tbody>
@endsection

@push('scripts')
    <script>
        const generateBody = (obj) => {
            _title.innerHTML = obj.nama;
            return `
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">NIP</div>
                    <div class="col-md-8 text-muted">${obj.nip || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Nama</div>
                    <div class="col-md-8 text-muted">${obj.nama || '-'}</div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Jabatan</div>
                    <div class="col-md-8 text-muted">${obj.jabatan+' '+obj.golongan || '-'}</div>
                </div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Gaji</div>
                    <div class="col-md-8 text-muted">${ formatter.format(parseInt(obj.gaji)+parseInt(obj.tunjangan)) || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Jenis Kelamin</div>
                    <div class="col-md-8 text-muted">${obj.jenis_kelamin || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Kelahiran</div>
                    <div class="col-md-8 text-muted">${obj.tempat_lahir+', '+moment(obj.tanggal_lahir).format('DD MMMM YYYY') || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Agama</div>
                    <div class="col-md-8 text-muted">${obj.agama || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Alamat</div>
                    <div class="col-md-8 text-muted">${obj.alamat || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Pendidikan Terakhir</div>
                    <div class="col-md-8 text-muted">${obj.pendidikan || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Status</div>
                    <div class="col-md-8 text-muted">${obj.status || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">No. Hp</div>
                    <div class="col-md-8 text-muted">${obj.no_hp || '-'}</div>
                </div>
            `;
        }

        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('view-item')) {
                const id = e.target.dataset.id
                const url = parseUrl(`pegawai/read/${id}`);
                fetch(url).then(data => data.json()).then(data => {
                    _body.innerHTML = generateBody(data);
                }).catch(err => console.error(err));
            }
        });

    </script>
@endpush