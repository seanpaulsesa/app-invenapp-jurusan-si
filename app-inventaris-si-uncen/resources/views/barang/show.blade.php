@extends('layouts.app')

@section('title', 'Barang')

@section('css')
<link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        @include('layouts.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">{{ $pageTitle }}</h1>
                    <p class="mb-4">{{ $pageDescription }}</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Informasi Detail Data Barang</h6>
                            <a href="{{ route('barang') }}" class="btn btn-primary btn-sm mb-3">Kembali</a>
                        </div>
                        <div class="card-body">
                            
                        <!-- Nama Barang -->
                        <div class="mb-3">
                            <label>Nama Barang:</label>
                            <p class="form-control">{{ $data->nama }}</p>
                        </div>

                        <!-- Kategori Barang -->
                        <div class="mb-3">
                            <label>Kategori:</label>
                            <p class="form-control">{{ $data->kategori->nama_kategori }}</p>
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-3">
                            <label>Keterangan:</label>
                            <p class="form-control">{{ $data->keterangan ?? '-' }}</p>
                        </div>

                        <!-- Preview Gambar -->
                        <div class="mt-2 mb-3">
                            <label class="d-block">Gambar:</label>
                            <img id="preview-image" src="{{ isset($data) && $data->gambar ? asset('storage/' . $data->gambar) : asset('image/placeholder.jpg') }}" alt="Preview Gambar" width="150" class="img-thumbnail">
                        </div>

                        <a href="{{ route('barang.edit', $data->id) }}" class="btn btn-primary">Edit</a>

                    </div>

                </div>
                <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    @include('layouts.footer')

    </div>
    <!-- End of Content Wrapper -->
    
@endsection

@push('scripts')
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable tbody tr').each(function (index) {
                $(this).find('td:first').text(index + 1);
            });
        });
    </script>

    <!-- Page level plugins -->
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>
@endpush