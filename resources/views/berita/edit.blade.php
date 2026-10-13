@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="container my-5" style="max-width:800px">
    <h2 class="teko fw-bold mb-4">Edit Berita</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('berita.update', $berita) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="judul" class="form-label fw-semibold">Judul</label>
            <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}" class="form-control">
            @error('judul') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="kategori_id" class="form-label fw-semibold">Kategori</label>
            <select name="kategori_id" id="kategori_id" class="form-select">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $k)
                    <option value="{{ $k->id }}" @selected(old('kategori_id', $berita->kategori_id) == $k->id)>{{ $k->nama }}</option>
                @endforeach
            </select>
            @error('kategori_id') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold d-block">Tag</label>
            @foreach ($tags as $tag)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="tags[]"
                           id="tag{{ $tag->id }}" value="{{ $tag->id }}"
                           @checked(in_array($tag->id, old('tags', $berita->tags->pluck('id')->toArray())))>
                    <label class="form-check-label" for="tag{{ $tag->id }}">#{{ $tag->nama }}</label>
                </div>
            @endforeach
        </div>
        <div class="mb-3">
            <label for="isi" class="form-label fw-semibold">Isi Berita</label>
            <textarea name="isi" id="isi" rows="6" class="form-control">{{ old('isi', $berita->isi) }}</textarea>
            @error('isi') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label fw-semibold">Gambar</label>
            @if ($berita->gambar)
                <div>
                    <img src="{{ asset('storage/' . $berita->gambar) }}"
                         class="img-thumbnail mb-2" style="max-height:140px;">
                </div>
            @endif
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
            @error('gambar') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">Batal</a>
    </form>
</div>
@endsection
