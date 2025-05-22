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
                            <h6 class="m-0 font-weight-bold text-primary">Formulir {{ $pageTitle }}</h6>
                            <a href="{{ route('kategori-barang') }}" class="btn btn-primary btn-sm mb-3">Kembali</a>
                        </div>
                        <div class="card-body">
                            
                        
                        <form action="{{ isset($data) ? route('kategori-barang.update', $data->id) : route('kategori-barang.store') }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            @if(isset($data))
                                @method('PUT')
                            @endif

                            <!-- Nama Barang -->
                            <div class="mb-3">
                                <label for="nama_kategori" class="form-label">Nama Kategori Barang</label>
                                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', isset($data) ? $data->nama_kategori : '') }}">
                                @if ($errors->has('nama_kategori'))
                                    <div class="text-danger">
                                        {{ $errors->first('nama_kategori') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Keterangan -->
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ $data->keterangan ?? '' }}</textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('kategori-barang') }}" class="btn btn-outline-primary">Tutup</a>

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
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();
            var spinner = document.getElementById('loading-spinner');
            var imgElement = document.getElementById('preview-image');

            // Tampilkan spinner & sembunyikan gambar sementara
            spinner.style.display = 'block';
            imgElement.style.display = 'none';

            reader.onload = function(){
                setTimeout(function() { // Tunggu 1 detik sebelum menampilkan gambar
                    spinner.style.display = 'none';
                    imgElement.src = reader.result;
                    imgElement.style.display = 'block';
                }, 500);
            };

            reader.readAsDataURL(input.files[0]); // Baca file sebagai URL
        }
    </script>

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