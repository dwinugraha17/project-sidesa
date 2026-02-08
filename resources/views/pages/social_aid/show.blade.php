@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Bantuan: {{ $socialAid->name }}</h1>
    <a href="{{ route('social-aid.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Penerima Bantuan</h6>
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addRecipientModal">
                    <i class="fas fa-plus"></i> Tambah Penerima
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama Penduduk</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Tanggal Terima</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($socialAid->recipients as $recipient)
                                <tr>
                                    <td>{{ $recipient->resident->nik }}</td>
                                    <td>{{ $recipient->resident->name }}</td>
                                    <td>{{ $recipient->resident->address }}</td>
                                    <td>
                                        @if($recipient->status == 'received')
                                            <span class="badge badge-success">Diterima</span>
                                        @elseif($recipient->status == 'pending')
                                            <span class="badge badge-warning">Menunggu</span>
                                        @else
                                            <span class="badge badge-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>{{ $recipient->received_at ? \Carbon\Carbon::parse($recipient->received_at)->format('d-m-Y') : '-' }}</td>
                                    <td>
                                        <form action="{{ route('social-aid.recipient.destroy', $recipient->id) }}" method="POST" onsubmit="return confirm('Hapus penerima ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data penerima.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add Recipient -->
<div class="modal fade" id="addRecipientModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Penerima</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('social-aid.recipient.store', $socialAid->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Penduduk</label>
                        <select name="resident_id" class="form-control" required>
                            <option value="">-- Cari Nama --</option>
                            @foreach($residents as $resident)
                                <option value="{{ $resident->id }}">{{ $resident->nik }} - {{ $resident->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="pending">Menunggu (Pending)</option>
                            <option value="received">Sudah Diterima</option>
                            <option value="rejected">Ditolak</option>
                        </select>
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
