@extends('layouts.app')

@section('title', 'Berita & Informasi')

@section('content')
<div style="background:linear-gradient(135deg,#0f3460,#1a1a6e);padding:60px 0 40px">
    <div class="container text-white">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="text-warning text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item active text-white">Berita</li>
            </ol>
        </nav>
        <h1 class="teko fw-bold mb-0" style="font-size:2.5rem">Berita &amp; Informasi</h1>
        <p style="opacity:0.7">Informasi terkini dari Desa Jalatrang</p>
    </div>
</div>

<div class="container my-5">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        {{-- Filter --}}
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm sticky-top" style="top:80px;border-radius:12px;overflow:hidden">
                <div class="card-header text-white fw-bold" style="background:#0f3460">
                    <i class="fas fa-filter me-2"></i> Filter Berita
                </div>
                <div class="card-body p-3">
                    <form method="GET" action="{{ route('berita.index') }}">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Kata Kunci</label>
                            <input type="text" name="kata_kunci" value="{{ request('kata_kunci') }}" class="form-control form-control-sm" placeholder="Cari berita...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Kategori</label>
                            <select name="kategori" class="form-select form-select-sm">
                                <option value="">Semua Kategori</option>
                                @foreach ($kategoris as $k)
                                    <option value="{{ $k->id }}" @selected(request('kategori') == $k->id)>{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                            <a href="{{ route('berita.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Daftar berita --}}
        <div class="col-lg-9">
            <div class="row g-4">
                @forelse ($beritas as $item)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up">
                        <div class="card border-0 shadow-sm h-100" style="border-radius:12px;overflow:hidden;transition:transform 0.3s,box-shadow 0.3s"
                             onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 10px 30px rgba(0,0,0,0.15)'"
                             onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">
                            <div style="height:160px;overflow:hidden">
                                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://placehold.co/600x320?text=Berita' }}" class="w-100 h-100" style="object-fit:cover;transition:transform 0.4s"
                                     onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'"
                                     alt="{{ $item->judul }}">
                            </div>
                            <div class="card-body p-3 d-flex flex-column">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span class="badge text-white" style="background:#0f3460;font-size:0.7rem">{{ $item->kategori->nama }}</span>
                                    <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>{{ $item->created_at->translatedFormat('d M Y') }}</small>
                                </div>
                                <h6 class="fw-bold mb-2" style="line-height:1.3;flex:1">
                                    <a href="{{ route('berita.show', $item) }}" class="text-decoration-none text-dark">{{ Str::limit($item->judul, 70) }}</a>
                                </h6>
                                <p class="text-muted small mb-2">{{ Str::limit(strip_tags($item->isi), 90) }}</p>
                                <div class="mb-3">
                                    @foreach ($item->tags as $tag)
                                        <a href="{{ route('berita.index', ['tag' => $tag->id]) }}" class="badge bg-light text-secondary border me-1 text-decoration-none small fw-normal" style="font-size:0.68rem">#{{ $tag->nama }}</a>
                                    @endforeach
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                    <small class="text-muted"><i class="fas fa-eye me-1"></i>{{ $item->dilihat }}</small>
                                    <a href="{{ route('berita.show', $item) }}" class="btn btn-sm btn-outline-primary" style="font-size:0.75rem">Baca <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                                @auth
                                    <div class="mt-2 pt-2 border-top d-flex gap-2">
                                        <a href="{{ route('berita.edit', $item) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                        @if (auth()->user()->isAdmin())
                                            <form action="{{ route('berita.destroy', $item) }}" method="POST"
                                                  onsubmit="return confirm('Yakin hapus berita ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-5">Belum ada berita.</div>
                @endforelse
            </div>

            @auth
                <a href="{{ route('berita.create') }}" class="btn btn-success w-100 mt-3">+ Tambah Berita</a>
            @endauth

            <div class="d-flex justify-content-center mt-5">
                {{ $beritas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
