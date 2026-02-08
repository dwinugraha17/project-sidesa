@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Laporan Warga</h1>
        <a href="{{ route('management.complaints.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Laporan</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Pelapor:</div>
                        <div class="col-sm-8">{{ $complaint->resident->name }} ({{ $complaint->resident->nik }})</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Judul:</div>
                        <div class="col-sm-8">{{ $complaint->title }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Deskripsi:</div>
                        <div class="col-sm-8">{{ $complaint->description }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 font-weight-bold">Waktu:</div>
                        <div class="col-sm-8">{{ $complaint->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    
                    @if($complaint->photo)
                        <hr>
                        <p class="font-weight-bold">Foto Lampiran:</p>
                        <img src="{{ Storage::url($complaint->photo) }}" class="img-fluid rounded border" style="max-height: 400px;">
                    @endif

                    @if($complaint->latitude && $complaint->longitude)
                        <hr>
                        <p class="font-weight-bold">Lokasi Map:</p>
                        <a href="https://www.google.com/maps?q={{ $complaint->latitude }},{{ $complaint->longitude }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-map-marked-alt"></i> Buka Google Maps
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Tindak Lanjut Admin</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('management.complaints.update', $complaint->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Ubah Status</label>
                            <select name="status" class="form-control" required>
                                <option value="pending" {{ $complaint->status == 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                                <option value="processing" {{ $complaint->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                                <option value="completed" {{ $complaint->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="rejected" {{ $complaint->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Catatan / Balasan ke Warga</label>
                            <textarea name="admin_note" class="form-control" rows="5" placeholder="Tuliskan alasan penolakan atau informasi tindak lanjut...">{{ $complaint->admin_note }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success btn-block shadow-sm">Perbarui Status Laporan</button>
                    </form>
                    
                    <hr>
                    <form action="{{ route('management.complaints.destroy', $complaint->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm btn-block btn-delete">
                            <i class="fas fa-trash"></i> Hapus Laporan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
