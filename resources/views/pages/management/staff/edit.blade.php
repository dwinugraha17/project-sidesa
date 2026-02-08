@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Aparatur</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('management.staff.update', $staff->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ $staff->name }}" required>
            </div>

            <div class="form-group">
                <label>Jabatan</label>
                <input type="text" name="position" class="form-control" value="{{ $staff->position }}" required>
            </div>

            <div class="form-group">
                <label>Foto (Biarkan kosong jika tidak ingin mengubah)</label>
                <div class="mb-2">
                    @if($staff->image)
                        <img src="{{ asset('storage/' . $staff->image) }}" width="100" class="img-thumbnail">
                    @else
                        <span class="text-muted small">Belum ada foto</span>
                    @endif
                </div>
                <input type="file" name="image" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('management.staff.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
