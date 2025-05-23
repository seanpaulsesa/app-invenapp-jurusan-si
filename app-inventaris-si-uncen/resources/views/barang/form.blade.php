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
                            <a href="{{ route('barang') }}" class="btn btn-primary btn-sm mb-3">Kembali</a>
                        </div>
                        <div class="card-body">
                            
                        
                        <form action="{{ isset($data) ? route('barang.update', $data->id) : route('barang.store') }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            @if(isset($data))
                                @method('PUT')
                            @endif

                            <!-- Nama Barang -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Barang</label>
                                <input 
                                    type="text" 
                                    class="form-control @error('nama') is-invalid @enderror" 
                                    id="nama" 
                                    name="nama" 
                                    value="{{ old('nama', isset($data) ? $data->nama : '') }}"
                                >
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Kategori Barang -->
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori Barang</label>
                                <select 
                                    class="form-control @error('kategori_id') is-invalid @enderror" 
                                    id="kategori_id" 
                                    name="kategori_id"
                                >
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategoriBarang as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('kategori_id', isset($data) ? $data->kategori_id : '') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Satuan -->
                            <div class="mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <input type="text" class="form-control" id="satuan" name="satuan" value="{{ $data->satuan ?? '' }}">
                            </div>

                            <!-- Jumlah Satuan -->
                            <div class="mb-3">
                                <label for="jumlah_satuan" class="form-label">Jumlah Satuan</label>
                                <input type="number" class="form-control" id="jumlah_satuan" name="jumlah_satuan" value="{{ $data->jumlah_satuan ?? '' }}">
                            </div>

                            <!-- Harga Satuan -->
                            <div class="mb-3">
                                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" value="{{ $data->harga_satuan ?? '' }}">
                            </div>

                            <!-- Keterangan -->
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ $data->keterangan ?? '' }}</textarea>
                            </div>

                            <!-- Upload Gambar -->
                            <div class="mb-3">

                                <label for="gambar" class="form-label">Gambar</label>
                                <!-- Preview Gambar -->
                                <div class="mb-2">
                                    <img id="preview-image" src="{{ isset($data) && $data->gambar ? asset('storage/' . $data->gambar) : asset('image/image-placeholder.png') }}" alt="Preview Gambar" width="150" class="img-thumbnail">
                                </div>

                                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">

                                <!-- Spinner Loading -->
                                <div id="loading-spinner" class="mt-2" style="display: none;">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('barang') }}" class="btn btn-outline-primary">Tutup</a>

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