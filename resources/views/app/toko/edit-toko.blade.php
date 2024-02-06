@extends('layouts.app')
@section('isi')
    <h1 class="h3 mb-4 text-gray-800">Data Data Toko</h1>

    <div class="row">
        <div class="col-lg-12">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Data Toko</h6>
                </div>
                <div class="card-body">

                    <form method="POST" action="/data-toko/{{ $toko->id }}/update" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama_toko">Nama Toko</label>
                                <input type="text" class="form-control @error('nama_toko') is-invalid @enderror" id="nama_toko" placeholder="Nama Toko"
                                    name="nama_toko" value="{{ $toko->nama_toko }}">
                                @if ($errors->has('nama_toko'))
                                    <span class="help-block">{{ $errors->first('nama_toko') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="pemilik">Pemilik Toko</label>
                                <input type="text" class="form-control @error('pemilik') is-invalid @enderror" id="pemilik" placeholder="Pemilik Toko"
                                    name="pemilik" value="{{ $toko->pemilik }}">
                                @if ($errors->has('pemilik'))
                                    <span class="help-block">{{ $errors->first('pemilik') }}</span>
                                @endif
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="node_id">Nama Jalan</label>
                                <select class="form-control @error('node_id') is-invalid @enderror" id="node_id" name="node_id">
                                    <option value="">-- Pilih Jalan --</option>
                                    @foreach ($jalan as $item)
                                        <option value="{{ $item->id }}" {{ $item->id==$toko->node_id ? 'selected' : '' }}>{{ $item->nama_jalan }}</option>
                                    @endforeach

                                </select>
                                @if ($errors->has('node_id'))
                                    <span class="help-block">{{ $errors->first('node_id') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="no_telp">No. Telp/WA</label>
                                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" placeholder="No. Telp/WA"
                                    name="no_telp" value="{{ $toko->no_telp }}">
                                @if ($errors->has('no_telp'))
                                    <span class="help-block">{{ $errors->first('no_telp') }}</span>
                                @endif
                            </div>


                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="alamat_lengkap">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" id="alamat_lengkap" rows="5" class="form-control @error('alamat_lengkap') is-invalid @enderror">{{ $toko->alamat_lengkap }}</textarea>
                                @if ($errors->has('alamat_lengkap'))
                                    <span class="help-block">{{ $errors->first('alamat_lengkap') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="ket">Keterangan/Produk yang dijual</label>
                                <textarea name="ket" id="ket" rows="5" class="form-control @error('ket') is-invalid @enderror">{{ $toko->ket }}</textarea>
                                @if ($errors->has('ket'))
                                    <span class="help-block">{{ $errors->first('ket') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="waktu_buka">Waktu Toko Beroperasi</label>
                                <input type="text" class="form-control @error('waktu_buka') is-invalid @enderror" id="waktu_buka" placeholder="Waktu Toko Beroperasi"
                                    name="waktu_buka" value="{{ $toko->waktu_buka }}">
                                @if ($errors->has('waktu_buka'))
                                    <span class="help-block">{{ $errors->first('waktu_buka') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="logo">Gambar/Logo Toko</label>
                                <input type="hidden" name="oldLogo" value="{{ $toko->logo }}">
                                <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo" name="logo" onchange="previewImage()">
                                @if ($errors->has('logo'))
                                <span class="help-block">{{ $errors->first('logo') }}</span>
                                @endif
                                <div class="my-2"></div>
                                @if ($toko->logo)
                                    <img src="{{ asset('storage') .'/'. $toko->logo }}" alt=""
                                        class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                @else
                                    <img class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                @endif
                            </div>

                        </div>


                        <div class="my-4"></div>
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="far fa-save"></i>
                            </span>
                            <span class="text">Update</span>
                        </button>
                        <a href="/data-toko" class="btn btn-warning btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-redo"></i>
                            </span>
                            <span class="text">Kembali</span>
                        </a>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        function previewImage() {
            const image = document.querySelector('#logo');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'blok';

            const ofReader = new FileReader();
            ofReader.readAsDataURL(image.files[0]);

            ofReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
