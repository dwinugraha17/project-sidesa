@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Polling Desa</h1>
        <a href="{{ route('management.polls.create') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Buat Polling Baru
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Polling / Musyawarah Digital</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul Polling</th>
                            <th>Total Suara</th>
                            <th>Status</th>
                            <th>Berakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($polls as $poll)
                            <tr>
                                <td>{{ $poll->title }}</td>
                                <td>{{ $poll->votes_count }} suara</td>
                                <td>
                                    <form action="{{ route('management.polls.toggle', $poll->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-{{ $poll->is_active ? 'success' : 'secondary' }}">
                                            {{ $poll->is_active ? 'Aktif' : 'Non-Aktif' }}
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $poll->end_date ? \Carbon\Carbon::parse($poll->end_date)->format('d/m/Y') : 'Selamanya' }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('management.polls.show', $poll->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-chart-pie"></i> Hasil
                                        </a>
                                        <form action="{{ route('management.polls.destroy', $poll->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada polling.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $polls->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
