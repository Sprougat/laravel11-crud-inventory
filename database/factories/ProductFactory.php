<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Daftar produk toko realistis
     */
    private static array $produkList = [
        ['nama' => 'Indomie Goreng',            'kategori' => 'Makanan',    'harga_min' => 2500,  'harga_max' => 4000],
        ['nama' => 'Indomie Kuah Ayam Bawang',  'kategori' => 'Makanan',    'harga_min' => 2500,  'harga_max' => 4000],
        ['nama' => 'Mie Sedaap Goreng',          'kategori' => 'Makanan',    'harga_min' => 2500,  'harga_max' => 4000],
        ['nama' => 'Beras Ramos 5kg',            'kategori' => 'Sembako',    'harga_min' => 55000, 'harga_max' => 65000],
        ['nama' => 'Beras Premium Pulen 10kg',   'kategori' => 'Sembako',    'harga_min' => 100000,'harga_max' => 130000],
        ['nama' => 'Gula Pasir 1kg',             'kategori' => 'Sembako',    'harga_min' => 14000, 'harga_max' => 17000],
        ['nama' => 'Gula Merah 500gr',           'kategori' => 'Sembako',    'harga_min' => 8000,  'harga_max' => 12000],
        ['nama' => 'Minyak Goreng Bimoli 2L',    'kategori' => 'Sembako',    'harga_min' => 28000, 'harga_max' => 35000],
        ['nama' => 'Minyak Goreng Tropical 1L',  'kategori' => 'Sembako',    'harga_min' => 16000, 'harga_max' => 20000],
        ['nama' => 'Sabun Mandi Lifebuoy',       'kategori' => 'Kebersihan', 'harga_min' => 4000,  'harga_max' => 7000],
        ['nama' => 'Sabun Cuci Piring Sunlight', 'kategori' => 'Kebersihan', 'harga_min' => 8000,  'harga_max' => 14000],
        ['nama' => 'Detergen Rinso 800gr',       'kategori' => 'Kebersihan', 'harga_min' => 18000, 'harga_max' => 25000],
        ['nama' => 'Teh Celup Sariwangi 25s',    'kategori' => 'Minuman',    'harga_min' => 7000,  'harga_max' => 10000],
        ['nama' => 'Teh Botol Sosro 250ml',      'kategori' => 'Minuman',    'harga_min' => 4000,  'harga_max' => 6000],
        ['nama' => 'Kopi Kapal Api Sachet',      'kategori' => 'Minuman',    'harga_min' => 1500,  'harga_max' => 2500],
        ['nama' => 'Kopi Nescafe Classic',       'kategori' => 'Minuman',    'harga_min' => 12000, 'harga_max' => 18000],
        ['nama' => 'Susu Ultra Milk Full Cream', 'kategori' => 'Minuman',    'harga_min' => 5000,  'harga_max' => 8000],
        ['nama' => 'Aqua 600ml',                 'kategori' => 'Minuman',    'harga_min' => 3000,  'harga_max' => 5000],
        ['nama' => 'Shampo Clear Men 170ml',     'kategori' => 'Perawatan',  'harga_min' => 18000, 'harga_max' => 25000],
        ['nama' => 'Shampo Pantene 170ml',       'kategori' => 'Perawatan',  'harga_min' => 18000, 'harga_max' => 25000],
        ['nama' => 'Pasta Gigi Pepsodent 190gr', 'kategori' => 'Perawatan',  'harga_min' => 12000, 'harga_max' => 16000],
        ['nama' => 'Sikat Gigi Formula',         'kategori' => 'Perawatan',  'harga_min' => 5000,  'harga_max' => 9000],
        ['nama' => 'Snack Chitato 68gr',         'kategori' => 'Snack',      'harga_min' => 8000,  'harga_max' => 12000],
        ['nama' => 'Biskuit Roma Marie',         'kategori' => 'Snack',      'harga_min' => 5000,  'harga_max' => 9000],
        ['nama' => 'Wafer Tango',                'kategori' => 'Snack',      'harga_min' => 4000,  'harga_max' => 7000],
        ['nama' => 'Permen Kopiko',              'kategori' => 'Snack',      'harga_min' => 2000,  'harga_max' => 4000],
        ['nama' => 'Telur Ayam 1kg',             'kategori' => 'Sembako',    'harga_min' => 25000, 'harga_max' => 32000],
        ['nama' => 'Tepung Terigu Segitiga Biru','kategori' => 'Sembako',    'harga_min' => 12000, 'harga_max' => 16000],
        ['nama' => 'Kecap Manis Bango 600ml',    'kategori' => 'Bumbu',      'harga_min' => 18000, 'harga_max' => 24000],
        ['nama' => 'Saos Sambal ABC 335ml',      'kategori' => 'Bumbu',      'harga_min' => 12000, 'harga_max' => 18000],
    ];

    private static int $index = 0;

    public function definition(): array
    {
        $i    = self::$index % count(self::$produkList);
        $item = self::$produkList[$i];
        self::$index++;

        $kode = 'PRD-' . str_pad(self::$index, 4, '0', STR_PAD_LEFT);

        return [
            'kode_produk' => $kode,
            'nama_produk' => $item['nama'],
            'kategori'    => $item['kategori'],
            'harga'       => $this->faker->numberBetween($item['harga_min'], $item['harga_max']),
            'stok'        => $this->faker->numberBetween(0, 200),
            'deskripsi'   => $this->faker->optional(0.7)->sentence(8),
            'status'      => $this->faker->randomElement(['aktif', 'aktif', 'aktif', 'nonaktif']),
        ];
    }
}
