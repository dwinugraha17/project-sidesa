<ul class="navbar-nav bg-gradient-sky sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('Lebak.png') }}" alt="Logo Lebak" style="width: 40px;">
        </div>
        <div class="sidebar-brand-text mx-3">Si Desa sajira</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    {{-- MENU KHUSUS ADMIN & OPERATOR --}}
    @if(Auth::guard('web')->check())

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="/dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard Admin</span></a>
        </li>

        @if(Auth::user()->role == 'admin')
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Manajemen Data
        </div>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="/resident">
                <i class="fas fa-fw fa-users"></i>
                <span>Penduduk</span></a>
        </li>

        <!-- Nav Item - Letters -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLetters"
                aria-expanded="true" aria-controls="collapseLetters">
                <i class="fas fa-fw fa-envelope"></i>
                <span>Layanan Surat</span>
            </a>
            <div id="collapseLetters" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/letters">Riwayat & Buat Surat</a>
                    <a class="collapse-item" href="/letters/requests">Permohonan Warga</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Social Aid -->
        <li class="nav-item">
            <a class="nav-link" href="/social-aid">
                <i class="fas fa-fw fa-hand-holding-heart"></i>
                <span>Bantuan Sosial</span></a>
        </li>

        <!-- Nav Item - Budget -->
        <li class="nav-item">
            <a class="nav-link" href="/budget">
                <i class="fas fa-fw fa-money-bill-wave"></i>
                <span>Keuangan Desa</span></a>
        </li>

        <!-- Nav Item - Statistics -->
        <li class="nav-item">
            <a class="nav-link" href="/statistics">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Statistik</span></a>
        </li>

        <!-- Nav Item - Complaints (Admin) -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('management.complaints.index') }}">
                <i class="fas fa-fw fa-exclamation-triangle"></i>
                <span>Laporan Warga</span></a>
        </li>
        @endif

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Manajemen Website
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('management.polls.index') }}">
                <i class="fas fa-fw fa-poll"></i>
                <span>Polling Desa</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('management.banners.index') }}">
                <i class="fas fa-fw fa-images"></i>
                <span>Banner / Slider</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('management.news.index') }}">
                <i class="fas fa-fw fa-newspaper"></i>
                <span>Berita Desa</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('management.staff.index') }}">
                <i class="fas fa-fw fa-user-tie"></i>
                <span>Aparatur Desa</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('management.products.index') }}">
                <i class="fas fa-fw fa-shopping-bag"></i>
                <span>Produk UMKM</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('management.galleries.index') }}">
                <i class="fas fa-fw fa-camera-retro"></i>
                <span>Galeri Foto</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('management.messages.index') }}">
                <i class="fas fa-fw fa-comment-dots"></i>
                <span>Kotak Aspirasi</span></a>
        </li>

    {{-- MENU KHUSUS WARGA --}}
    @elseif(Auth::guard('resident')->check())

        <!-- Nav Item - Dashboard Warga -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('warga.dashboard') }}">
                <i class="fas fa-fw fa-home"></i>
                <span>Dashboard Warga</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Layanan
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('warga.dashboard') }}">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Pengajuan Surat</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('resident.complaints.index') }}">
                <i class="fas fa-fw fa-bullhorn"></i>
                <span>Lapor Masalah</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('resident.polls.index') }}">
                <i class="fas fa-fw fa-vote-yea"></i>
                <span>Polling & Suara</span></a>
        </li>

    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
