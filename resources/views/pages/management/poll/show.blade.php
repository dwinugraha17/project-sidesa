@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Hasil Polling</h1>
        <a href="{{ route('management.polls.index') }}" class="btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $poll->title }}</h6>
                </div>
                <div class="card-body">
                    <p>{{ $poll->description }}</p>
                    <hr>
                    @php $totalVotes = $poll->options->sum('votes_count'); @endphp
                    
                    <h5 class="mb-4">Total Suara Masuk: <span class="badge badge-primary">{{ $totalVotes }}</span></h5>

                    @foreach($poll->options as $option)
                        @php 
                            $percentage = $totalVotes > 0 ? ($option->votes_count / $totalVotes) * 100 : 0;
                        @endphp
                        <div class="mb-4">
                            <div class="d-flex justify-content-between font-weight-bold mb-1">
                                <span>{{ $option->option_text }}</span>
                                <span>{{ number_format($percentage, 1) }}% ({{ $option->votes_count }} suara)</span>
                            </div>
                            <div class="progress shadow-sm" style="height: 25px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ number_format($percentage, 1) }}%
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-light">
                    <h6 class="m-0 font-weight-bold text-dark">Data Pemilih Terakhir</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Warga</th>
                                    <th>Pilihan</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($poll->votes()->with(['resident', 'option'])->latest()->take(20)->get() as $vote)
                                    <tr>
                                        <td>{{ $vote->resident->name }}</td>
                                        <td><span class="badge badge-info">{{ $vote->option->option_text }}</span></td>
                                        <td>{{ $vote->created_at->format('d/m H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Belum ada pemilih.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($totalVotes > 20)
                        <small class="text-muted text-center d-block">Menampilkan 20 pemilih terakhir.</small>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
