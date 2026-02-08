@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Aparatur Baru</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('management.staff.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Jabatan</label>
                <input type="text" name="position" class="form-control" placeholder="Contoh: Kepala Desa, Sekretaris Desa" required>
            </div>

            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="image" class="form-control-file">
                <small class="text-muted">Rekomendasi: Foto formal (Pas Foto).</small>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('management.staff.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
