<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk    = Product::count();
        $totalStok      = Product::sum('stok');
        $produkAktif    = Product::where('status', 'aktif')->count();
        $produkNonAktif = Product::where('status', 'nonaktif')->count();

        $kategoriStats = Product::selectRaw('kategori, COUNT(*) as jumlah, SUM(stok) as total_stok')
            ->groupBy('kategori')
            ->orderByDesc('jumlah')
            ->get();

        $produkStokRendah = Product::where('stok', '<=', 10)
            ->where('status', 'aktif')
            ->orderBy('stok', 'asc')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalProduk',
            'totalStok',
            'produkAktif',
            'produkNonAktif',
            'kategoriStats',
            'produkStokRendah'
        ));
    }
}
