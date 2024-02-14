<?php

namespace App\Http\Controllers;

use App\Models\node;
use App\Models\TokoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

class TokoController extends Controller
{
    public function awal()
    {
        $menu = 'data-toko';
        $data = TokoModel::all();
        return view('app.toko.index', compact('menu','data'));
    }

    public function tambah_toko() {
        $menu = 'data-toko';
        $jalan = node::all();
        return view('app.toko.tambah-toko', compact('menu','jalan'));
    }

    public function simpan_toko(Request $request){
        // dd($request->all());
        $validasiData = $request->validate([
            'nama_toko' => 'required',
            'pemilik'   => 'required',
            'node_id'   => 'required',
            'no_telp'   => 'required',
            'alamat_lengkap'    => 'required',
            'ket'       => 'required',
            'waktu_buka'=> 'required',
            'logo'      => 'image|mimes:jpeg,png,jpg|file|max:500',
        ]);

        if($request->file('logo')){
            $validasiData['logo'] = $request->file('logo')->store('logo-toko');
        }

        // dd($validasiData['logo']);

        TokoModel::create($validasiData);

        return redirect('data-toko')->with('sukses','Data berhasil di simpan!');
    }

    public function edit_toko(TokoModel $toko){
        $menu = 'data-toko';
        $jalan = node::all();
        return view('app.toko.edit-toko',compact('menu','toko','jalan'));
    }

    public function update_toko(Request $request, TokoModel $toko){
        $validasiData = $request->validate([
            'nama_toko' => 'required',
            'pemilik'   => 'required',
            'node_id'   => 'required',
            'no_telp'   => 'required',
            'alamat_lengkap'    => 'required',
            'ket'       => 'required',
            'waktu_buka'=> 'required',
            'logo'      => 'image|mimes:jpeg,png,jpg|file|max:500',
        ]);

        if($request->file('logo')){
            if($request->oldLogo){
                Storage::delete($request->oldLogo);
            }
            $validasiData['logo'] = $request->file('logo')->store('logo-toko');
        }

        $toko->update($validasiData);
        return redirect('/data-toko')->with('update','Data berhasil di Update!');
    }

    public function hapus_toko($toko){
        $data = TokoModel::find($toko);
        $data->delete();

        if($data->logo){
            Storage::delete($data->logo);
        }

        return redirect('/data-toko')->with('delete','Data berhasil di Hapus!');
    }
}
