@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <style>
		html, body {
			height: 100%;
			margin: 0;
		}
		.leaflet-container {
			height: 400px;
			width: 800px;
			max-width: 100%;
			max-height: 100%;
		}
	</style>
@endsection
@section('isi')
    <h1 class="h3 mb-4 text-gray-800">Tambah Data Jalan</h1>
    <div class="row">
        <div class="col-lg-6">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data Jalan</h6>
                </div>
                <div class="card-body">

                    <form method="POST" action="/simpan-jalan">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="nama_jalan">Nama Jalan</label>
                                <input type="text" class="form-control" id="nama_jalan" placeholder="Nama Jalan"
                                    name="nama_jalan" value="{{ old('nama_jalan') }}">
                                @if ($errors->has('nama_jalan'))
                                    <span class="help-block">{{ $errors->first('nama_jalan') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="lat">Latitude</label>
                                <input type="text" class="form-control" id="lat" placeholder="Latitude"
                                    name="lat" value="{{ old('lat') }}">
                                @if ($errors->has('lat'))
                                    <span class="help-block">{{ $errors->first('lat') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="long">Longitude</label>
                                <input type="text" class="form-control" id="long" placeholder="Longitude"
                                    name="long" value="{{ old('long') }}">
                                @if ($errors->has('long'))
                                    <span class="help-block">{{ $errors->first('long') }}</span>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="form-row">
                            <div class="form-group col-md-12">
                                <div id="map" style="width: 800px; height: 400px;"></div>
                            </div>
                        </div> --}}


                        <div class="my-4"></div>
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="far fa-save"></i>
                            </span>
                            <span class="text">Simpan</span>
                        </button>
                        <a href="/data-jalan" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-redo"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-lg-6">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Peta</h6>
                </div>
                <div class="card-body">

                    <form method="POST">

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div id="map" style="width: 800px; height: 400px;"></div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
    // const map = L.map('map').setView([0.553839, 123.049102], 13);

	// const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	// 	maxZoom: 19,
	// 	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	// }).addTo(map);

	// const marker = L.marker([0.553839, 123.049102]).addTo(map)
	// 	.bindPopup('<b>Hello world!</b><br />I am a popup.').openPopup();

	// const circle = L.circle([0.553839, 123.049102], {
	// 	color: 'red',
	// 	fillColor: '#f03',
	// 	fillOpacity: 0.5,
	// 	radius: 500
	// }).addTo(map).bindPopup('I am a circle.');

	// const popup = L.popup()
	// 	.setLatLng([0.553839, 123.049102])
	// 	.setContent('I am a standalone popup.')
	// 	.openOn(map);

	// function onMapClick(e) {
	// 	popup
	// 		.setLatLng(e.latlng)
	// 		.setContent(`You clicked the map at ${e.latlng.toString()}`)
	// 		.openOn(map);
	// }

	// map.on('click', onMapClick);
    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });

        var Stadia_Dark = L.tileLayer(
            'https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
                maxZoom: 20,
                attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
            });

        var Esri_WorldStreetMap = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
            });

            var map = L.map('map', {
            center: [0.553839, 123.049102],
            zoom: 12,
            layers: [osm]
        })

        var marker = L.marker([0.553839, 123.049102], {
            draggable: true
        }).addTo(map);

        var baseMaps = {
            'Open Street Map': osm,
            'Esri World': Esri_WorldStreetMap,
            'Stadia Dark': Stadia_Dark
        }

        L.control.layers(baseMaps).addTo(map)

        // CARA PERTAMA
        function onMapClick(e) {
            // var nama_jalan  = document.querySelector("[name=nama_jalan]")
            var latitude  = document.querySelector("[name=lat]")
            var longitude  = document.querySelector("[name=long]")
            var lat = e.latlng.lat
            var lng = e.latlng.lng
            // var addr = e.address.road

            if (!marker) {
                marker = L.marker(e.latlng).addTo(map)
            } else {
                marker.setLatLng(e.latlng)
            }

            // nama_jalan.value = addr
            latitude.value = lat,
            longitude.value = lng
        }
        map.on('click',onMapClick)

    </script>

@endsection
