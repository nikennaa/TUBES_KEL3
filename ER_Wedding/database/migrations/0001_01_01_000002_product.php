<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_product'); // primary key custom id_product
            $table->string('nama_produk');
            $table->text('detail')->nullable(); // detail bisa panjang, dan nullable
            $table->decimal('price', 10, 2); // harga, maksimal 10 digit, 2 angka dibelakang koma
            $table->string('image')->nullable(); // simpan nama file / path gambar
            $table->timestamps(); // created_at & updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
