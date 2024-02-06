<?php

namespace App\Http\Controllers;

use App\Models\EdgeModel;
use App\Models\node;
use Illuminate\Http\Request;

class EdgeController extends Controller
{
    public function awal(){
        $menu = 'data-edge';
        $data = EdgeModel::all(); // Mengambil edge pertama
        // dd($edge); // Menampilkan startNode dari edge pertama

        return view('app.edge.index',compact('menu', 'data'));
    }

    public function tambah_edge(){
        $menu = 'data-edge';
        $jalan = node::all();
        return view('app.edge.tambah-edge',compact('menu','jalan'));
    }

    public function get_awal($id){
        $node_awal = node::find($id);
        return response()->json($node_awal);
    }

    public function get_akhir($id){
        $node_akhir = node::find($id);
        return response()->json($node_akhir);
    }

    public function simpan_edge(Request $request){
        // dd($request->all());
        $validasiData = $request->validate([
            'awal_id'   => 'required',
            'akhir_id'  => 'required',
            'weight'    => 'required',
            'time'      => 'required',
        ]);

        EdgeModel::create($validasiData);

        return redirect('/data-edge')->with('sukses','Data berhasil di Simpan!');
    }

    public function edit_edge(EdgeModel $edge){
        $menu = 'data-edge';
        $jalan = node::all();
        return view('app.edge.edit-edge', compact('menu', 'edge', 'jalan'));
    }

    public function update_edge(Request $request, EdgeModel $edge){
        $validasiData = $request->validate([
            'awal_id'   => 'required',
            'akhir_id'  => 'required',
            'weight'    => 'required',
            'time'      => 'required',
        ]);

        $edge->update($validasiData);
        return redirect('/data-edge')->with('update','Data Berhasil di Update!');
    }

    public function hapus_edge($edge){
        $data = EdgeModel::find($edge);
        $data->delete();

        return redirect('/data-edge')->with('delete','Data berhasil di Hapus!');
    }
}
