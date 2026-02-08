@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Laporan Warga</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Laporan Masuk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Pelapor</th>
                            <th>Judul Laporan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $complaint)
                            <tr>
                                <td>{{ $complaint->resident->name }}</td>
                                <td>{{ $complaint->title }}</td>
                                <td>{{ $complaint->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge badge-{{ $complaint->status == 'pending' ? 'warning' : ($complaint->status == 'processing' ? 'info' : ($complaint->status == 'completed' ? 'success' : 'danger')) }}">
                                        {{ ucfirst($complaint->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('management.complaints.show', $complaint->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada laporan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $complaints->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
