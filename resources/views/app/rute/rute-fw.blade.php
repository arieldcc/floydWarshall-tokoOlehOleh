@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

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

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('isi')
    <h1 class="h3 mb-4 text-gray-800">Form Rute Floyd Warshall</h1>
    <div class="row">
        <div class="col-lg-6">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Input Rute</h6>
                </div>
                <div class="card-body">

                    <form method="POST" action="/data-rutefwproses">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="awal_id">Berasal dari Jalan:</label>
                                <select class="js-example-basic-single form-control @error('awal_id') is-invalid @enderror" id="awal_id" name="awal_id">
                                    <option value="">-- Pilih Jalan Awal --</option>
                                    @foreach ($jalan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_jalan }}</option>
                                    @endforeach

                                </select>
                                @if ($errors->has('awal_id'))
                                    <span class="help-block">{{ $errors->first('awal_id') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="akhir_id">Toko Tujuan</label>
                                <select class="js-example-basic-single form-control @error('akhir_id') is-invalid @enderror" id="akhir_id" name="akhir_id" disabled>
                                    <option value="">-- Pilih Nama Toko --</option>
                                    @foreach ($toko as $item)
                                        <option value="{{ $item->node_id }}">{{ $item->nama_toko }}</option>
                                    @endforeach

                                </select>
                                @if ($errors->has('akhir_id'))
                                    <span class="help-block">{{ $errors->first('akhir_id') }}</span>
                                @endif
                            </div>
                        </div>


                        <div class="my-4"></div>
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="far fa-save"></i>
                            </span>
                            <span class="text">Cari Rute</span>
                        </button>
                        <a href="/data-fw" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-redo"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                    </form>

                    <div class="rutefw">

                    </div>

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
    <!-- Tambahkan jQuery jika menggunakan jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    {{-- <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script> --}}
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

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

        let latAwal;
        let longAwal;
        let latAkhir;
        let longAkhir;
        let marker=null;
        var routingControl;
        var node_awal;
        var node_akhir;



        $('#awal_id').change(function() {
            node_awal = $(this).val();
            console.log('Node Awal: ' + node_awal);
            if(node_awal) {
                $.getJSON('/get-awal/' + node_awal, function(data) {
                    // console.log(data.lat);
                    // Lakukan sesuatu dengan data
                    latAwal = data.lat;
                    longAwal = data.long;
                    // var marker = L.marker([data.lat, data.long], {
                    //     draggable: true
                    // }).addTo(map);
                });
            }

            if($(this).val() != "") {
                $('#akhir_id').val('').trigger('change');
                $('#akhir_id').prop('disabled', false);
                if (routingControl != undefined) {
                    map.removeControl(routingControl); // Hapus kontrol rute sebelumnya jika ada
                }
            } else {
                $('#akhir_id').val('').trigger('change');
                $('#akhir_id').prop('disabled', true);
                map.removeControl(routingControl);
            }
        });

        $('#akhir_id').change(function() {
            node_akhir = $(this).val();
            console.log('Node Akhir: ' + node_akhir);
            if(node_akhir) {
                $.getJSON('/get-akhir/' + node_akhir, function(data) {
                    if (routingControl != undefined) {
                        map.removeControl(routingControl); // Hapus kontrol rute sebelumnya jika ada
                    }
                    routingControl = L.Routing.control({
                        waypoints: [
                            L.latLng(latAwal, longAwal),
                            L.latLng(data.lat, data.long)
                        ],
                        routeWhileDragging: true,
                        // showAlternatives: true
                    }).addTo(map);

                    // Karena routingControl baru diinisialisasi di sini,
                    // Anda perlu menempatkan event listener di dalam callback ini
                    var jarak;
                    var waktu;
                    routingControl.on('routesfound', function(e) {
                        var routes = e.routes;
                        var summary = routes[0].summary;
                        jarak = summary.totalDistance;
                        waktu = (summary.totalTime/60);
                    });

                });

                // $.getJSON('/rutefw/' + node_awal + '/' +node_akhir, function(data) {

                // });
            }
        });

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
