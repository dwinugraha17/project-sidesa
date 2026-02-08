@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Riwayat Surat</h1>
    <a href="{{ route('letters.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Buat Surat Baru
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No. Surat</th>
                        <th>Jenis Surat</th>
                        <th>Penduduk</th>
                        <th>Keperluan</th>
                        <th>Tanggal Dibuat</th>
                        <th>Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($letters as $letter)
                        <tr>
                            <td>{{ $letter->letter_number }}</td>
                            <td>{{ str_replace('_', ' ', $letter->letter_type) }}</td>
                            <td>{{ $letter->resident->name }}</td>
                            <td>{{ $letter->remarks }}</td>
                            <td>{{ $letter->created_at->format('d-m-Y H:i') }}</td>
                            <td>{{ $letter->user->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('letters.show', $letter->id) }}" target="_blank" class="btn btn-sm btn-info mr-2">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    <a href="{{ route('letters.download', $letter->id) }}" class="btn btn-sm btn-danger">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada riwayat surat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $letters->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
