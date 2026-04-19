<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'kategori',
        'harga',
        'stok',
        'deskripsi',
        'status',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok'  => 'integer',
    ];

    // ── Scopes ────────────────────────────────────────────────────────────────

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    // ── Accessors (Laravel 9+ style & old-style for compatibility) ────────────

    /**
     * Harga formatted: "Rp 12.500"
     * Accessible as $product->harga_formatted
     */
    public function getHargaFormattedAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->harga, 0, ',', '.');
    }

    /**
     * Badge CSS class berdasarkan status
     * Accessible as $product->status_badge_class
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return $this->status === 'aktif' ? 'badge-aktif' : 'badge-nonaktif';
    }
}
