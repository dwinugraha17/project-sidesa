@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Buat Surat Baru</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('letters.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="letter_type">Jenis Surat</label>
                <select name="letter_type" id="letter_type" class="form-control" required>
                    <option value="SK_DOMISILI">Surat Keterangan Domisili</option>
                    <option value="SK_TM">Surat Keterangan Tidak Mampu</option>
                    <option value="SK_KELAHIRAN">Surat Keterangan Kelahiran</option>
                </select>
            </div>

            <div class="form-group">
                <label for="letter_number">Nomor Surat</label>
                <input type="text" name="letter_number" class="form-control" value="470/   /DS/{{ date('Y') }}" required>
                <small class="text-muted">Sesuaikan nomor urut surat.</small>
            </div>

            <div class="form-group">
                <label for="resident_id">Pilih Penduduk</label>
                <select name="resident_id" id="resident_id" class="form-control" required>
                    <option value="">-- Cari Nama Penduduk --</option>
                    @foreach ($residents as $resident)
                        <option value="{{ $resident->id }}">{{ $resident->nik }} - {{ $resident->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="remarks">Keperluan / Keterangan</label>
                <textarea name="remarks" class="form-control" rows="3" placeholder="Contoh: Pengurusan Rekening Bank" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan & Cetak</button>
            <a href="{{ route('letters.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
