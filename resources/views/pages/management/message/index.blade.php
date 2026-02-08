@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kotak Aspirasi & Pesan Warga</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Pengirim</th>
                        <th>Subjek</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages as $msg)
                        <tr class="{{ $msg->is_read ? '' : 'bg-light font-weight-bold' }}">
                            <td class="text-center">
                                @if($msg->is_read)
                                    <span class="badge badge-secondary">Dibaca</span>
                                @else
                                    <span class="badge badge-primary">Baru</span>
                                @endif
                            </td>
                            <td>{{ $msg->name }}</td>
                            <td>{{ $msg->subject }}</td>
                            <td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('management.messages.show', $msg->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                                <form action="{{ route('management.messages.destroy', $msg->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Belum ada pesan atau aspirasi masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
