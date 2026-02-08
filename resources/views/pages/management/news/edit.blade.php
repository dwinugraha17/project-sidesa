@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Berita</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('management.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Judul Berita</label>
                <input type="text" name="title" class="form-control" value="{{ $news->title }}" required>
            </div>

            <div class="form-group">
                <label>Gambar Sampul (Biarkan kosong jika tidak ingin mengubah)</label>
                <div class="mb-2">
                    @if($news->image)
                        <img src="{{ asset('storage/' . $news->image) }}" width="200" class="img-thumbnail">
                    @else
                        <span class="text-muted small">Belum ada gambar</span>
                    @endif
                </div>
                <input type="file" name="image" class="form-control-file">
            </div>

            <div class="form-group">
                <label>Konten Berita</label>
                <textarea name="content" class="form-control" rows="10" required>{{ $news->content }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('management.news.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
