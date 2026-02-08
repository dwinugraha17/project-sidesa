@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Foto Galeri</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('management.galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label>Judul Kegiatan / Foto</label>
                <input type="text" name="title" class="form-control" placeholder="Contoh: Kerja Bakti Dusun 1" required>
            </div>

            <div class="form-group">
                <label>Pilih Gambar</label>
                <input type="file" name="image" class="form-control-file" required>
                <small class="text-muted">Maksimal 5MB.</small>
            </div>

            <div class="form-group">
                <label>Keterangan Singkat (Opsional)</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan ke Galeri</button>
            <a href="{{ route('management.galleries.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
