@extends('layouts.app')

@section('content')
 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Dashboard Overview</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-sky shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<div class="row">

    <!-- Total Residents Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card h-100 py-2 border-left-primary">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Penduduk</div>
                        <div class="h4 mb-0 font-weight-bold text-gray-800">{{ number_format($totalResidents) }}</div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle bg-primary text-white">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <i class="fas fa-users stat-icon-bg text-primary"></i>
            </div>
        </div>
    </div>

    <!-- Male Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card h-100 py-2 border-left-success">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Laki-laki</div>
                        <div class="h4 mb-0 font-weight-bold text-gray-800">{{ number_format($totalMale) }}</div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle bg-success text-white">
                            <i class="fas fa-male"></i>
                        </div>
                    </div>
                </div>
                <i class="fas fa-male stat-icon-bg text-success"></i>
            </div>
        </div>
    </div>

    <!-- Female Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card h-100 py-2 border-left-info">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Perempuan</div>
                        <div class="h4 mb-0 font-weight-bold text-gray-800">{{ number_format($totalFemale) }}</div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle bg-info text-white">
                            <i class="fas fa-female"></i>
                        </div>
                    </div>
                </div>
                <i class="fas fa-female stat-icon-bg text-info"></i>
            </div>
        </div>
    </div>

    <!-- Active Residents Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stat-card h-100 py-2 border-left-warning">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Penduduk Aktif</div>
                        <div class="h4 mb-0 font-weight-bold text-gray-800">{{ number_format($totalActive) }}</div>
                    </div>
                    <div class="col-auto">
                        <div class="icon-circle bg-warning text-white">
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>
                </div>
                <i class="fas fa-user-check stat-icon-bg text-warning"></i>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row">
    <!-- Area Chart (Placeholder / Future) -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Desa</h6>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-4 text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="max-height: 180px;"
                            src="{{ asset('template/img/undraw_posting_photo.svg') }}" alt="Admin Dashboard">
                    </div>
                    <div class="col-md-8">
                        <h4 class="font-weight-bold text-gray-800">SiDesa Sajira Dashboard</h4>
                        <p class="mb-4">
                            Selamat datang, <strong>{{ Auth::user()->name }}</strong>!<br>
                            Gunakan panel ini untuk memantau perkembangan data desa. Grafik di samping menampilkan distribusi penduduk berdasarkan jenis kelamin secara otomatis.
                        </p>
                        <a href="/resident/create" class="btn btn-sky btn-icon-split shadow-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Tambah Data Penduduk</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Statistik Gender</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="genderPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Laki-laki
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Perempuan
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Akses Cepat Layanan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 mb-3">
                        <a href="/letters/requests" class="btn btn-light btn-block text-left p-4 border shadow-sm h-100 hover-card">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-warning text-white mr-3">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h6 class="font-weight-bold text-gray-800 mb-1">Permohonan Surat</h6>
                                    <small class="text-muted">Cek permintaan warga</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <a href="/social-aid" class="btn btn-light btn-block text-left p-4 border shadow-sm h-100 hover-card">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-danger text-white mr-3">
                                    <i class="fas fa-hand-holding-heart"></i>
                                </div>
                                <div>
                                    <h6 class="font-weight-bold text-gray-800 mb-1">Bantuan Sosial</h6>
                                    <small class="text-muted">Kelola penerima bantuan</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <a href="/budget" class="btn btn-light btn-block text-left p-4 border shadow-sm h-100 hover-card">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-success text-white mr-3">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <div>
                                    <h6 class="font-weight-bold text-gray-800 mb-1">Anggaran Desa</h6>
                                    <small class="text-muted">Transparansi Dana</small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Poppins', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    var ctx = document.getElementById("genderPieChart");
    var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ["Laki-laki", "Perempuan"],
        datasets: [{
        data: [{{ $totalMale }}, {{ $totalFemale }}],
        backgroundColor: ['#0ea5e9', '#3b82f6'],
        hoverBackgroundColor: ['#0284c7', '#2563eb'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
    },
    options: {
        maintainAspectRatio: false,
        tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        },
        legend: {
        display: false
        },
        cutoutPercentage: 80,
    },
    });
</script>
@endpush
    
@endsection