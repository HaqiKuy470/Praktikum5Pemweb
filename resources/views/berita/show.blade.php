@extends('layouts.app')

@section('title', $berita->judul)

@section('content')
<div style="background:linear-gradient(135deg,#0f3460,#1a1a6e);padding:60px 0 40px">
    <div class="container text-white">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-warning text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('berita.index') }}" class="text-warning text-decoration-none">Berita</a></li>
                <li class="breadcrumb-item active text-white">{{ Str::limit($berita->judul, 40) }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container my-5">
    <article class="card border-0 shadow-sm" style="border-radius:14px;overflow:hidden">
        @if ($berita->gambar)
            <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" style="height:380px;object-fit:cover" alt="{{ $berita->judul }}">
        @endif
        <div class="card-body p-4">
            <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                <span class="badge text-white" style="background:#0f3460">{{ $berita->kategori->nama }}</span>
                <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>{{ $berita->created_at->translatedFormat('l, j F Y') }}</small>
                <small class="text-muted"><i class="fas fa-user me-1"></i>{{ $berita->user->name }}</small>
                <small class="text-muted"><i class="fas fa-eye me-1"></i>{{ $berita->dilihat }} dibaca</small>
            </div>

            <h1 class="teko fw-bold mb-4" style="font-size:clamp(1.5rem,3vw,2.2rem);line-height:1.2">{{ $berita->judul }}</h1>

            <div class="article-body" style="font-size:1rem;line-height:1.85;color:#333">
                {!! nl2br(e($berita->isi)) !!}
            </div>

            <div class="mt-4 pt-3 border-top">
                <span class="fw-semibold text-muted small me-2"><i class="fas fa-tags me-1"></i>Tags:</span>
                @foreach ($berita->tags as $tag)
                    <a href="{{ route('berita.index', ['tag' => $tag->id]) }}" class="badge bg-light text-dark border me-1 text-decoration-none rounded-pill fw-normal mb-1">#{{ $tag->nama }}</a>
                @endforeach
            </div>
        </div>
    </article>
</div>
@endsection
