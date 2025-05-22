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
                <h1 class="h3 mb-0 text-gray-800">{{ $pageTitle ?? 'Statistik' }}</h1>
                <p>{{ $pageDescription ?? 'Statistik' }}</p>
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Lihat Laporan</a> --}}
            </div>

            <!-- Content Row -->
            <div class="row">

                <div class="col-lg-6 mb-4">

                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Rekapan Barang per Kategori</h6>
                        </div>
                        <div class="card-body">
                            <div id="pieChartBarang"></div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 mb-4">

                    <!-- Illustrations -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Rekapan Ruangan per Kategori</h6>
                        </div>
                        <div class="card-body">
                            <div id="pieChartRuangan"></div>
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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        // Fungsi untuk ambil data dari API dan tampilkan chart barang per kategori
        async function loadChart() {
            try {
            const response = await fetch('/api/chart-barang-per-kategori');
            const data = await response.json();

            // Transform data ke format ApexCharts: 
            // series = array jumlah y, labels = array nama kategori
            const series = data.map(item => item.y);
            const labels = data.map(item => item.name);

            var options = {
                chart: {
                type: 'pie',
                height: 350
                },
                series: series,
                labels: labels,
                legend: {
                position: 'bottom'
                },
                responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                    width: 300
                    },
                    legend: {
                    position: 'bottom'
                    }
                }
                }]
            };

            var pieChartBarang = new ApexCharts(document.querySelector("#pieChartBarang"), options);
            pieChartBarang.render();

            } catch (error) {
            console.error('Error fetching chart data:', error);
            document.querySelector("#pieChartBarang").innerText = 'Gagal memuat data chart.';
            }
        }

        loadChart();
    </script>





    <script>
        // Fungsi untuk ambil data dari API dan tampilkan chart ruangan per kategori
        async function loadChart() {
            try {
                const response = await fetch('/api/chart-ruangan-per-kategori');
                const data = await response.json();

                // Transform data ke format ApexCharts: 
                // series = array jumlah y, labels = array nama kategori
                const series = data.map(item => item.y);
                const labels = data.map(item => item.name);

                var options = {
                    chart: {
                        type: 'pie',
                        height: 350
                    },
                    series: series,
                    labels: labels,
                    legend: {
                        position: 'bottom'
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var pieChartRuangan = new ApexCharts(document.querySelector("#pieChartRuangan"), options);
                pieChartRuangan.render();

            } catch (error) {
                console.error('Error fetching chart data:', error);
                document.querySelector("#pieChartRuangan").innerText = 'Gagal memuat data chart.';
            }
        }

        loadChart();
    </script>

    
@endpush