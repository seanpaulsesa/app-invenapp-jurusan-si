@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        @include('layouts.topbar')

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Lihat Laporan</a>
            </div>

            <!-- Content Row -->
            <div class="row">

                <div class="col-lg-4 mb-4">

                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Selamat datang, {{ Auth::user()->name }}!</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4 rounded-circle" style="width: 7rem;"
                                src="{{ Auth::user()->profile_photo_path }}" alt="foto profil">
                                <p class="p-0 m-0 font-weight-bold">{{ Auth::user()->name }}</p>
                                <p class="p-0 m-0"><i class="fas fa-fw fa-envelope"></i> {{ Auth::user()->email }}</p>
                                    
                                
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-8 mb-4">

                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Fitur Utama Sistem Informasi</h6>
                        </div>
                        <div class="card-body">
                            <p>{{ ENV('APP_NAME') }} merupakan proyek Tugas Akhir yang dikembangkan oleh <a href="https://github.com/seanpaulsesa/">Paulus Sesa</a> pada Jurusan Sistem Informasi Universitas Cenderawasih pada tahun 2025.</p>

                            <p>Berikut merupakan fitur-fitur utama pada sistem informasi:</p>
                            <h5>Manajemen Barang</h5>
                            <ul>
                                <li><a href="#">Barang</a></li>
                                <li><a href="#">Kategori Barang</a></li>
                            </ul>

                            <h5>Manajemen Ruangan</h5>
                            <ul>
                                <li><a href="#">Ruangan</a></li>
                                <li><a href="#">Kategori Ruangan</a></li>
                            </ul>

                            <h5>Laporan</h5>
                            <ul>
                                <li><a href="#">Ruangan</a></li>
                                <li><a href="#">Peminjaman Ruangan</a></li>
                                <li><a href="#">Barang</a></li>
                                <li><a href="#">Peminjaman Barang</a></li>
                                <li><a href="#">...</a></li>
                            </ul>
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