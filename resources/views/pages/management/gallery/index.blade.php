@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Galeri Foto Desa</h1>
    <a href="{{ route('management.galleries.create') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Foto
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row">
            @forelse ($galleries as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                        <div class="card-body p-2 text-center">
                            <h6 class="font-weight-bold mb-1">{{ Str::limit($item->title, 30) }}</h6>
                            <div class="mt-2">
                                <a href="{{ route('management.galleries.edit', $item->id) }}" class="btn btn-sm btn-info p-1"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('management.galleries.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger p-1 btn-delete"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada foto di galeri.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-3">
            {{ $galleries->links() }}
        </div>
    </div>
</div>
@endsection
