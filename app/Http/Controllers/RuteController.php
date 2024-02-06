<?php

namespace App\Http\Controllers;

use App\Models\EdgeModel;
use App\Models\node;
use App\Models\TokoModel;
use Illuminate\Http\Request;

class RuteController extends Controller
{
    public function awal(){
        $menu ='data-fw';

        $distances = buildInitialMatrix();
        // $shortestPathsMatrix = floydWarshall($distances);
        $nodes = node::all();
        $edges = EdgeModel::all();
        $history = []; // Menyimpan riwayat setiap langkah

        // Implementasi algoritma Floyd Warshall
        foreach ($nodes as $k) {
            foreach ($nodes as $i) {
                foreach ($nodes as $j) {
                    if ($distances[$i->id][$k->id] + $distances[$k->id][$j->id] < $distances[$i->id][$j->id]) {
                        $distances[$i->id][$j->id] = $distances[$i->id][$k->id] + $distances[$k->id][$j->id];
                        // Menyimpan langkah saat ini dalam riwayat
                        $history[] = createTable($distances, "Iterasi k={$k->id}, i={$i->id}, j={$j->id}");
                    }
                }
            }
        }

        // Membangun struktur data nodes dan edges untuk vis.js
        $visualNodes = $nodes->map(function ($node) {
            return ['id' => $node->id, 'label' => (string) $node->id];
        });

        $visualEdges = $edges->map(function ($edge) {
            return ['from' => $edge->awal_id, 'to' => $edge->akhir_id, 'label' => $edge->weight];
        });

        // $distances sekarang berisi jarak terpendek antara semua pasangan simpul
        return view('app.rute.index', compact('menu','distances','history', 'visualNodes', 'visualEdges'));
    }

    public function rute_fw(){
        $menu = 'data-rutefw';
        $jalan = node::all(); // Mengambil edge pertama
        $toko = TokoModel::all();

        return view('app.rute.rute-fw',compact('menu','jalan','toko'));
    }

    public function findShortestPath(Request $request)
    {
        $menu = 'data-rute';
        // Retrieve all nodes and edges from the database
        $nodes = node::all();
        $edges = EdgeModel::all();

        // Initialize distance and next matrix
        $distance = array();
        $next = array();

        // Initialize the distance to INF and next matrix to null
        foreach ($nodes as $i) {
            foreach ($nodes as $j) {
                $distance[$i->id][$j->id] = INF;
                $next[$i->id][$j->id] = null;
            }
            $distance[$i->id][$i->id] = 0;
        }

        // Populate distance with the weight of the edges
        foreach ($edges as $edge) {
            $distance[$edge->awal_id][$edge->akhir_id] = $edge->weight;
            $next[$edge->awal_id][$edge->akhir_id] = $edge->akhir_id;
        }

        // Implementing the Floyd-Warshall algorithm
        foreach ($nodes as $k) {
            foreach ($nodes as $i) {
                foreach ($nodes as $j) {
                    if ($distance[$i->id][$k->id] + $distance[$k->id][$j->id] < $distance[$i->id][$j->id]) {
                        $distance[$i->id][$j->id] = $distance[$i->id][$k->id] + $distance[$k->id][$j->id];
                        $next[$i->id][$j->id] = $next[$i->id][$k->id];
                    }
                }
            }
        }

        // Function to reconstruct path
        $path = $this->reconstructPath($request->awal_id, $request->akhir_id, $next);

        // Dapatkan node dan edge yang dibutuhkan untuk visualisasi
        $visualNodes = $nodes->map(function($node) {
            return ['id' => $node->id, 'label' => $node->nama_jalan];
        });

        $visualEdges = collect();
        foreach ($edges as $edge) {
            $visualEdges->push(['from' => $edge->awal_id, 'to' => $edge->akhir_id, 'label' => $edge->weight]);
        }

        $jarak = $distance[$request->awal_id][$request->akhir_id];
        // dd($jarak);

        // Return the shortest path and its total distance
        return view('app.rute.hasilfw', compact('menu','path', 'jarak', 'visualNodes', 'visualEdges'));
        // return response()->json([
        //     'path' => $path,
        //     'distance' => $distance[$request->awal_id][$request->akhir_id],
        // ]);
    }

    private function reconstructPath($startNodeId, $endNodeId, $next)
    {
        if ($next[$startNodeId][$endNodeId] === null) {
            return [];
        }

        $path = [$startNodeId];
        while ($startNodeId != $endNodeId) {
            $startNodeId = $next[$startNodeId][$endNodeId];
            $path[] = $startNodeId;
        }
        return $path;
    }

}
