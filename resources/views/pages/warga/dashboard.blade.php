@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Layanan Mandiri Warga Desa Sajira</h1>
        <form action="{{ route('warga.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger shadow-sm">
                <i class="fas fa-sign-out-alt fa-sm text-white-50"></i> Keluar
            </button>
        </form>
    </div>

    <div class="row">
        <!-- Informasi Pengguna -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-success text-white">
                    <h6 class="m-0 font-weight-bold">Profil Penduduk</h6>
                </div>
                <div class="card-body text-center">
                    <img class="img-profile rounded-circle mb-3" width="100" src="{{ asset('template/img/undraw_profile.svg') }}">
                    <h5 class="font-weight-bold text-gray-800">{{ $resident->name }}</h5>
                    <p class="text-muted">{{ $resident->nik }}</p>
                    <hr>
                    <div class="text-left">
                        <small class="text-muted font-weight-bold">ALAMAT:</small>
                        <p>{{ $resident->address }}</p>
                        <small class="text-muted font-weight-bold">STATUS KEPENDUDUKAN:</small>
                        <p><span class="badge badge-success">{{ strtoupper($resident->status) }}</span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Pengajuan & Status -->
        <div class="col-lg-8">
            <!-- Form Pengajuan -->
            <div class="card shadow mb-4 border-bottom-success">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Ajukan Permohonan Surat Baru</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('warga.request.submit') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Surat</label>
                                    <select name="letter_type" class="form-control" required>
                                        <option value="SK_DOMISILI">Surat Keterangan Domisili</option>
                                        <option value="SK_TIDAK_MAMPU">Surat Keterangan Tidak Mampu (SKTM)</option>
                                        <option value="SK_USAHA">Surat Keterangan Usaha</option>
                                        <option value="SK_KELAHIRAN">Surat Keterangan Kelahiran</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keperluan</label>
                                    <input type="text" name="remarks" class="form-control" placeholder="Contoh: Daftar Sekolah / Bank" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Kirim Permohonan Surat</button>
                    </form>
                </div>
            </div>

            <!-- Tabel Status -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Riwayat Pengajuan Anda</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jenis Surat</th>
                                    <th>Status</th>
                                    <th>Catatan Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($requests as $req)
                                    <tr>
                                        <td>{{ $req->created_at->format('d/m/Y') }}</td>
                                        <td>{{ str_replace('_', ' ', $req->letter_type) }}</td>
                                        <td>
                                            @if($req->status == 'pending') <span class="badge badge-warning">Menunggu</span>
                                            @elseif($req->status == 'processing') <span class="badge badge-info">Diproses</span>
                                            @elseif($req->status == 'ready') <span class="badge badge-success">Siap Diambil</span>
                                            @elseif($req->status == 'rejected') <span class="badge badge-danger">Ditolak</span>
                                            @else <span class="badge badge-secondary">Selesai</span>
                                            @endif
                                        </td>
                                        <td><small>{{ $req->admin_notes ?? '-' }}</small></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada riwayat permohonan surat.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection