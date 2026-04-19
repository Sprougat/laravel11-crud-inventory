@extends('layouts.app')

@section('title', 'Daftar Produk')
@section('page-title', 'Daftar Produk')
@section('page-subtitle', 'Kelola seluruh data produk toko')

@section('content')

{{-- ── Toolbar ──────────────────────────────────────────────────────────────── --}}
<div style="display:flex; flex-wrap:wrap; gap:10px; align-items:flex-start; justify-content:space-between; margin-bottom:20px;">

    {{-- Search & Filter Form --}}
    <form method="GET" action="{{ route('products.index') }}"
          style="display:flex; flex-wrap:wrap; gap:8px; align-items:center;">

        {{-- Search --}}
        <div class="f-input-wrap" style="position:relative;">
            <i class="bi bi-search f-prefix" style="color:var(--text-muted);"></i>
            <input type="text" name="search" value="{{ request('search') }}"
                   class="f-input" style="width:210px; padding-left:36px;"
                   placeholder="Cari nama / kode…">
        </div>

        {{-- Filter Kategori --}}
        <select name="kategori" class="f-select" style="width:148px;">
            <option value="">Semua Kategori</option>
            @foreach($kategoris as $kat)
            <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
            @endforeach
        </select>

        {{-- Filter Status --}}
        <select name="status" class="f-select" style="width:140px;">
            <option value="">Semua Status</option>
            <option value="aktif"    {{ request('status') == 'aktif'    ? 'selected' : '' }}>Aktif</option>
            <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
        </select>

        <button type="submit" class="btn-pink"><i class="bi bi-filter"></i> Filter</button>

        @if(request()->hasAny(['search','kategori','status']))
        <a href="{{ route('products.index') }}" class="btn-ghost">
            <i class="bi bi-x-circle"></i> Reset
        </a>
        @endif
    </form>

    {{-- Tambah --}}
    <a href="{{ route('products.create') }}" class="btn-pink">
        <i class="bi bi-plus-lg"></i> Tambah Produk
    </a>
</div>

