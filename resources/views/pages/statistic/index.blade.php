@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Statistik Kependudukan Desa Sajira</h1>
</div>

<div class="row">
    <!-- Chart Jenis Kelamin -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Jenis Kelamin</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="genderChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2"><i class="fas fa-circle text-primary"></i> Laki-laki</span>
                    <span class="mr-2"><i class="fas fa-circle text-success"></i> Perempuan</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Sebaran Dusun -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sebaran Per Dusun</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="dusunChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Statistik Agama -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Agama</h6>
            </div>
            <div class="card-body">
                @foreach($religionStats as $stat)
                <h4 class="small font-weight-bold">{{ $stat->religion }} <span class="float-right">{{ $stat->total }}</span></h4>
                <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ ($stat->total / $religionStats->sum('total')) * 100 }}%"></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Top 5 Pekerjaan -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Top 5 Pekerjaan</h6>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Pekerjaan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($occupationStats as $stat)
                        <tr>
                            <td>{{ $stat->occupation }}</td>
                            <td>{{ $stat->total }} Orang</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('template/vendor/chart.js/Chart.min.js') }}"></script>
<script>
    // Gender Chart
    var ctxGender = document.getElementById("genderChart");
    var myPieChart = new Chart(ctxGender, {
        type: 'doughnut',
        data: {
            labels: ["Laki-laki", "Perempuan"],
            datasets: [{
                data: [
                    {{ $genderStats->where('gender', 'male')->first()->total ?? 0 }}, 
                    {{ $genderStats->where('gender', 'female')->first()->total ?? 0 }}
                ],
                backgroundColor: ['#4e73df', '#1cc88a'],
                hoverBackgroundColor: ['#2e59d9', '#17a673'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: { backgroundColor: "rgb(255,255,255)", bodyFontColor: "#858796", borderColor: '#dddfeb', borderWidth: 1, xPadding: 15, yPadding: 15, displayColors: false, caretPadding: 10, },
            legend: { display: false },
            cutoutPercentage: 80,
        },
    });

    // Dusun Chart
    var ctxDusun = document.getElementById("dusunChart");
    var myBarChart = new Chart(ctxDusun, {
        type: 'bar',
        data: {
            labels: {!! json_encode($dusunStats->pluck('dusun')) !!},
            datasets: [{
                label: "Jumlah Penduduk",
                backgroundColor: "#4e73df",
                hoverBackgroundColor: "#2e59d9",
                borderColor: "#4e73df",
                data: {!! json_encode($dusunStats->pluck('total')) !!},
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: { padding: { left: 10, right: 25, top: 25, bottom: 0 } },
            scales: {
                xAxes: [{ gridLines: { display: false, drawBorder: false }, ticks: { maxTicksLimit: 6 } }],
                yAxes: [{ ticks: { min: 0, maxTicksLimit: 5, padding: 10 }, gridLines: { color: "rgb(234, 236, 244)", zeroLineColor: "rgb(234, 236, 244)", drawBorder: false, borderDash: [2], zeroLineBorderDash: [2] } }],
            },
            legend: { display: false },
            tooltips: { titleMarginBottom: 10, titleFontColor: '#6e707e', titleFontSize: 14, backgroundColor: "rgb(255,255,255)", bodyFontColor: "#858796", borderColor: '#dddfeb', borderWidth: 1, xPadding: 15, yPadding: 15, displayColors: false, intersect: false, mode: 'index', caretPadding: 10 },
        }
    });
</script>
@endpush
