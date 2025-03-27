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

                    @include('layouts.allerts')

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Formulir Tambah Data Barang</h6>
                            <a href="{{ route('barang') }}" class="btn btn-primary btn-sm mb-3">Kembali</a>
                        </div>
                        <div class="card-body">
                            
                        
                        <form action="{{ isset($data) ? route('barang.update', $data->id) : route('barang.store') }}" method="POST">
                            @csrf
                            @if(isset($data))
                                @method('PUT')
                            @endif

                            <!-- Nama Barang -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->nama ?? '' }}" required>
                            </div>

                            <!-- Kategori Barang -->
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori Barang</label>
                                <select class="form-control" id="kategori_id" name="kategori_id" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategoriBarang as $item)
                                        <option value="{{ $item->id }}" {{ isset($data) && $data->kategori_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Keterangan -->
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ $data->keterangan ?? '' }}</textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>

                        </div>

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