@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Aparatur Desa</h1>
    <a href="{{ route('management.staff.create') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Aparatur
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($staffs as $staff)
                        <tr>
                            <td style="width: 100px;">
                                @if($staff->image)
                                    <img src="{{ asset('storage/' . $staff->image) }}" class="img-fluid rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $staff->name }}</td>
                            <td>{{ $staff->position }}</td>
                            <td>
                                <a href="{{ route('management.staff.edit', $staff->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('management.staff.destroy', $staff->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data aparatur.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
