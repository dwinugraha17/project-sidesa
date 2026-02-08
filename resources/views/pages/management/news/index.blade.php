@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Berita Desa</h1>
    <a href="{{ route('management.news.create') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tulis Berita
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($news as $item)
                        <tr>
                            <td style="width: 150px;">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid rounded" style="max-height: 80px;">
                                @else
                                    <span class="text-muted small">Tanpa gambar</span>
                                @endif
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('management.news.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('management.news.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada berita.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $news->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
