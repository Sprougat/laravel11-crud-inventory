@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan inventaris toko')

@push('styles')
<style>
    .stat-card {
        border-radius: 14px;
        padding: 20px 22px;
        border: 1px solid var(--border);
        height: 100%;
    }
    .stat-icon {
        width: 44px; height: 44px;
        border-radius: 11px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px;
        margin-bottom: 14px;
    }
    .stat-val  { font-size: 30px; font-weight: 800; line-height: 1; }
    .stat-lbl  { font-size: 12.5px; color: var(--text-muted); margin-top: 4px; }
    .stat-badge {
        font-size: 10.5px; font-weight: 700; letter-spacing: .5px;
        padding: 3px 9px; border-radius: 20px;
    }
</style>
@endpush

@section('content')

{{-- ── Stat Cards ──────────────────────────────────────────────────────────── --}}
<div class="row g-3 mb-4">

    {{-- Total Produk --}}
    <div class="col-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(145deg,#13111A,#1a0d16); border-color:rgba(255,0,128,.25);">
            <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                <div class="stat-icon" style="background:rgba(255,0,128,.14);">📦</div>
                <span class="stat-badge" style="background:rgba(255,0,128,.12); color:var(--pink-light); border:1px solid rgba(255,0,128,.2);">TOTAL</span>
            </div>
            <div class="stat-val">{{ number_format($totalProduk) }}</div>
            <div class="stat-lbl">Total Produk</div>
        </div>
    </div>

    {{-- Produk Aktif --}}
    <div class="col-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(145deg,#0e1510,#0d1a0f); border-color:rgba(0,230,118,.20);">
            <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                <div class="stat-icon" style="background:rgba(0,230,118,.11);">✅</div>
                <span class="stat-badge" style="background:rgba(0,230,118,.10); color:var(--green); border:1px solid rgba(0,230,118,.18);">AKTIF</span>
            </div>
            <div class="stat-val" style="color:var(--green);">{{ number_format($produkAktif) }}</div>
            <div class="stat-lbl">Produk Aktif</div>
        </div>
    </div>

    {{-- Total Stok --}}
    <div class="col-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(145deg,#0d1118,#0d131a); border-color:rgba(0,200,255,.20);">
            <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                <div class="stat-icon" style="background:rgba(0,200,255,.11);">📊</div>
                <span class="stat-badge" style="background:rgba(0,200,255,.10); color:var(--cyan); border:1px solid rgba(0,200,255,.18);">STOK</span>
            </div>
            <div class="stat-val" style="color:var(--cyan);">{{ number_format($totalStok) }}</div>
            <div class="stat-lbl">Total Unit Stok</div>
        </div>
    </div>

    {{-- Non-Aktif --}}
    <div class="col-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(145deg,#170d0d,#1a0f0d); border-color:rgba(255,23,68,.20);">
            <div style="display:flex; justify-content:space-between; align-items:flex-start;">
                <div class="stat-icon" style="background:rgba(255,23,68,.11);">⛔</div>
                <span class="stat-badge" style="background:rgba(255,23,68,.10); color:#FF5252; border:1px solid rgba(255,23,68,.18);">NONAKTIF</span>
            </div>
            <div class="stat-val" style="color:#FF5252;">{{ number_format($produkNonAktif) }}</div>
            <div class="stat-lbl">Produk Non-Aktif</div>
        </div>
    </div>

</div>

