@extends('layouts.landing')

@section('content')

<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white pl-0">
                    <li class="breadcrumb-item"><a href="/" class="text-success">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Berita</li>
                </ol>
            </nav>

            <h1 class="font-weight-bold mb-3">{{ $news->title }}</h1>
            <p class="text-muted">Diposting pada {{ $news->created_at->format('d M Y') }} oleh Admin</p>
            
            @if($news->image)
                <img src="{{ $news->image }}" class="img-fluid rounded mb-4 w-100 shadow-sm" alt="{{ $news->title }}">
            @endif

            <div class="content text-justify">
                {!! nl2br(e($news->content)) !!}
            </div>

            <div class="mt-5">
                <a href="/" class="btn btn-secondary">&larr; Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>

@endsection
