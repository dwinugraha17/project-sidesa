@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Banner</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('management.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Judul Banner</label>
                <input type="text" name="title" class="form-control" value="{{ $banner->title }}" required>
            </div>

            <div class="form-group">
                <label>Gambar Banner (Biarkan kosong jika tidak ingin mengubah)</label>
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $banner->image) }}" width="200" class="img-thumbnail">
                </div>
                <input type="file" name="image" class="form-control-file">
            </div>

            <div class="form-group">
                <label>Deskripsi (Opsional)</label>
                <textarea name="description" class="form-control" rows="3">{{ $banner->description }}</textarea>
            </div>

            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ $banner->is_active ? 'checked' : '' }}>
                    <label class="custom-control-label" for="is_active">Aktifkan Banner</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('management.banners.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
