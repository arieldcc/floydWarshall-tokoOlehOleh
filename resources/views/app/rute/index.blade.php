@extends('layouts.app')
@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ url('/') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            margin: 0 auto; /* Center the table */
            text-align: center;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        table td {
            background-color: #ffffe0;
        }
        .infinity-symbol {
            font-family: "Times New Roman", Times, serif; /* Make the infinity symbol look nicer */
        }
    </style>

    <style>
        #mynetwork {
            width: 100%;
            height: 400px;
            border: 1px solid lightgray;
            background-color: #f9f9f9;
        }
    </style>
@endsection
@section('isi')
    <h1 class="h3 mb-4 text-gray-800">Data Simpul Rute</h1>

    <div class="row">
        <div class="col-lg-12">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Proses Algoritma Floyd Warshall</h6>
                </div>
                <div class="card-body">

                    {{-- <table width='100%'>
                        <tr>
                            <th></th> <!-- Empty top-left cell for headers -->
                            @foreach ($distances as $start => $destinationDistances)
                                <th>{{ $start }}</th> <!-- Column headers -->
                            @endforeach
                        </tr>
                        @foreach ($distances as $start => $destinationDistances)
                            <tr>
                                <th>{{ $start }}</th> <!-- Row headers -->
                                @foreach ($destinationDistances as $end => $distance)
                                    <td class="{{ $distance == INF ? 'infinity-symbol' : '' }}">
                                        {{ $distance == INF ? '&infin;' : $distance }}
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table> --}}

                    @foreach ($history as $tableHtml)
                        {!! $tableHtml !!}
                    @endforeach

                    <h1>Visualisasi Graf</h1>
                    <div id="mynetwork"></div>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>

    <script type="text/javascript">
        // Ini akan menggunakan data yang dikirim dari controller
        var nodes = new vis.DataSet(@json($visualNodes));
        var edges = new vis.DataSet(@json($visualEdges));

        // Inisialisasi jaringan
        var container = document.getElementById('mynetwork');
        var data = {
            nodes: nodes,
            edges: edges
        };
        var options = {
            nodes: {
                shape: 'dot',
                size: 20,
                font: {
                    size: 14
                }
            },
            edges: {
                font: {
                    align: 'horizontal'
                },
                arrows: {
                    to: { enabled: true }
                }
            }
        };
        var network = new vis.Network(container, data, options);
    </script>
@endsection
