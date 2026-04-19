<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                  ->orWhere('kode_produk', 'like', "%{$search}%")
                  ->orWhere('kategori',    'like', "%{$search}%");
            });
        }

        // Filter kategori
        if ($kategori = $request->input('kategori')) {
            $query->where('kategori', $kategori);
        }

        // Filter status
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // Sorting
        $allowed = ['kode_produk', 'nama_produk', 'kategori', 'harga', 'stok', 'status', 'created_at'];
        $sortBy  = in_array($request->input('sort'), $allowed) ? $request->input('sort') : 'created_at';
        $sortDir = $request->input('dir') === 'asc' ? 'asc' : 'desc';
        $query->orderBy($sortBy, $sortDir);

        $products  = $query->paginate(10)->withQueryString();
        $kategoris = Product::distinct()->orderBy('kategori')->pluck('kategori');

        return view('products.index', compact('products', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Product::distinct()->orderBy('kategori')->pluck('kategori');
        return view('products.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_produk' => ['required', 'string', 'max:50', 'unique:products,kode_produk'],
            'nama_produk' => ['required', 'string', 'max:200'],
            'kategori'    => ['required', 'string', 'max:100'],
            'harga'       => ['required', 'numeric', 'min:0'],
            'stok'        => ['required', 'integer', 'min:0'],
            'deskripsi'   => ['nullable', 'string', 'max:1000'],
            'status'      => ['required', 'in:aktif,nonaktif'],
        ], [
            'kode_produk.required' => 'Kode produk wajib diisi.',
            'kode_produk.unique'   => 'Kode produk sudah digunakan, pilih kode lain.',
            'kode_produk.max'      => 'Kode produk maksimal 50 karakter.',
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'kategori.required'    => 'Kategori wajib diisi.',
            'harga.required'       => 'Harga wajib diisi.',
            'harga.numeric'        => 'Harga harus berupa angka.',
            'harga.min'            => 'Harga tidak boleh kurang dari 0.',
            'stok.required'        => 'Stok wajib diisi.',
            'stok.integer'         => 'Stok harus berupa angka bulat.',
            'stok.min'             => 'Stok tidak boleh kurang dari 0.',
            'status.required'      => 'Status wajib dipilih.',
            'status.in'            => 'Status tidak valid.',
        ]);

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk <strong>' . e($validated['nama_produk']) . '</strong> berhasil ditambahkan! ✨');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $kategoris = Product::distinct()->orderBy('kategori')->pluck('kategori');
        return view('products.edit', compact('product', 'kategoris'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'kode_produk' => ['required', 'string', 'max:50', 'unique:products,kode_produk,' . $product->id],
            'nama_produk' => ['required', 'string', 'max:200'],
            'kategori'    => ['required', 'string', 'max:100'],
            'harga'       => ['required', 'numeric', 'min:0'],
            'stok'        => ['required', 'integer', 'min:0'],
            'deskripsi'   => ['nullable', 'string', 'max:1000'],
            'status'      => ['required', 'in:aktif,nonaktif'],
        ], [
            'kode_produk.required' => 'Kode produk wajib diisi.',
            'kode_produk.unique'   => 'Kode produk sudah digunakan produk lain.',
            'nama_produk.required' => 'Nama produk wajib diisi.',
            'kategori.required'    => 'Kategori wajib diisi.',
            'harga.required'       => 'Harga wajib diisi.',
            'harga.numeric'        => 'Harga harus berupa angka.',
            'harga.min'            => 'Harga tidak boleh kurang dari 0.',
            'stok.required'        => 'Stok wajib diisi.',
            'stok.integer'         => 'Stok harus berupa angka bulat.',
            'stok.min'             => 'Stok tidak boleh kurang dari 0.',
            'status.required'      => 'Status wajib dipilih.',
            'status.in'            => 'Status tidak valid.',
        ]);

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk <strong>' . e($validated['nama_produk']) . '</strong> berhasil diperbarui! 💫');
    }

    public function destroy(Product $product)
    {
        $nama = $product->nama_produk;
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk <strong>' . e($nama) . '</strong> berhasil dihapus.');
    }
}
