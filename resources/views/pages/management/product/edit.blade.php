@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Produk UMKM</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('management.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Pemilik / Toko</label>
                        <input type="text" name="owner_name" class="form-control" value="{{ $product->owner_name }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nomor WhatsApp</label>
                        <input type="text" name="whatsapp_number" class="form-control" value="{{ $product->whatsapp_number }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Harga (Rupiah)</label>
                        <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Deskripsi Produk</label>
                <textarea name="description" class="form-control" rows="4">{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Foto Produk (Biarkan kosong jika tidak ingin mengubah)</label>
                <div class="mb-2">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" width="150" class="img-thumbnail">
                    @endif
                </div>
                <input type="file" name="image" class="form-control-file">
            </div>

            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}>
                    <label class="custom-control-label" for="is_active">Aktifkan Produk di Website</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('management.products.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
