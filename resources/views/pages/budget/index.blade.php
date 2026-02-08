@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Keuangan Desa (APBDes {{ $year }})</h1>
    <div>
        <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addBudgetModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Anggaran
        </button>
        <button class="btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#addTransactionModal">
            <i class="fas fa-money-bill-wave fa-sm text-white-50"></i> Catat Realisasi
        </button>
    </div>
</div>

<div class="row">
    <!-- Pendapatan -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pendapatan (Anggaran)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
                        <div class="mt-2 text-xs">Realisasi: Rp {{ number_format($realizedIncome, 0, ',', '.') }} ({{ $totalIncome > 0 ? round(($realizedIncome / $totalIncome) * 100, 1) : 0 }}%)</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Belanja -->
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Belanja (Anggaran)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalExpense, 0, ',', '.') }}</div>
                        <div class="mt-2 text-xs">Realisasi: Rp {{ number_format($realizedExpense, 0, ',', '.') }} ({{ $totalExpense > 0 ? round(($realizedExpense / $totalExpense) * 100, 1) : 0 }}%)</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-arrow-up fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Rincian APBDes</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Jenis</th>
                        <th>Kategori</th>
                        <th>Anggaran (Pagu)</th>
                        <th>Realisasi</th>
                        <th>%</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($budgets as $budget)
                        @php
                            $percent = $budget->amount > 0 ? ($budget->transactions_sum_amount / $budget->amount) * 100 : 0;
                            $color = $budget->type == 'income' ? 'success' : 'danger';
                        @endphp
                        <tr>
                            <td>
                                <span class="badge badge-{{ $color }}">
                                    {{ $budget->type == 'income' ? 'Pendapatan' : 'Belanja' }}
                                </span>
                            </td>
                            <td>{{ $budget->category }}</td>
                            <td class="text-right">Rp {{ number_format($budget->amount, 0, ',', '.') }}</td>
                            <td class="text-right">Rp {{ number_format($budget->transactions_sum_amount ?? 0, 0, ',', '.') }}</td>
                            <td>
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-{{ $color }}" role="progressbar" style="width: {{ $percent }}%" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small>{{ round($percent, 1) }}%</small>
                            </td>
                            <td>{{ $budget->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add Budget -->
<div class="modal fade" id="addBudgetModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pos Anggaran</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('budget.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tahun Anggaran</label>
                        <input type="number" name="year" class="form-control" value="{{ date('Y') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis</label>
                        <select name="type" class="form-control" required>
                            <option value="income">Pendapatan</option>
                            <option value="expense">Belanja</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" name="category" class="form-control" placeholder="Contoh: Dana Desa / Pembangunan Jalan" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Pagu Anggaran (Rp)</label>
                        <input type="number" name="amount" class="form-control" placeholder="0" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="description" class="form-control"></textarea>
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

<!-- Modal Add Transaction -->
<div class="modal fade" id="addTransactionModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Catat Realisasi (Transaksi)</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('budget.transaction.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Pos Anggaran</label>
                        <select name="budget_id" class="form-control" required>
                            @foreach($budgets as $b)
                                <option value="{{ $b->id }}">{{ $b->type == 'income' ? '[+]' : '[-]' }} {{ $b->category }} (Sisa: {{ number_format($b->amount - ($b->transactions_sum_amount ?? 0)) }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Realisasi (Rp)</label>
                        <input type="number" name="amount" class="form-control" placeholder="0" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan Transaksi</label>
                        <textarea name="description" class="form-control" placeholder="Contoh: Pembelian Semen 50 Sak" required></textarea>
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
