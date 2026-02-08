@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Produk UMKM Baru</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('management.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Kripik Pisang Manis" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Pemilik / Toko</label>
                        <input type="text" name="owner_name" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nomor WhatsApp (Gunakan 62...)</label>
                        <input type="text" name="whatsapp_number" class="form-control" placeholder="628123456789" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Harga (Rupiah)</label>
                        <input type="number" name="price" class="form-control" placeholder="15000" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Deskripsi Produk</label>
                <textarea name="description" class="form-control" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label>Foto Produk</label>
                <input type="file" name="image" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary">Simpan Produk</button>
            <a href="{{ route('management.products.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
