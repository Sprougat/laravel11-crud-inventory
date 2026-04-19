<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama agar tidak duplikat
        Product::truncate();

        // Buat 30 produk dummy
        Product::factory()->count(30)->create();
    }
}