{{-- ── Bottom Row ───────────────────────────────────────────────────────────── --}}
<div class="row g-3 mb-3">

    {{-- Kategori Stats --}}
    <div class="col-lg-7">
        <div class="card-dark h-100">
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:18px;">
                <div>
                    <div style="font-size:14.5px; font-weight:700; color:var(--text);">
                        <i class="bi bi-tags-fill text-pink" style="margin-right:7px;"></i>Statistik Kategori
                    </div>
                    <div style="font-size:11.5px; color:var(--text-muted); margin-top:2px;">Produk &amp; stok per kategori</div>
                </div>
                <a href="{{ route('products.index') }}" class="btn-ghost" style="font-size:12px; padding:6px 13px;">
                    Lihat Semua
                </a>
            </div>

            @php
                $palette = ['#FF0080','#FF4DA6','#00C8FF','#00E676','#FFD600','#B44FFF','#FF8C00'];
            @endphp

            @forelse($kategoriStats as $k)
            @php
                $pct   = $totalProduk > 0 ? round(($k->jumlah / $totalProduk) * 100) : 0;
                $color = $palette[$loop->index % count($palette)];
            @endphp
            <div style="margin-bottom:14px;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:5px;">
                    <span style="font-size:13px; font-weight:600; color:var(--text);">{{ $k->kategori }}</span>
                    <span style="font-size:12px; color:var(--text-muted);">
                        <span style="font-weight:700; color:{{ $color }}">{{ $k->jumlah }}</span> produk
                        &nbsp;·&nbsp; {{ number_format($k->total_stok) }} unit
                    </span>
                </div>
                <div style="height:5px; background:var(--bg-card2); border-radius:3px; overflow:hidden;">
                    <div style="height:100%; width:{{ $pct }}%; background:{{ $color }}; border-radius:3px; transition:width .6s ease;"></div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">📦</div>
                <p style="color:var(--text-muted);">Belum ada data kategori.</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Stok Rendah --}}
    <div class="col-lg-5">
        <div class="card-dark h-100">
            <div style="margin-bottom:18px;">
                <div style="font-size:14.5px; font-weight:700; color:var(--text);">
                    <i class="bi bi-exclamation-triangle-fill" style="color:var(--yellow); margin-right:7px;"></i>Stok Hampir Habis
                </div>
                <div style="font-size:11.5px; color:var(--text-muted); margin-top:2px;">Produk aktif dengan stok ≤ 10 unit</div>
            </div>

            @forelse($produkStokRendah as $p)
            <div style="display:flex; align-items:center; justify-content:space-between; padding:9px 0; border-bottom:1px solid var(--border);">
                <div style="min-width:0; flex:1;">
                    <div style="font-size:13px; font-weight:600; color:var(--text); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                        {{ $p->nama_produk }}
                    </div>
                    <div style="font-size:11px; color:var(--text-muted);">{{ $p->kode_produk }}</div>
                </div>
                <div style="margin-left:12px; flex-shrink:0;">
                    @if($p->stok == 0)
                    <span style="background:rgba(255,23,68,.15); color:#FF5252; border:1px solid rgba(255,23,68,.25); font-size:11px; font-weight:700; padding:3px 9px; border-radius:20px;">HABIS</span>
                    @else
                    <span style="background:rgba(255,214,0,.10); color:var(--yellow); border:1px solid rgba(255,214,0,.22); font-size:11px; font-weight:700; padding:3px 9px; border-radius:20px;">{{ $p->stok }} unit</span>
                    @endif
                </div>
            </div>
            @empty
            <div class="empty-state" style="padding:30px 0;">
                <div class="empty-icon" style="font-size:38px; opacity:.6;">🎉</div>
                <p style="color:var(--green); font-weight:600; font-size:13.5px;">Semua stok aman!</p>
                <p style="font-size:12px; color:var(--text-muted); margin-top:4px;">Tidak ada produk stok rendah.</p>
            </div>
            @endforelse

            @if($produkStokRendah->count() > 0)
            <div style="margin-top:14px;">
                <a href="{{ route('products.index') }}" class="btn-pink" style="width:100%; justify-content:center;">
                    <i class="bi bi-arrow-right-circle"></i> Kelola Produk
                </a>
            </div>
            @endif
        </div>
    </div>

</div>

{{-- ── Quick Actions ────────────────────────────────────────────────────────── --}}
<div class="card-dark" style="padding:18px 22px;">
    <div style="font-size:11px; font-weight:700; letter-spacing:1.2px; text-transform:uppercase; color:var(--text-faint); margin-bottom:14px;">
        ⚡ Aksi Cepat
    </div>
    <div style="display:flex; flex-wrap:wrap; gap:10px;">
        <a href="{{ route('products.create') }}" class="btn-pink">
            <i class="bi bi-plus-lg"></i> Tambah Produk
        </a>
        <a href="{{ route('products.index') }}" class="btn-ghost">
            <i class="bi bi-table"></i> Semua Produk
        </a>
        <a href="{{ route('products.index') }}?status=nonaktif" class="btn-ghost">
            <i class="bi bi-toggle-off"></i> Produk Non-Aktif
        </a>
        <a href="{{ route('products.index') }}?sort=stok&dir=asc" class="btn-ghost">
            <i class="bi bi-sort-numeric-up"></i> Stok Terendah
        </a>
    </div>
</div>

@endsection
