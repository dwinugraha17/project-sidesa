@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Banner / Slider</h1>
    <a href="{{ route('management.banners.create') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Banner
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
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($banners as $banner)
                        <tr>
                            <td style="width: 200px;">
                                <img src="{{ asset('storage/' . $banner->image) }}" class="img-fluid rounded" alt="{{ $banner->title }}">
                            </td>
                            <td>{{ $banner->title }}</td>
                            <td>{{ $banner->description }}</td>
                            <td>
                                @if($banner->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-secondary">Non-aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('management.banners.edit', $banner->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('management.banners.destroy', $banner->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada banner.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
