<?php

use App\Models\EdgeModel;
use App\Models\node;

function buildInitialMatrix() {
    $nodes = node::all();
    $edges = EdgeModel::all();

    // Membangun matriks awal
    $distances = [];
    foreach ($nodes as $node) {
        $distances[$node->id] = [];
        foreach ($nodes as $innerNode) {
            $distances[$node->id][$innerNode->id] = $node->id == $innerNode->id ? 0 : INF;
        }
    }

    // Isi matriks dengan jarak dari edge
    foreach ($edges as $edge) {
        $distances[$edge->awal_id][$edge->akhir_id] = $edge->weight;
    }

    return $distances;
}

function floydWarshall($distances){
    $nodes = node::all();
    foreach ($nodes as $k) {
        foreach ($nodes as $i) {
            foreach ($nodes as $j) {
                if ($distances[$i->id][$k->id] + $distances[$k->id][$j->id] < $distances[$i->id][$j->id]) {
                    $distances[$i->id][$j->id] = $distances[$i->id][$k->id] + $distances[$k->id][$j->id];
                }
            }
        }
    }

    return $distances;
}

// Fungsi pembantu untuk membuat tabel jarak pada iterasi saat ini
function createTable($distances, $title)
{
    $table = "<h2>$title</h2>";
    $table .= '<table border="1" width="100%"><tr><th></th>';

    foreach ($distances as $start => $destinationDistances) {
        $table .= "<th>$start</th>";
    }
    $table .= '</tr>';

    foreach ($distances as $start => $destinationDistances) {
        $table .= "<tr><th>$start</th>";
        foreach ($destinationDistances as $end => $distance) {
            $table .= '<td>' . ($distance == INF ? '∞' : $distance) . '</td>';
        }
        $table .= '</tr>';
    }
    $table .= '</table>';
    return $table;
}
