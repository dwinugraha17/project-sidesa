@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Bantuan Sosial</h1>
    <button type="button" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addAidModal">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Program Bantuan
    </button>
</div>

<div class="row">
    @forelse ($socialAids as $aid)
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            {{ $aid->name }}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($aid->amount, 0, ',', '.') }}</div>
                        <p class="text-sm text-gray-600 mt-2">{{ Str::limit($aid->description, 100) }}</p>
                        <div class="mt-3">
                            <span class="badge badge-info">{{ $aid->recipients_count }} Penerima</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hand-holding-heart fa-2x text-gray-300"></i>
                    </div>
                </div>
                <a href="{{ route('social-aid.show', $aid->id) }}" class="stretched-link"></a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info">Belum ada program bantuan sosial. Silakan tambah baru.</div>
    </div>
    @endforelse
</div>

<!-- Modal Add -->
<div class="modal fade" id="addAidModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Program Bantuan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('social-aid.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Program</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: BLT Dana Desa 2024" required>
                    </div>
                    <div class="form-group">
                        <label>Nominal Bantuan (Rp)</label>
                        <input type="number" name="amount" class="form-control" placeholder="300000" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
