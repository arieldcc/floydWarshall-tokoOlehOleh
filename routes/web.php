<?php

use App\Http\Controllers\EdgeController;
use App\Http\Controllers\JalanController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\TokoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $menu = '';
    return view('layouts/app', compact('menu'));
});

Route::controller(JalanController::class)->group(function(){
    Route::get('/data-jalan','awal');
    Route::get('/tambah-jalan','tambah_jalan');
    Route::post('/simpan-jalan','simpan_jalan');
    Route::get('/data-jalan/{jalan}/edit','edit_jalan');
    Route::post('/data-jalan/{jalan}/update','update_jalan');
    Route::get('/data-jalan/{jalan}/delete','hapus_jalan');
});

Route::controller(TokoController::class)->group(function(){
    Route::get('/data-toko', 'awal');
    Route::get('/tambah-toko', 'tambah_toko');
    Route::post('/simpan-toko', 'simpan_toko');
    Route::get('/data-toko/{toko}/edit', 'edit_toko');
    Route::post('/data-toko/{toko}/update', 'update_toko');
    Route::get('/data-toko/{toko}/delete', 'hapus_toko');
    Route::get('/floyd-warshall', 'cobaAlgo');
});

Route::controller(EdgeController::class)->group(function(){
    Route::get('/data-edge','awal');
    Route::get('/tambah-edge','tambah_edge');
    Route::post('/simpan-edge','simpan_edge');
    Route::get('/data-edge/{edge}/edit','edit_edge');
    Route::post('/data-edge/{edge}/update','update_edge');
    Route::get('/data-edge/{edge}/delete','hapus_edge');
    Route::get('/get-awal/{id}','get_awal');
    Route::get('/get-akhir/{id}','get_akhir');
});

Route::controller(RuteController::class)->group(function(){
    Route::get('/data-fw','awal');
    Route::get('/data-rutefw','rute_fw');
    Route::post('/data-rutefwproses','findShortestPath');
});
