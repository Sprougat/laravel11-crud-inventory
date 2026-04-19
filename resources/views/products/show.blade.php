@extends('layouts.app')

@section('title', 'Detail Produk')
@section('page-title', 'Detail Produk')
@section('page-subtitle', 'Informasi lengkap produk')

@section('content')

<div style="display:flex; gap:8px; margin-bottom:18px; flex-wrap:wrap;">
    <a href="{{ route('products.index') }}" class="btn-ghost">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
    </a>
    <a href="{{ route('products.edit', $product) }}" class="btn-pink">
        <i class="bi bi-pencil-fill"></i> Edit Produk
    </a>
</div>

<div class="row g-3">

    {{-- Main Info --}}
    <div class="col-lg-8">
        <div class="card-dark">

            {{-- Product header --}}
            <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:12px; margin-bottom:22px; padding-bottom:20px; border-bottom:1px solid var(--border);">
                <div style="display:flex; align-items:center; gap:14px;">
                    <div style="width:54px; height:54px; background:var(--bg-card2); border:1px solid var(--border); border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:26px; flex-shrink:0;">🏷️</div>
                    <div>
                        <h2 style="font-size:19px; font-weight:800; color:var(--text); margin-bottom:5px;">{{ $product->nama_produk }}</h2>
                        <span class="kode">{{ $product->kode_produk }}</span>
                    </div>
                </div>
                <span class="{{ $product->status_badge_class }}" style="flex-shrink:0; padding:5px 14px; font-size:12px;">
                    <i class="bi bi-circle-fill" style="font-size:6px;"></i>
                    {{ $product->status === 'aktif' ? 'Aktif' : 'Non-Aktif' }}
                </span>
            </div>

            {{-- Stats Grid --}}
            <div class="row g-3 mb-4">
                <div class="col-sm-6">
                    <div class="card-dark-sm">
                        <div style="font-size:10.5px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-muted); margin-bottom:7px;">
                            <i class="bi bi-tags-fill text-pink" style="margin-right:5px;"></i>Kategori
                        </div>
                        <div style="font-size:16px; font-weight:700; color:var(--text);">{{ $product->kategori }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card-dark-sm">
                        <div style="font-size:10.5px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-muted); margin-bottom:7px;">
                            <i class="bi bi-tag-fill text-pink" style="margin-right:5px;"></i>Harga Jual
                        </div>
                        <div style="font-size:20px; font-weight:800; color:var(--pink-light);">{{ $product->harga_formatted }}</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card-dark-sm">
                        <div style="font-size:10.5px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-muted); margin-bottom:7px;">
                            <i class="bi bi-boxes text-pink" style="margin-right:5px;"></i>Stok Tersedia
                        </div>
                        <div style="font-size:20px; font-weight:800;">
                            @if($product->stok == 0)
                                <span style="color:#FF5252;">Habis (0 unit)</span>
                            @elseif($product->stok <= 10)
                                <span style="color:var(--yellow);">
                                    <i class="bi bi-exclamation-triangle-fill" style="font-size:16px;"></i>
                                    {{ $product->stok }} unit
                                </span>
                            @else
                                <span style="color:var(--green);">{{ number_format($product->stok) }} unit</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card-dark-sm">
                        <div style="font-size:10.5px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-muted); margin-bottom:7px;">
                            <i class="bi bi-calculator text-pink" style="margin-right:5px;"></i>Nilai Stok
                        </div>
                        <div style="font-size:16px; font-weight:700; color:var(--text);">
                            Rp {{ number_format((float)$product->harga * $product->stok, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Deskripsi --}}
            @if($product->deskripsi)
            <div>
                <div style="font-size:10.5px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-muted); margin-bottom:9px;">
                    <i class="bi bi-file-text text-pink" style="margin-right:5px;"></i>Deskripsi
                </div>
                <div style="font-size:13.5px; color:var(--text); line-height:1.7; background:var(--bg-card2); padding:14px 16px; border-radius:9px; border:1px solid var(--border);">
                    {{ $product->deskripsi }}
                </div>
            </div>
            @endif

        </div>
    </div>

    {{-- Sidebar --}}
    <div class="col-lg-4">

        {{-- Timestamps --}}
        <div class="card-dark mb-3">
            <div style="font-size:10.5px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-muted); margin-bottom:14px;">
                <i class="bi bi-clock-history text-pink" style="margin-right:5px;"></i>Riwayat
            </div>
            <div style="display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid var(--border);">
                <span style="font-size:12px; color:var(--text-muted);">Dibuat</span>
                <span style="font-size:12px; font-weight:600; color:var(--text);">{{ $product->created_at->format('d M Y, H:i') }}</span>
            </div>
            <div style="display:flex; justify-content:space-between; padding:8px 0;">
                <span style="font-size:12px; color:var(--text-muted);">Diperbarui</span>
                <span style="font-size:12px; font-weight:600; color:var(--text);">{{ $product->updated_at->diffForHumans() }}</span>
            </div>
        </div>

        {{-- Actions --}}
        <div class="card-dark">
            <div style="font-size:10.5px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:var(--text-muted); margin-bottom:14px;">
                <i class="bi bi-lightning-fill text-pink" style="margin-right:5px;"></i>Aksi
            </div>
            <div style="display:flex; flex-direction:column; gap:8px;">
                <a href="{{ route('products.edit', $product) }}" class="btn-pink" style="justify-content:center;">
                    <i class="bi bi-pencil-fill"></i> Edit Produk Ini
                </a>
                <button type="button" class="btn-ghost-danger" style="justify-content:center;"
                        onclick="openDelModal()">
                    <i class="bi bi-trash-fill"></i> Hapus Produk
                </button>
                <form id="del-form" action="{{ route('products.destroy', $product) }}" method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>

    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-trash3-fill" style="color:#FF5252; margin-right:8px;"></i>Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="text-align:center; padding:28px 22px !important;">
                <div style="font-size:46px; margin-bottom:12px;">🗑️</div>
                <p style="font-size:14.5px; color:var(--text); margin-bottom:5px;">Yakin ingin menghapus produk ini?</p>
                <p style="font-size:14px; font-weight:700; color:var(--pink-light); margin-bottom:14px;">{{ $product->nama_produk }}</p>
                <div style="background:rgba(255,23,68,.09); border:1px solid rgba(255,23,68,.18); border-radius:8px; padding:10px 14px; font-size:13px; color:#FF5252;">
                    <i class="bi bi-exclamation-triangle-fill" style="margin-right:6px;"></i>
                    Tindakan ini tidak dapat dibatalkan!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-ghost" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Batal
                </button>
                <button type="button" class="btn-pink"
                        style="background:linear-gradient(135deg,#FF1744,#FF5252); box-shadow:0 3px 14px rgba(255,23,68,.35);"
                        onclick="document.getElementById('del-form').submit()">
                    <i class="bi bi-trash-fill"></i> Ya, Hapus!
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const delModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    function openDelModal() { delModal.show(); }
</script>
@endpush
