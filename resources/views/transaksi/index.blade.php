@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Pesanan</div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">Nama Produk : {{ $detail->product->nama }}</li>
                        <li class="list-group-item">Dipesan oleh : {{ $detail->user->name }}</li>
                        <li class="list-group-item">Email : {{ $detail->user->email }}</li>
                        <li class="list-group-item">Diantarkan oleh : {{ $detail->courir->user->name }}</li>
                        <li class="list-group-item">Alamat : {{ $detail->address->address }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8 mt-3">
            <div class="card">
                <div class="card-header">Track Lokasi</div>

                <div class="card-body">
                    <div id="map" style="width: 100%;height: 400px;" ;></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
<script>
    var map = L.map('map', {
        center: ["{{ $detail->address->latitude }}", "{{ $detail->address->longitude }}"],
        zoom: 13
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
    }).addTo(map);

    L.marker(["{{ $detail->address->latitude }}", "{{ $detail->address->longitude }}"], {
        draggable: false
    }).addTo(map);

</script>
@endpush
