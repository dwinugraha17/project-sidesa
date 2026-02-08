@extends('layouts.app')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Penduduk</h1>
    <a href="/resident/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah
    </a>
</div>

{{-- search & filter --}}
<div class="row mb-3">
    <div class="col-md-4">
        <form action="/resident" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control bg-white border-0 shadow-sm small" placeholder="Cari Nama atau NIK..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- table --}}
<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-responsive table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Status Penduduk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($residents as $item)
                            <tr>
                                <td>{{ $item->nik }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $item->birth_place }}, {{ $item->birth_date }}</td>
                                <td>{{ $item->address }}</td>
                                <td>
                                    @if($item->status == 'active')
                                        <span class="badge badge-success">Aktif</span>
                                    @elseif($item->status == 'moved')
                                        <span class="badge badge-warning">Pindah</span>
                                    @else
                                        <span class="badge badge-danger">Meninggal</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/resident/{{ $item->id }}/edit" class="btn btn-sm btn-warning mr-2">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="/resident/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-eraser"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="mt-3">
                    {{ $residents->withQueryString()->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