{{-- ── Table Card ───────────────────────────────────────────────────────────── --}}
<div class="card-dark" style="padding:0; overflow:hidden;">

    {{-- card header --}}
    <div style="display:flex; align-items:center; justify-content:space-between; padding:14px 18px; border-bottom:1px solid var(--border);">
        <div style="font-size:14px; font-weight:600; color:var(--text);">
            <i class="bi bi-table text-pink" style="margin-right:7px;"></i> Data Produk
        </div>
        <div style="font-size:12px; color:var(--text-muted);">
            @if($products->total() > 0)
            Menampilkan
            <strong style="color:var(--text);">{{ $products->firstItem() }}–{{ $products->lastItem() }}</strong>
            dari <strong style="color:var(--pink-light);">{{ $products->total() }}</strong> produk
            @else
            Tidak ada produk ditemukan
            @endif
        </div>
    </div>

    @if($products->count() > 0)

    {{-- table --}}
    <div class="t-wrap">
        <table class="tbl">
            <thead>
                <tr>
                    <th style="width:40px;">#</th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['sort'=>'kode_produk','dir'=> request('sort')=='kode_produk' && request('dir')=='asc' ? 'desc' : 'asc']) }}" class="sort-link">
                            Kode
                            @if(request('sort')=='kode_produk')
                                <i class="bi bi-caret-{{ request('dir')=='asc' ? 'up' : 'down' }}-fill text-pink"></i>
                            @else
                                <i class="bi bi-caret-down" style="opacity:.25;"></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['sort'=>'nama_produk','dir'=> request('sort')=='nama_produk' && request('dir')=='asc' ? 'desc' : 'asc']) }}" class="sort-link">
                            Nama Produk
                            @if(request('sort')=='nama_produk')
                                <i class="bi bi-caret-{{ request('dir')=='asc' ? 'up' : 'down' }}-fill text-pink"></i>
                            @else
                                <i class="bi bi-caret-down" style="opacity:.25;"></i>
                            @endif
                        </a>
                    </th>
                    <th>Kategori</th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['sort'=>'harga','dir'=> request('sort')=='harga' && request('dir')=='asc' ? 'desc' : 'asc']) }}" class="sort-link">
                            Harga
                            @if(request('sort')=='harga')
                                <i class="bi bi-caret-{{ request('dir')=='asc' ? 'up' : 'down' }}-fill text-pink"></i>
                            @else
                                <i class="bi bi-caret-down" style="opacity:.25;"></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a href="{{ request()->fullUrlWithQuery(['sort'=>'stok','dir'=> request('sort')=='stok' && request('dir')=='asc' ? 'desc' : 'asc']) }}" class="sort-link">
                            Stok
                            @if(request('sort')=='stok')
                                <i class="bi bi-caret-{{ request('dir')=='asc' ? 'up' : 'down' }}-fill text-pink"></i>
                            @else
                                <i class="bi bi-caret-down" style="opacity:.25;"></i>
                            @endif
                        </a>
                    </th>
                    <th>Status</th>
                    <th style="text-align:center; width:110px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                <tr>
                    <td style="color:var(--text-faint); font-size:12px;">{{ $products->firstItem() + $loop->index }}</td>
                    <td><span class="kode">{{ $p->kode_produk }}</span></td>
                    <td>
                        <div style="font-weight:600;">{{ $p->nama_produk }}</div>
                        @if($p->deskripsi)
                        <div style="font-size:11.5px; color:var(--text-muted); white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:220px;">
                            {{ $p->deskripsi }}
                        </div>
                        @endif
                    </td>
                    <td>
                        <span style="background:var(--bg-card2); color:var(--text-muted); font-size:11.5px; padding:3px 9px; border-radius:6px; border:1px solid var(--border);">
                            {{ $p->kategori }}
                        </span>
                    </td>
                    <td style="font-weight:700; color:var(--pink-light); white-space:nowrap;">
                        {{ $p->harga_formatted }}
                    </td>
                    <td>
                        @if($p->stok == 0)
                            <span style="color:#FF5252; font-weight:700;">Habis</span>
                        @elseif($p->stok <= 10)
                            <span style="color:var(--yellow); font-weight:700;">
                                <i class="bi bi-exclamation-triangle-fill" style="font-size:10px;"></i>
                                {{ $p->stok }}
                            </span>
                        @else
                            <span style="font-weight:600;">{{ number_format($p->stok) }}</span>
                        @endif
                    </td>
                    <td>
                        <span class="{{ $p->status_badge_class }}">
                            <i class="bi bi-circle-fill" style="font-size:6px;"></i>
                            {{ $p->status === 'aktif' ? 'Aktif' : 'Non-Aktif' }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex; gap:4px; justify-content:center;">
                            <a href="{{ route('products.show', $p) }}" class="ibtn ibtn-view" title="Detail">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{ route('products.edit', $p) }}" class="ibtn ibtn-edit" title="Edit">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <button type="button" class="ibtn ibtn-del" title="Hapus"
                                    onclick="openDeleteModal({{ $p->id }}, '{{ addslashes($p->nama_produk) }}')">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                            {{-- Hidden delete form --}}
                            <form id="del-{{ $p->id }}"
                                  action="{{ route('products.destroy', $p) }}"
                                  method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($products->hasPages())
    <div style="display:flex; align-items:center; justify-content:space-between; padding:12px 18px; border-top:1px solid var(--border); flex-wrap:wrap; gap:8px;">
        <div style="font-size:12px; color:var(--text-muted);">
            Halaman {{ $products->currentPage() }} dari {{ $products->lastPage() }}
        </div>
        {{ $products->links() }}
    </div>
    @endif

    @else
    {{-- Empty State --}}
    <div class="empty-state">
        <div class="empty-icon">🔍</div>
        <h5 style="font-weight:700; margin-bottom:6px;">Produk Tidak Ditemukan</h5>
        <p style="font-size:13.5px; color:var(--text-muted); margin-bottom:18px;">
            @if(request()->hasAny(['search','kategori','status']))
                Tidak ada produk yang cocok dengan filter Anda.
            @else
                Belum ada data produk. Mulai tambah produk pertama!
            @endif
        </p>
        @if(request()->hasAny(['search','kategori','status']))
            <a href="{{ route('products.index') }}" class="btn-ghost">
                <i class="bi bi-arrow-left"></i> Reset Filter
            </a>
        @else
            <a href="{{ route('products.create') }}" class="btn-pink">
                <i class="bi bi-plus-lg"></i> Tambah Produk Pertama
            </a>
        @endif
    </div>
    @endif

</div>{{-- /card --}}

{{-- ── Delete Confirm Modal ─────────────────────────────────────────────────── --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-trash3-fill" style="color:#FF5252; margin-right:8px;"></i>
                    Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="text-align:center; padding:28px 22px !important;">
                <div style="font-size:46px; margin-bottom:12px;">🗑️</div>
                <p style="font-size:14.5px; color:var(--text); margin-bottom:5px;">Hapus produk ini?</p>
                <p id="del-name" style="font-size:14px; font-weight:700; color:var(--pink-light); margin-bottom:14px;"></p>
                <div style="background:rgba(255,23,68,.09); border:1px solid rgba(255,23,68,.18); border-radius:8px; padding:10px 14px; font-size:13px; color:#FF5252;">
                    <i class="bi bi-exclamation-triangle-fill" style="margin-right:6px;"></i>
                    Tindakan ini tidak dapat dibatalkan!
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-ghost" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Batal
                </button>
                <button type="button" id="del-confirm"
                        class="btn-pink" style="background:linear-gradient(135deg,#FF1744,#FF5252); box-shadow:0 3px 14px rgba(255,23,68,.35);">
                    <i class="bi bi-trash-fill"></i> Ya, Hapus!
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let deleteId = null;
    const delModal = new bootstrap.Modal(document.getElementById('deleteModal'));

    function openDeleteModal(id, name) {
        deleteId = id;
        document.getElementById('del-name').textContent = name;
        delModal.show();
    }

    document.getElementById('del-confirm').addEventListener('click', function () {
        if (deleteId) {
            document.getElementById('del-' + deleteId).submit();
        }
    });
</script>
@endpush
