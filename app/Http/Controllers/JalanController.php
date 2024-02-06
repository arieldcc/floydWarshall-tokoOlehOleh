<?php

namespace App\Http\Controllers;

use App\Models\node;
use Illuminate\Http\Request;

class JalanController extends Controller
{
    public function awal(){
        $menu = 'data-jalan';
        $data = node::all();
        return view('app.jalan.index', compact('menu', 'data'));
    }

    public function tambah_jalan(){
        $menu = 'data-jalan';
        return view('app.jalan.tambah-jalan', compact('menu'));
    }

    public function simpan_jalan(Request $request){
        // dd($request->all());
        $this->validate($request,[
            'nama_jalan'    => 'required',
            'lat'           => 'required',
            'long'          => 'required',
        ]);

        $data = new node;
        $data->nama_jalan   = $request->nama_jalan;
        $data->lat          = $request->lat;
        $data->long         = $request->long;

        $data->save();

        return redirect('/data-jalan')->with('sukses','Data berhasil di simpan!');
    }

    public function edit_jalan(node $jalan){
        $menu = 'data-jalan';
        return view('app.jalan.edit-jalan',compact('menu', 'jalan'));
    }

    public function update_jalan(Request $request, node $jalan){
        $this->validate($request,[
            'nama_jalan'    => 'required',
            'lat'           => 'required',
            'long'          => 'required',
        ]);

        $jalan->update([
            'nama_jalan'    => $request->nama_jalan,
            'lat'           => $request->lat,
            'long'          => $request->long,
        ]);

        $jalan->update();

        return redirect('/data-jalan')->with('update','Data berhasil di Update!');
    }

    public function hapus_jalan($jalan){
        $data = node::find($jalan);
        $data->delete();

        return redirect('/data-jalan')->with('delete','Data berhasil di Hapus!');
    }
}
