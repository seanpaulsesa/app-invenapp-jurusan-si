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
                    <h1 class="h3 mb-2 text-gray-800">{{ $pageTitle }}</h1>
                    <p class="mb-4">{{ $pageDescription }}</p>

                    @include('layouts.allerts')

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Ruangan</h6>
                            <a href="{{ route('ruangan.create') }}" class="btn btn-primary btn-sm mb-3">Tambah Ruangan</a>
                        </div>
                        <div class="card-body">

                        

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Ruangan</th>
                                            <th width="100px">Gambar</th>
                                            <th>Kategori</th>
                                            <th>Keterangan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($datas as $data)
                                            <tr>
                                                <td></td>
                                                <td>{{ $data->nama }}</td>
                                                <td> 
                                                @if($data->gambar)
                                                    <img src="{{ asset('storage/' . $data->gambar) }}" alt="Gambar" width="100%">
                                                @else 
                                                    <img src="{{ asset('image/image-placeholder.png') }}" alt="Gambar Default" width="100%">
                                                @endif

                                                </td>
                                                <td>{{ $data->kategori->nama_kategori }}</td>
                                                <td>{{ $data->keterangan }}</td>
                                                <td>
                                                    <!-- view button -->
                                                    {{-- <a href="{{ route('ruangan.show', $data->id) }}" class="btn btn-info btn-sm">View</a> --}}
                                                    <!-- edit and delete buttons -->
                                                    <a href="{{ route('ruangan.edit', $data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                    
                                                    <!-- Tombol Hapus -->
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('ruangan.destroy', $data->id) }}')">
                                                        Hapus
                                                    </button>
                                                </td>
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
                                            Apakah Anda yakin ingin menghapus ruangan ini secara permanen? <b>Tindakan ini tidak dapat dibatalkan setelah Anda klik tombol Hapus</b>.
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
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS (Pastikan ini setelah jQuery) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        function confirmDelete(url) {
            $('#deleteForm').attr('action', url);
            $('#deleteModal').modal('show');
        }
    </script>

    <script>
        $(document).ready(function () {
            // Inisialisasi DataTable
            var table = $('#dataTable').DataTable({
                "dom": '<"row"<"col-sm-6"l><"col-sm-6 d-flex justify-content-end"f>>rtip',
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                "order": [[1, 'asc']]
            });

            // Menambahkan nomor urut otomatis
            table.on('order.dt search.dt', function () {
                table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();

            

            // Pindahkan dropdown ke dalam toolbar DataTables
            $('#dataTable_filter').append(
                '<label class="mr-2"><select id="filterKategori" class="form-control form-control-sm ml-2"><option value="">Semua Kategori</option></select></label>'
            );

            // Tambahkan opsi kategori ke dropdown dalam toolbar
            @foreach($kategoriRuangan as $item)
                $('#filterKategori').append('<option value="{{ $item->nama_kategori }}">{{ $item->nama_kategori }}</option>');
            @endforeach

            // Event untuk filter kategori
            $('#filterKategori').on('change', function () {
                table.column(3).search(this.value).draw();
            });
        });
    </script>



    <!-- Page level plugins -->
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>
@endpush