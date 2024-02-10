@extends('layouts.app')

@section('css')
    <!-- Custom styles for this page -->
    <style>
        /* #mynetwork {
            width: 750px;
            height: 600px;

        } */
        #mynetwork {
            width: 100%;
            height: 50vh; /* 50% dari tinggi viewport */
            border: 1px solid lightgray;
            background-color: #f9f9f9;
        }

    </style>
@endsection
@section('isi')
    <h1 class="h3 mb-4 text-gray-800">Visualisasi Data Rute</h1>

    <div class="row">
        <div class="col-xl-6 col-lg-7 col-md-8 col-sm-10 col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Visualisasi Rute Terpendek</h6>
                </div>
                <div class="card-body">
                    <div id="mynetwork"></div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <h3>Detail Rute</h3>
                            <h5>Jalur : {{ implode(' -> ', $path) }}</h5>
                            <h5>Jarak : {{ $jarak }} meter / {{ $jarak/1000 }} KM</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>

    <script type="text/javascript">
        var nodes = new vis.DataSet(@json($visualNodes));
        var edges = new vis.DataSet(@json($visualEdges));
        var edgesArray = @json($path);
        var edges = new vis.DataSet();

        // Create an array with edges
        for (var i = 1; i < edgesArray.length; i++) {
            edges.add({
                from: edgesArray[i - 1],
                to: edgesArray[i]
            });
        }

        // Provide the data in the vis format
        var data = {
            nodes: nodes,
            edges: edges
        };
        var options = {
            edges: {
                arrows: 'to'
            }
        };

        // Initialize your network!
        var network = new vis.Network(document.getElementById('mynetwork'), data, options);
    </script>
@endsection
