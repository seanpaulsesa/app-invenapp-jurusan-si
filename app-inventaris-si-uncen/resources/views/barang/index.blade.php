@extends('layouts.app')

@section('title', 'Barang')

@section('css')
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css" rel="stylesheet">
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
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Barang</h6>
                            @if(Auth::user()->role != 'pimpinan')
                            <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm mb-3">Tambah Barang</a>
                            @endif
                        </div>
                        <div class="card-body">

                        

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th width="100px">Gambar</th>
                                            <th>Kategori</th>
                                            <th>Satuan</th>
                                            <th>Jumlah Satuan</th>
                                            <th>Harga Satuan</th>
                                            <th>Jumlah Harga</th>
                                            <th>Keterangan</th>
                                            <th>Terakhir Diubah</th>
                                            @if(Auth::user()->role != 'pimpinan')
                                            <th></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($datas as $data)
                                            <tr>
                                                <td></td>
                                                <td>{{ $data->nama }}</td>
                                                <td><img src="{{ $data->gambar ? asset('storage/' . $data->gambar) : asset('image/image-placeholder.png') }}" alt="Gambar" width="100%"></td>
                                                <td>{{ $data->kategori->nama_kategori }}</td>
                                                <td>{{ $data->satuan }}</td>
                                                <td>{{ $data->jumlah_satuan }}</td>
                                                <td>Rp.{{ number_format($data->harga_satuan, 0, ',', '.') }},-</td>
                                                <td>Rp.{{ number_format($data->jumlah_harga, 0, ',', '.') }},-</td>
                                                <td>{{ $data->keterangan }}</td>
                                                <td>{{ $data->updated_at->diffForHumans() }} <br/> {{ $data->updated_at->translatedFormat('l, d F Y') }}</td>
                                                @if(Auth::user()->role != 'pimpinan')
                                                <td class="d-flex justify-content-center">

                                                    <!-- view button -->
                                                    {{-- <a href="{{ route('barang.show', $data->id) }}" class="btn btn-info btn-sm">View</a> --}}
                                                    <!-- edit and delete buttons -->
                                                    <a href="{{ route('barang.edit', $data->id) }}" class="btn text-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                    
                                                    <!-- Tombol Hapus -->
                                                    <button type="button" class="btn btn-sm" onclick="confirmDelete('{{ route('barang.destroy', $data->id) }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No data available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>


                                <!-- Modal Konfirmasi Hapus -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus barang ini secara permanen? <b>Tindakan ini tidak dapat dibatalkan setelah Anda klik tombol Hapus</b>.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <form id="deleteForm" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
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
    <!-- DataTables -->
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- JSZip (for Excel export) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

    <script>
        function confirmDelete(url) {
            $('#deleteForm').attr('action', url);
            $('#deleteModal').modal('show');
        }
    </script>

    <!-- Inisialisasi DataTable -->
    <script>
        $(document).ready(function () {
        // Inisialisasi DataTable
        var table = $('#dataTable').DataTable({
            dom: '<"row mb-3"<"col-md-6"l><"col-md-6 d-flex justify-content-end align-items-center"fB>>rtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<div class="d-flex align-items-center"><i class="fas fa-file-excel"></i> Export</div>',
                    className: 'btn btn-success btn-sm ml-2',
                    titleAttr: 'Export ke Excel',
                    exportOptions: {
                        columns: ':visible:not(:last-child)' // kecualikan kolom aksi
                    }
                }
            ],
            columnDefs: [
                { searchable: false, orderable: false, targets: 0 }
            ],
            order: [[1, 'asc']]
        });

        // Nomor urut otomatis di kolom pertama
        table.on('order.dt search.dt', function () {
            table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        // Buat elemen dropdown filter kategori
        var kategoriFilter = `
            <label class="ml-2 mb-0 d-flex align-items-center">
                <span class="mr-2">Kategori:</span>
                <select id="filterKategori" class="form-control form-control-sm">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoriBarang as $item)
                        <option value="{{ $item->nama_kategori }}">{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>
            </label>`;

        // Tambahkan dropdown ke toolbar DataTables
        $('.dt-buttons').after(kategoriFilter);

        // Filter berdasarkan kategori (asumsikan kolom ke-3 adalah kategori)
        $('#filterKategori').on('change', function () {
            table.column(3).search(this.value).draw();
        });
    });
    </script>
@endpush

