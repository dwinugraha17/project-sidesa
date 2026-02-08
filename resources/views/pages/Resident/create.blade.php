@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ isset($resident) ? 'Edit Data Penduduk' : 'Tambah Data Penduduk' }}</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ isset($resident) ? url('/resident/' . $resident->id) : url('/resident') }}" method="POST">
                @csrf
                @if(isset($resident))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nik">NIK <span class="text-danger">*</span></label>
                            <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik', $resident->nik ?? '') }}" required minlength="16" maxlength="16">
                            @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $resident->name ?? '') }}" required maxlength="100">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="birth_place">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" name="birth_place" id="birth_place" class="form-control @error('birth_place') is-invalid @enderror" value="{{ old('birth_place', $resident->birth_place ?? '') }}" required maxlength="100">
                            @error('birth_place') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="birth_date">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', $resident->birth_date ?? '') }}" required>
                            @error('birth_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                <option value="">-- Pilih --</option>
                                <option value="male" {{ old('gender', $resident->gender ?? '') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="female" {{ old('gender', $resident->gender ?? '') == 'female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="religion">Agama</label>
                            <select name="religion" id="religion" class="form-control @error('religion') is-invalid @enderror">
                                <option value="">-- Pilih --</option>
                                @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu'] as $rel)
                                    <option value="{{ $rel }}" {{ old('religion', $resident->religion ?? '') == $rel ? 'selected' : '' }}>{{ $rel }}</option>
                                @endforeach
                            </select>
                            @error('religion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="marital_status">Status Perkawinan <span class="text-danger">*</span></label>
                            <select name="marital_status" id="marital_status" class="form-control @error('marital_status') is-invalid @enderror" required>
                                <option value="">-- Pilih --</option>
                                <option value="single" {{ old('marital_status', $resident->marital_status ?? '') == 'single' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="married" {{ old('marital_status', $resident->marital_status ?? '') == 'married' ? 'selected' : '' }}>Kawin</option>
                                <option value="divorced" {{ old('marital_status', $resident->marital_status ?? '') == 'divorced' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="widowed" {{ old('marital_status', $resident->marital_status ?? '') == 'widowed' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                            @error('marital_status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="occupation">Pekerjaan</label>
                            <input type="text" name="occupation" id="occupation" class="form-control @error('occupation') is-invalid @enderror" value="{{ old('occupation', $resident->occupation ?? '') }}" maxlength="100">
                            @error('occupation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">No. Telepon</label>
                            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $resident->phone ?? '') }}" maxlength="15">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dusun">Dusun <span class="text-danger">*</span></label>
                            <select name="dusun" id="dusun" class="form-control @error('dusun') is-invalid @enderror" required>
                                <option value="">-- Pilih Dusun --</option>
                                <option value="Dusun I" {{ old('dusun', $resident->dusun ?? '') == 'Dusun I' ? 'selected' : '' }}>Dusun I</option>
                                <option value="Dusun II" {{ old('dusun', $resident->dusun ?? '') == 'Dusun II' ? 'selected' : '' }}>Dusun II</option>
                                <option value="Dusun III" {{ old('dusun', $resident->dusun ?? '') == 'Dusun III' ? 'selected' : '' }}>Dusun III</option>
                            </select>
                            @error('dusun') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status Kependudukan <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="active" {{ old('status', $resident->status ?? 'active') == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="moved" {{ old('status', $resident->status ?? '') == 'moved' ? 'selected' : '' }}>Pindah</option>
                                <option value="deceased" {{ old('status', $resident->status ?? '') == 'deceased' ? 'selected' : '' }}>Meninggal</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Alamat Lengkap <span class="text-danger">*</span></label>
                    <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror" required>{{ old('address', $resident->address ?? '') }}</textarea>
                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('/resident') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
