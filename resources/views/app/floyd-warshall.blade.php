@extends('layouts.master')
@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ url('/') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('isi')
    <h1 class="h3 mb-4 text-gray-800">Layanan Desa</h1>

    <div class="row">
        <div class="col-lg-12">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Layanan dan Persyaratan</h6>
                </div>
                <div class="card-body">
                    <?php
// Fungsi untuk mencetak hasil matrix
function printSolution($distance, $V) {
    echo "Matrix jarak terpendek antar semua pasangan vertex:<br>";
    for ($i = 0; $i < $V; $i++) {
        for ($j = 0; $j < $V; $j++) {
            if ($distance[$i][$j] == PHP_INT_MAX) {
                echo "INF ";
            } else {
                echo $distance[$i][$j] . " ";
            }
        }
        echo "<br>";
    }
}

// Implementasi algoritma Floyd-Warshall
function floydWarshall($graph, $V) {
    $distance = array();

    // Inisialisasi matrix solusi yang sama seperti matrix input graf
    for ($i = 0; $i < $V; $i++) {
        for ($j = 0; $j < $V; $j++) {
            $distance[$i][$j] = $graph[$i][$j];
        }
    }

    // Menambahkan semua vertex satu per satu ke set dari vertex antara
    for ($k = 0; $k < $V; $k++) {
        // Memilih semua vertex sebagai sumber satu per satu
        for ($i = 0; $i < $V; $i++) {
            // Memilih semua vertex sebagai tujuan untuk vertex sumber yang dipilih
            for ($j = 0; $j < $V; $j++) {
                // Jika vertex k berada di jalur terpendek dari i ke j, maka update nilai distance[i][j]
                if ($distance[$i][$k] + $distance[$k][$j] < $distance[$i][$j]) {
                    $distance[$i][$j] = $distance[$i][$k] + $distance[$k][$j];
                }
            }
        }
    }

    // Cetak matrix solusi
    printSolution($distance, $V);
}

// Driver Code
$V = 4; // Jumlah vertex dalam graf
$INF = PHP_INT_MAX;

// Matrix adjacency dari graf yang diberikan
$graph = array(
    array(0,   5,  $INF, 10),
    array($INF, 0,   3,  $INF),
    array($INF, $INF, 0,   1),
    array($INF, $INF, $INF, 0)
);

floydWarshall($graph, $V);
?>

</div>
</div>

</div>
</div>
@endsection

@section('js')
@endsection
