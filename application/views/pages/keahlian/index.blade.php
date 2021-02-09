@extends('layout.base.table')

@section('thead')
<thead>
    <tr>
        <th>No.</th>
        <th>Keahlian</th>
        <th>Bidang</th>
        <th>Keterangan</th>
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
        <td>{{ $item['keahlian'] }}</td>
        <td>{{ $item['bidang'] }}</td>
        <td width="40%" class="text-justify">{{ null_field(truncate($item['keterangan'], 175)) }}</td>
        <td class="text-center">
            {!! action_menu($item['keahlian_id']) !!}
        </td>
    </tr>
    @endforeach
</tbody>
@endsection

@push('scripts')
    <script>
        const generateBody = (obj) => {
            _title.innerHTML = obj.keahlian;
            return `
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Keahlian</div>
                    <div class="col-md-8 text-muted">${obj.keahlian || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Bidang</div>
                    <div class="col-md-8 text-muted">${obj.bidang || '-'}</div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-right font-weight-bold">Keterangan</div>
                    <div class="col-md-8 text-muted text-justify pr-5">${obj.keterangan || '-'}</div>
                </div>
            `;
        }

        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('view-item')) {
                const id = e.target.dataset.id;
                const url = parseUrl(`keahlian/read/${id}`);
                fetch(url).then(data => data.json()).then(data => {
                    _body.innerHTML = generateBody(data);
                });
            }
        });

    </script>
@endpush