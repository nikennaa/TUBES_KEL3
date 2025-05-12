<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel products.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Kursi Pelaminan Elegan',
                'description' => 'Kursi pelaminan dengan desain elegan dan nyaman untuk acara pernikahan Anda.',
                'price' => 1500000,
                'image' => 'kursi_pelaminan_elegan.jpg',
            ],
            [
                'name' => 'Dekorasi Bunga Premium',
                'description' => 'Dekorasi bunga segar dengan kombinasi warna yang menawan.',
                'price' => 2000000,
                'image' => 'dekorasi_bunga_premium.jpg',
            ],
            [
                'name' => 'Paket Sound System',
                'description' => 'Paket sound system lengkap untuk acara indoor dan outdoor.',
                'price' => 2500000,
                'image' => 'paket_sound_system.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
