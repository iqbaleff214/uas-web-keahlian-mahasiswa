@extends('layout.base.table')

@section('thead')
<thead>
    <tr>
        <th>No.</th>
        <th>Jabatan</th>
        <th>Golongan</th>
        <th>Tunjangan</th>
        <th>Gaji</th>
        <th>Aksi</th>
    </tr>
</thead>
@endsection

@section('tbody')
<tbody>
    @php
        setlocale(LC_MONETARY,"en_US")
    @endphp
    @foreach ($items as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item['jabatan'] }}</td>
        <td>{{ $item['golongan'] }}</td>
        <td class="text-right">{{ currency($item['tunjangan']) }}</td>
        <td class="text-right">{{ currency($item['gaji']) }}</td>
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
            _title.innerHTML = obj.jabatan;
            return `
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Jabatan</div>
                    <div class="col-md-8 text-muted">${obj.jabatan || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Golongan</div>
                    <div class="col-md-8 text-muted">${obj.golongan || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Gaji</div>
                    <div class="col-md-8 text-muted">${formatter.format(obj.gaji) || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Tunjangan</div>
                    <div class="col-md-8 text-muted">${formatter.format(obj.tunjangan) || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Total</div>
                    <div class="col-md-8 text-muted">${formatter.format((parseInt(obj.tunjangan)+parseInt(obj.gaji))) || '-'}</div>
                </div>
            `;
        }

        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('view-item')) {
                const id = e.target.dataset.id;
                const url = parseUrl(`jabatan/read/${id}`);
                fetch(url).then(data => data.json()).then(data => {
                    _body.innerHTML = generateBody(data);
                });
            }
        });

    </script>
@endpush