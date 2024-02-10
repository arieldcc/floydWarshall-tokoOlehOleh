@extends('layouts.app')
@section('css')
    <!-- Custom styles for this page -->
    <link href="{{ url('/') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('isi')
    <h1 class="h3 mb-4 text-gray-800">Data Edge</h1>

    <div class="row">
        <div class="col-lg-12">

            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Edge/Hubungan antar titik jalan</h6>
                </div>
                <div class="card-body">

                    <a href="tambah-edge" class="btn btn-primary float-end btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        <span class="text">Tambah Data</span>
                    </a>
                    <div class="my-2"></div>

                    <table class='class="table table-responsive table-bordered table-sm" width="100%" cellspacing="0"' id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Jalan Awal</th>
                                <th>Jalan Tujuan</th>
                                <th>Jarak (Meter)</th>
                                <th>Waktu Tempuh (Menit)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Jalan Awal</th>
                                <th>Jalan Tujuan</th>
                                <th>Jarak (Meter)</th>
                                <th>Waktu Tempuh (Menit)</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $data)
                                <tr>
                                    <td align="center">{{ $no++ }}</td>
                                    <td>{{ $data->startNode->nama_jalan }}</td>
                                    <td>{{ $data->endNode->nama_jalan }}</td>
                                    <td>{{ $data->weight }}</td>
                                    <td>{{ $data->time }}</td>
                                    <td>
                                        <a href="/data-edge/{{ $data->id }}/edit"
                                            class="btn btn-info btn-circle btn-sm">
                                            {{-- <i class="fas fa-info-circle"></i> --}}
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-circle btn-sm hapus"
                                            edge-id="{{ $data->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <!-- Page level plugins -->
    <script src="{{ url('/') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ url('/') }}/js/demo/datatables-demo.js"></script>
    <script src="{{ url('/') }}/js/sweetalert.min.js"></script>

    <script>
        $('.hapus').click(function() {
            var edge_id = $(this).attr('edge-id')

            swal({
                    title: "Yakin ?",
                    text: "Data akan di hapus?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/data-edge/" + edge_id + "/delete";
                    }
                });
        });
    </script>
@endsection
