@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(isset($data))
                <div class="card-header">Tambah alamat</div>

                <div class="card-body">
                    <form action="{{ url('address/edit') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="form-control"
                                value="{{ $data->longitude }}">
                        </div>
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="form-control"
                                value="{{ $data->latitude }}">
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" class="form-control">{{ $data->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Pilih lokasi</label>
                            <div id="map" style="width: 100%;height: 400px;"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Simpan data</button>
                        </div>
                    </form>
                </div>
                @else
                <div class="card-header">Tambah alamat</div>

                <div class="card-body">
                    <form action="{{ url('address/add') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Pilih lokasi</label>
                            <div id="map" style="width: 100%;height: 400px;"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Simpan data</button>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
@if(isset($data))
<script>
    var map = L.map('map', {
        center: ["{{ $data->latitude }}", "{{ $data->longitude }}"],
        zoom: 13
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
    }).addTo(map);

    var marker = L.marker(["{{ $data->latitude }}", "{{ $data->longitude }}"], {
        draggable: true
    }).addTo(map);

    marker.on('dragend', function (e) {
        $.get('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=' + marker.getLatLng().lat +
            '&lon=' + marker.getLatLng().lng,
            function (data) {
                $('#address').val(data.address.road + ', ' + data.address.city_district + ', ' +
                    data.address.municipality + ', ' + data.address.county + ', ' + data.address
                    .state_district + ', ' + data.address.country + ', ' + data.address.postcode);
            });
        $('#latitude').val(marker.getLatLng().lat);
        $('#longitude').val(marker.getLatLng().lng);
    })

</script>
@else
<script>
    var map = L.map('map', {
        center: [-6.1744, 106.8294],
        zoom: 13
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
    }).addTo(map);

    var marker = L.marker([-6.1744, 106.8294], {
        draggable: true
    }).addTo(map);

    marker.on('dragend', function (e) {
        $.get('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=' + marker.getLatLng().lat +
            '&lon=' + marker.getLatLng().lng,
            function (data) {
                $('#address').val(data.address.road + ', ' + data.address.city_district + ', ' +
                    data.address.municipality + ', ' + data.address.county + ', ' + data.address
                    .state_district + ', ' + data.address.country + ', ' + data.address.postcode);
            });
        $('#latitude').val(marker.getLatLng().lat);
        $('#longitude').val(marker.getLatLng().lng);
    })

</script>
@endif
@endpush
