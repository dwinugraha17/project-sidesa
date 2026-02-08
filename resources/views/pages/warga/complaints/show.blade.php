@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Laporan</h1>
        <a href="{{ route('resident.complaints.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $complaint->title }}</h6>
                </div>
                <div class="card-body">
                    <p><strong>Deskripsi:</strong></p>
                    <p>{{ $complaint->description }}</p>

                    @if($complaint->photo)
                        <p><strong>Foto:</strong></p>
                        <img src="{{ Storage::url($complaint->photo) }}" class="img-fluid rounded mb-3" style="max-height: 400px;">
                    @endif

                    @if($complaint->latitude && $complaint->longitude)
                        <p><strong>Lokasi:</strong></p>
                        <a href="https://www.google.com/maps?q={{ $complaint->latitude }},{{ $complaint->longitude }}" target="_blank" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-external-link-alt"></i> Lihat di Google Maps
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-light">
                    <h6 class="m-0 font-weight-bold text-dark">Status & Catatan</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="font-weight-bold">Status:</label>
                        <br>
                        @if($complaint->status == 'pending')
                            <span class="badge badge-warning">Menunggu Antrean</span>
                        @elseif($complaint->status == 'processing')
                            <span class="badge badge-info">Sedang Diproses</span>
                        @elseif($complaint->status == 'completed')
                            <span class="badge badge-success">Selesai Ditangani</span>
                        @elseif($complaint->status == 'rejected')
                            <span class="badge badge-danger">Laporan Ditolak</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="font-weight-bold">Catatan Admin:</label>
                        <p class="text-muted">{{ $complaint->admin_note ?? 'Belum ada catatan dari admin.' }}</p>
                    </div>

                    <div class="small text-muted">
                        Dilaporkan pada: {{ $complaint->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
