@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan Masalah</h1>
        <a href="{{ route('resident.complaints.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Buat Laporan Baru
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Laporan Anda</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Judul Laporan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $complaint)
                            <tr>
                                <td>{{ $complaint->created_at->format('d/m/Y') }}</td>
                                <td>{{ $complaint->title }}</td>
                                <td>
                                    @if($complaint->status == 'pending')
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif($complaint->status == 'processing')
                                        <span class="badge badge-info">Diproses</span>
                                    @elseif($complaint->status == 'completed')
                                        <span class="badge badge-success">Selesai</span>
                                    @elseif($complaint->status == 'rejected')
                                        <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('resident.complaints.show', $complaint->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada laporan yang dikirim.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
