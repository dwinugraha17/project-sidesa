@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Banner Baru</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('management.banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label>Judul Banner</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Gambar Banner</label>
                <input type="file" name="image" class="form-control-file" required>
                <small class="text-muted">Rekomendasi ukuran: 1920x600 pixel.</small>
            </div>

            <div class="form-group">
                <label>Deskripsi (Opsional)</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" checked>
                    <label class="custom-control-label" for="is_active">Aktifkan Banner</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('management.banners.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
