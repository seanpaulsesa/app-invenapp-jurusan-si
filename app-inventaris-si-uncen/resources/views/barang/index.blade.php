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
                    <h1 class="h3 mb-2 text-gray-800">Barang</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                    @include('layouts.allerts')

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Barang</h6>
                            <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm mb-3">Tambah Barang</a>
                        </div>
                        <div class="card-body">

                        

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
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
                                                <td>{{ $data->kategori->nama_kategori }}</td>
                                                <td>{{ $data->keterangan }}</td>
                                                <td>
                                                    <!-- view button -->
                                                    <a href="{{ route('barang.show', $data->id) }}" class="btn btn-info btn-sm">View</a>
                                                    <!-- edit and delete buttons -->
                                                    <a href="{{ route('barang.edit', $data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                                    <form action="{{ route('barang.destory', $data->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No data available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
    <!-- <script>
        $(document).ready(function () {
            $('#dataTable tbody tr').each(function (index) {
                $(this).find('td:first').text(index + 1);
            });
        });
    </script> -->

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
            @foreach($kategoriBarang as $item)
                $('#filterKategori').append('<option value="{{ $item->nama_kategori }}">{{ $item->nama_kategori }}</option>');
            @endforeach

            // Event untuk filter kategori
            $('#filterKategori').on('change', function () {
                table.column(2).search(this.value).draw();
            });
        });
    </script>

    <!-- Page level plugins -->
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>
@endpush