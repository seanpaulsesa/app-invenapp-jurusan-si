@extends('layouts.app')

@section('title', 'Kategori Ruangan')

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
                <h1 class="h3 mb-0 text-gray-800">Ruangan</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Lihat Laporan</a>
            </div>

            <!-- Content Row -->
            <div class="row">

                <div class="col-lg-6 mb-4">

                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">heading</h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, aut pariatur consequuntur iure quos iusto nisi possimus! Quaerat aperiam architecto molestiae odit laborum eveniet? Magni!</p>
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