@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Aspirasi</h1>
        <a href="{{ route('management.messages.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $message->subject }}</h6>
                    <span class="badge badge-info">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="font-weight-bold text-gray-800">Dari:</h6>
                        <p class="mb-0 text-gray-900">{{ $message->name }}</p>
                        <small class="text-muted"><i class="fas fa-address-book mr-1"></i> {{ $message->contact }}</small>
                    </div>
                    <hr>
                    <div class="mb-4">
                        <h6 class="font-weight-bold text-gray-800">Pesan:</h6>
                        <p class="text-gray-900" style="white-space: pre-line;">{{ $message->content }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4 border-left-warning">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Aksi</h6>
                </div>
                <div class="card-body">
                    <p class="small text-muted">Aspirasi ini dikirim melalui formulir kontak publik di halaman depan.</p>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->contact) }}" target="_blank" class="btn btn-success btn-block mb-3">
                        <i class="fab fa-whatsapp mr-1"></i> Balas via WhatsApp
                    </a>
                    <form action="{{ route('management.messages.destroy', $message->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block btn-delete">
                            <i class="fas fa-trash mr-1"></i> Hapus Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
