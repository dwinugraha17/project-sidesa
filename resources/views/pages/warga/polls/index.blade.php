@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Polling & Musyawarah Digital</h1>
    </div>

    <div class="row">
        @forelse($polls as $poll)
            <div class="col-lg-6 mb-4">
                <div class="card shadow">
                    <div class="card-header py-3 {{ $poll->hasVoted($residentId) ? 'bg-light' : 'bg-primary text-white' }}">
                        <h6 class="m-0 font-weight-bold">{{ $poll->title }}</h6>
                    </div>
                    <div class="card-body">
                        <p>{{ $poll->description }}</p>
                        
                        @if($poll->end_date)
                            <small class="text-danger d-block mb-3">
                                <i class="fas fa-clock"></i> Berakhir pada: {{ \Carbon\Carbon::parse($poll->end_date)->format('d/m/Y H:i') }}
                            </small>
                        @endif

                        @if($poll->hasVoted($residentId))
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> Anda sudah memberikan suara.
                            </div>
                            <hr>
                            <h6>Hasil Sementara:</h6>
                            @php $totalVotes = $poll->votes()->count(); @endphp
                            @foreach($poll->options as $option)
                                @php 
                                    $optionVotes = $option->votes()->count();
                                    $percentage = $totalVotes > 0 ? ($optionVotes / $totalVotes) * 100 : 0;
                                @endphp
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between small font-weight-bold">
                                        <span>{{ $option->option_text }}</span>
                                        <span>{{ number_format($percentage, 1) }}% ({{ $optionVotes }})</span>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <form action="{{ route('resident.polls.vote', $poll->id) }}" method="POST">
                                @csrf
                                @foreach($poll->options as $option)
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="option{{ $option->id }}" name="poll_option_id" value="{{ $option->id }}" class="custom-control-input" required>
                                        <label class="custom-control-label" for="option{{ $option->id }}">{{ $option->option_text }}</label>
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-primary btn-block mt-3 shadow-sm">Kirim Suara Saya</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Saat ini tidak ada polling aktif.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
