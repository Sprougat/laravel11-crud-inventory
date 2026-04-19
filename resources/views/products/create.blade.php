@extends('layouts.app')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')
@section('page-subtitle', 'Isi form di bawah untuk menambah produk baru')

@section('content')

<div style="margin-bottom:18px;">
    <a href="{{ route('products.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
    </a>
</div>

<div class="row justify-content-center">
<div class="col-lg-8 col-xl-7">
<div class="card-dark">

    {{-- Header --}}
    <div style="display:flex; align-items:center; gap:14px; margin-bottom:24px; padding-bottom:20px; border-bottom:1px solid var(--border);">
        <div style="width:48px; height:48px; background:linear-gradient(135deg,var(--pink),var(--pink-light)); border-radius:13px; display:flex; align-items:center; justify-content:center; font-size:22px; box-shadow:0 6px 22px rgba(255,0,128,.28); flex-shrink:0;">➕</div>
        <div>
            <div style="font-size:16px; font-weight:700; color:var(--text);">Form Tambah Produk</div>
            <div style="font-size:12px; color:var(--text-muted); margin-top:2px;">
                Field bertanda <span style="color:var(--pink);">*</span> wajib diisi
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('products.store') }}" novalidate>
        @csrf

        {{-- Row 1: Kode + Nama --}}
        <div class="row g-3" style="margin-bottom:16px;">
            <div class="col-md-4">
                <label class="f-label" for="kode_produk">
                    Kode Produk <span style="color:var(--pink);">*</span>
                </label>
                <input type="text" id="kode_produk" name="kode_produk"
                       class="f-input {{ $errors->has('kode_produk') ? 'is-invalid' : '' }}"
                       value="{{ old('kode_produk') }}"
                       placeholder="PRD-0001" maxlength="50">
                @error('kode_produk')
                <p class="f-error"><i class="bi bi-x-circle-fill"></i> {{ $message }}</p>
                @enderror
                <p class="f-hint">Harus unik, maks 50 karakter</p>
            </div>
            <div class="col-md-8">
                <label class="f-label" for="nama_produk">
                    Nama Produk <span style="color:var(--pink);">*</span>
                </label>
                <input type="text" id="nama_produk" name="nama_produk"
                       class="f-input {{ $errors->has('nama_produk') ? 'is-invalid' : '' }}"
                       value="{{ old('nama_produk') }}"
                       placeholder="Contoh: Indomie Goreng" maxlength="200">
                @error('nama_produk')
                <p class="f-error"><i class="bi bi-x-circle-fill"></i> {{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Row 2: Kategori + Status --}}
        <div class="row g-3" style="margin-bottom:16px;">
            <div class="col-md-6">
                <label class="f-label" for="kategori">
                    Kategori <span style="color:var(--pink);">*</span>
                </label>
                <input type="text" id="kategori" name="kategori"
                       class="f-input {{ $errors->has('kategori') ? 'is-invalid' : '' }}"
                       value="{{ old('kategori') }}"
                       placeholder="Makanan, Minuman, Sembako…"
                       list="kategoriSuggestions" maxlength="100">
                <datalist id="kategoriSuggestions">
                    @foreach($kategoris as $k)<option value="{{ $k }}">@endforeach
                    <option value="Makanan">
                    <option value="Minuman">
                    <option value="Sembako">
                    <option value="Snack">
                    <option value="Kebersihan">
                    <option value="Perawatan">
                    <option value="Bumbu">
                </datalist>
                @error('kategori')
                <p class="f-error"><i class="bi bi-x-circle-fill"></i> {{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="f-label" for="status">
                    Status <span style="color:var(--pink);">*</span>
                </label>
                <select id="status" name="status"
                        class="f-select {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <option value="">— Pilih Status —</option>
                    <option value="aktif"    {{ old('status') === 'aktif'    ? 'selected' : '' }}>✅ Aktif</option>
                    <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>⛔ Non-Aktif</option>
                </select>
                @error('status')
                <p class="f-error"><i class="bi bi-x-circle-fill"></i> {{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Row 3: Harga + Stok --}}
        <div class="row g-3" style="margin-bottom:16px;">
            <div class="col-md-6">
                <label class="f-label" for="harga">
                    Harga (Rp) <span style="color:var(--pink);">*</span>
                </label>
                <div class="f-input-wrap">
                    <span class="f-prefix" style="color:var(--pink-light); font-weight:600;">Rp</span>
                    <input type="number" id="harga" name="harga"
                           class="f-input {{ $errors->has('harga') ? 'is-invalid' : '' }}"
                           value="{{ old('harga') }}"
                           placeholder="0" min="0" step="500">
                </div>
                @error('harga')
                <p class="f-error"><i class="bi bi-x-circle-fill"></i> {{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="f-label" for="stok">
                    Stok <span style="color:var(--pink);">*</span>
                </label>
                <div class="f-input-wrap">
                    <span class="f-prefix">📦</span>
                    <input type="number" id="stok" name="stok"
                           class="f-input {{ $errors->has('stok') ? 'is-invalid' : '' }}"
                           value="{{ old('stok') }}"
                           placeholder="0" min="0">
                </div>
                @error('stok')
                <p class="f-error"><i class="bi bi-x-circle-fill"></i> {{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Deskripsi --}}
        <div style="margin-bottom:24px;">
            <label class="f-label" for="deskripsi">
                Deskripsi <span style="color:var(--text-faint); font-weight:400;">(Opsional)</span>
            </label>
            <textarea id="deskripsi" name="deskripsi" rows="3"
                      class="f-textarea {{ $errors->has('deskripsi') ? 'is-invalid' : '' }}"
                      placeholder="Deskripsi singkat produk…" maxlength="1000">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
            <p class="f-error"><i class="bi bi-x-circle-fill"></i> {{ $message }}</p>
            @enderror
        </div>

        {{-- Actions --}}
        <div style="display:flex; gap:10px; justify-content:flex-end; padding-top:18px; border-top:1px solid var(--border);">
            <a href="{{ route('products.index') }}" class="btn-ghost">
                <i class="bi bi-x-circle"></i> Batal
            </a>
            <button type="submit" class="btn-pink">
                <i class="bi bi-check-circle-fill"></i> Simpan Produk
            </button>
        </div>

    </form>
</div>
</div>
</div>

@endsection
