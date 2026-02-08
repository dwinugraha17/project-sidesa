@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Permohonan Surat Warga</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Warga</th>
                        <th>Jenis Surat</th>
                        <th>Keperluan</th>
                        <th>Status Saat Ini</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requests as $req)
                        <tr>
                            <td>{{ $req->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <strong>{{ $req->resident->name }}</strong><br>
                                <small class="text-muted">{{ $req->resident->nik }}</small>
                            </td>
                            <td>{{ str_replace('_', ' ', $req->letter_type) }}</td>
                            <td>{{ $req->remarks }}</td>
                            <td>
                                @if($req->status == 'pending') <span class="badge badge-warning">Menunggu</span>
                                @elseif($req->status == 'processing') <span class="badge badge-info">Diproses</span>
                                @elseif($req->status == 'ready') <span class="badge badge-success">Siap Diambil</span>
                                @elseif($req->status == 'rejected') <span class="badge badge-danger">Ditolak</span>
                                @else <span class="badge badge-secondary">Selesai</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editStatusModal-{{ $req->id }}">
                                    <i class="fas fa-edit"></i> Proses
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada permohonan surat baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $requests->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

@foreach ($requests as $req)
    <!-- Modal Update Status -->
    <div class="modal fade" id="editStatusModal-{{ $req->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Proses Permohonan: {{ $req->resident->name }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('letters.requests.update', $req->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Ubah Status</label>
                            <select name="status" class="form-control">
                                <option value="pending" {{ $req->status == 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                                <option value="processing" {{ $req->status == 'processing' ? 'selected' : '' }}>Sedang Diproses (Cetak/TTD)</option>
                                <option value="ready" {{ $req->status == 'ready' ? 'selected' : '' }}>Siap Diambil</option>
                                <option value="done" {{ $req->status == 'done' ? 'selected' : '' }}>Selesai / Sudah Diambil</option>
                                <option value="rejected" {{ $req->status == 'rejected' ? 'selected' : '' }}>Tolak Permohonan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Catatan Admin (Opsional)</label>
                            <textarea name="admin_notes" class="form-control" rows="2" placeholder="Contoh: Silakan ambil hari Senin jam 09.00">{{ $req->admin_notes }}</textarea>
                            <small class="text-muted">Pesan ini akan terbaca oleh warga di dashboard mereka.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endsection
