@extends('layouts.app')

@section('title', 'Ruangan')

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
                    <h1 class="h3 mb-2 text-gray-800">{{ $pageTitle ?? 'page title' }}</h1>
                    <p class="mb-4">{{ $pageDescription ?? 'page description' }}</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Informasi {{ $pageTitle }}</h6>
                            <a href="{{ route('ruangan') }}" class="btn btn-primary btn-sm mb-3">Kembali</a>
                        </div>
                        <div class="card-body">
                            
                        <!-- Nama Kategori Ruangan -->
                        <div class="mb-3">
                            <label>Nama Kategori Ruangan:</label>
                            <p class="form-control">{{ $data->nama_kategori }}</p>
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-3">
                            <label>Keterangan:</label>
                            <p class="form-control">{{ $data->keterangan ?? '-' }}</p>
                        </div>

                        <a href="{{ route('kategori-ruangan.edit', $data->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('kategori-ruangan') }}" class="btn btn-outline-primary">Kembali</a>

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