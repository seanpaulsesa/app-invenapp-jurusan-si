<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon">
    <img src="{{  env('APP_LOGO') }}" alt="app logo" class="w-100">
    </div>
    <!-- <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div> -->
    <div style="font-size: 0.5rem">
    {{  env('APP_NAME') }}
    </div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="{{ route('beranda') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Beranda</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Rekapan dan Statistik -->
<div class="sidebar-heading">
    Rekapan dan Statistik
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item {{ request()->segment(1) == 'statistik' ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStatistik"
        aria-expanded="true" aria-controls="collapseStatistik">
        <i class="fas fa-fw fa-box"></i>
        <span>Rekapan dan Statistik</span>
    </a>
    <div id="collapseStatistik" class="collapse {{ request()->segment(1) == 'barang' ? 'show' : '' }} {{ request()->segment(1) == 'kategori-barang' ? 'show' : '' }}" 
         aria-labelledby="headingBarang" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ request()->segment(1) == 'statistik' ? 'active' : '' }}" href="{{ url('barang') }}">Rekapan per Bulan</a>
            <a class="collapse-item {{ request()->segment(1) == 'kategori-barang' ? 'active' : '' }}" href="{{ url('kategori-barang') }}">Rekapan per Tahun</a>
        </div>
    </div>
</li>

<!-- Heading -->
<div class="sidebar-heading">
    Manajemen Barang
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item {{ request()->segment(1) == 'barang' ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBarang"
        aria-expanded="true" aria-controls="collapseBarang">
        <i class="fas fa-fw fa-box"></i>
        <span>Barang</span>
    </a>
    <div id="collapseBarang" class="collapse {{ request()->segment(1) == 'barang' ? 'show' : '' }} {{ request()->segment(1) == 'kategori-barang' ? 'show' : '' }}" 
         aria-labelledby="headingBarang" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ request()->segment(1) == 'barang' ? 'active' : '' }}" href="{{ url('barang') }}">Barang</a>
            <a class="collapse-item {{ request()->segment(1) == 'kategori-barang' ? 'active' : '' }}" href="{{ url('kategori-barang') }}">Kategori Barang</a>
        </div>
    </div>
</li>


<!-- Divider -->
<hr class="sidebar-divider">












<!-- Heading -->
<div class="sidebar-heading">
    Manajemen Ruangan
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item {{ request()->segment(1) == 'ruangan' ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRuangan"
        aria-expanded="true" aria-controls="collapseRuangan">
        <i class="fas fa-fw fa-box"></i>
        <span>Ruangan</span>
    </a>
    <div id="collapseRuangan" class="collapse {{ request()->segment(1) == 'ruangan' ? 'show' : '' }} {{ request()->segment(1) == 'kategori-ruangan' ? 'show' : '' }}" 
         aria-labelledby="headingRuangan" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ request()->segment(1) == 'ruangan' ? 'active' : '' }}" href="{{ url('ruangan') }}">Ruangan</a>
            <a class="collapse-item {{ request()->segment(1) == 'kategori-ruangan' ? 'active' : '' }}" href="{{ url('kategori-ruangan') }}">Kategori Ruangan</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">















<!-- Heading -->
<div class="sidebar-heading">
    Laporan
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
        aria-expanded="true" aria-controls="collapseLaporan">
        <i class="fas fa-fw fa-box"></i>
        <span>Laporan</span>
    </a>
    <div id="collapseLaporan" class="collapse" aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Ruangan</h6>
            <a class="collapse-item" href="{{ url('laporan/ruangan') }}">Ruangan</a>
            <a class="collapse-item" href="{{ url('laporan/kategori-ruangan') }}">Peminjaman Ruangan</a>
            <h6 class="collapse-header">Barang</h6>
            <a class="collapse-item" href="{{ url('laporan/barang') }}">Barang</a>
            <a class="collapse-item" href="{{ url('laporan/kategori-barang') }}">Peminjaman Barang</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">





<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->
<div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2 rounded-circle" src="https://avatars.githubusercontent.com/u/114337187?v=4" alt="foto profil github">
    <p class="text-center mb-2">Sistem ini dikembangkan oleh <strong>Paulus Sesa</strong> sebagai bagian dari Tugas Akhir pada Jurusan Sistem Informasi Universitas Cenderawasih.</p>
    <a class="btn btn-outline-light btn-sm" href="https://github.com/seanpaulsesa/" target="_blank">Profil GitHub</a>
</div>

</ul>
<!-- End of Sidebar -->