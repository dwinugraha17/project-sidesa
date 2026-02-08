@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buat Polling Baru</h1>
        <a href="{{ route('management.polls.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('management.polls.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Judul Polling / Pertanyaan</label>
                    <input type="text" name="title" class="form-control" placeholder="Contoh: Apakah setuju dilakukan pembangunan gapura?" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi / Penjelasan (Opsional)</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Berikan konteks agar warga memahami maksud polling..."></textarea>
                </div>

                <div class="form-group">
                    <label>Tanggal Berakhir (Opsional)</label>
                    <input type="datetime-local" name="end_date" class="form-control">
                </div>

                <hr>
                <h5>Pilihan Jawaban</h5>
                <div id="options-container">
                    <div class="input-group mb-2">
                        <input type="text" name="options[]" class="form-control" placeholder="Pilihan 1" required>
                    </div>
                    <div class="input-group mb-2">
                        <input type="text" name="options[]" class="form-control" placeholder="Pilihan 2" required>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary mb-4" onclick="addOption()">
                    <i class="fas fa-plus"></i> Tambah Pilihan
                </button>

                <button type="submit" class="btn btn-primary btn-block shadow-sm">Simpan & Publikasikan</button>
            </form>
        </div>
    </div>
</div>

<script>
function addOption() {
    const container = document.getElementById('options-container');
    const optionCount = container.getElementsByClassName('input-group').length + 1;
    
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" name="options[]" class="form-control" placeholder="Pilihan ${optionCount}" required>
        <div class="input-group-append">
            <button class="btn btn-outline-danger" type="button" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    container.appendChild(div);
}
</script>
@endsection
