@extends('layout.base.table')

@section('thead')
<thead>
    <tr>
        <th>No.</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Prodi</th>
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
        <td>{{ null_field($item['nim']) }}</td>
        <td>{{ null_field($item['nama']) }}</td>
        <td>{{ null_field($item['program_studi']) }}</td>
        <td>{{ null_field($item['alamat']) }}</td>
        <td class="text-center">
            {!! action_menu($item['mahasiswa_id']) !!}
        </td>
    </tr>
    @endforeach
</tbody>
@endsection

@push('scripts')
    <script>
        const keahlian_id = "{{ $item['keahlian_id'] }}" || null;
        const generateBody = (obj) => {
            _title.innerHTML = obj.nim;
            let row = ``;
            if (keahlian_id) {
                row = `
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Keahlian</div>
                    <div class="col-md-8 text-muted">${obj.keahlian || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Bidang</div>
                    <div class="col-md-8 text-muted">${obj.bidang || '-'}</div>
                </div>
                `;
            }
            return `
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">NIM</div>
                    <div class="col-md-8 text-muted">${obj.nim || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Nama</div>
                    <div class="col-md-8 text-muted">${obj.nama || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Program Studi</div>
                    <div class="col-md-8 text-muted">${obj.program_studi || '-'}</div>
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
                    <div class="col-md-4 text-right font-weight-bold">No. Hp</div>
                    <div class="col-md-8 text-muted">${obj.no_hp || '-'}</div>
                </div>
                ${row}
            `;
        }

        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('view-item')) {
                const id = e.target.dataset.id
                const url = keahlian_id ? parseUrl(`mahasiswa/read_all/${id}`) : parseUrl(`mahasiswa/read/${id}`);
                fetch(url).then(data => data.json()).then(data => {
                    _body.innerHTML = generateBody(data);
                }).catch(err => console.error(err));
            }
        });

    </script>
@endpush