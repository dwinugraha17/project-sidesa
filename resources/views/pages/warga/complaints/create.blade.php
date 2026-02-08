@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buat Laporan Baru</h1>
        <a href="{{ route('resident.complaints.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('resident.complaints.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul Laporan</label>
                    <input type="text" name="title" class="form-control" placeholder="Contoh: Jalan Rusak di RT 01" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi Masalah</label>
                    <textarea name="description" class="form-control" rows="5" placeholder="Jelaskan detail masalah yang dilaporkan..." required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Foto Pendukung</label>
                            <input type="file" name="photo" class="form-control-file">
                            <small class="text-muted">Format: jpg, jpeg, png. Maks: 2MB</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Lokasi GPS (Opsional)</label>
                        <div class="input-group mb-3">
                            <input type="text" name="latitude" id="latitude" class="form-control" placeholder="Latitude" readonly>
                            <input type="text" name="longitude" id="longitude" class="form-control" placeholder="Longitude" readonly>
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="button" onclick="getLocation()">
                                    <i class="fas fa-map-marker-alt"></i> Ambil Lokasi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Kirim Laporan</button>
            </form>
        </div>
    </div>
</div>

<script>
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        alert("Geolocation tidak didukung oleh browser ini.");
    }
}

function showPosition(position) {
    document.getElementById("latitude").value = position.coords.latitude;
    document.getElementById("longitude").value = position.coords.longitude;
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("Pengguna menolak permintaan Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Informasi lokasi tidak tersedia.");
            break;
        case error.TIMEOUT:
            alert("Waktu permintaan lokasi habis.");
            break;
        case error.UNKNOWN_ERROR:
            alert("Terjadi kesalahan yang tidak diketahui.");
            break;
    }
}
</script>
@endsection
