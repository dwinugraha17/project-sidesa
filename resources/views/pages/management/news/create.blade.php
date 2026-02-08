@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tulis Berita Baru</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('management.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label>Judul Berita</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Gambar Sampul</label>
                <input type="file" name="image" class="form-control-file">
            </div>

            <div class="form-group">
                <label>Konten Berita</label>
                <textarea name="content" class="form-control" rows="10" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Terbitkan</button>
            <a href="{{ route('management.news.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
