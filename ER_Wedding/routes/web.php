<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegistController;
use App\Http\Controllers\UpdateProductController;
use App\Http\Controllers\WeddingBookingController; // ← tambahkan controller WeddingBookingController

// Rute untuk Produk
Route::get('/product', [ProductController::class, 'index'])->name('products.index');
Route::match(['get', 'post'], '/login', [LoginController::class, 'index'])->name('login');

// Landing page
Route::get('/', function () {
    return view('landing');
});

// Tampilkan halaman register
Route::get('/regist', [RegistController::class, 'index'])->name('regist');

// Proses data dari form register
Route::post('/regist', [RegistController::class, 'store'])->name('regist.store');
Route::post('/productstore', [ProductController::class, 'store'])->name('products.store');
Route::get('/product/edit/{id_product}', [ProductController::class, 'edit'])->name('products.edit');
Route::post('/product/update/{id_product}', [UpdateProductController::class, 'update'])->name('products.update');
Route::get('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Rute untuk Wedding Booking
Route::get('/wedding/bookings', [WeddingBookingController::class, 'index'])->name('wedding.index');
Route::get('/wedding/bookings/create', [WeddingBookingController::class, 'create'])->name('wedding.create'); // Form untuk membuat booking
Route::post('/wedding/bookings', [WeddingBookingController::class, 'store'])->name('wedding.store'); // Menyimpan booking baru
Route::get('/wedding/bookings/edit/{id}', [WeddingBookingController::class, 'edit'])->name('wedding.edit'); // Form untuk mengedit booking
Route::put('/wedding/bookings/update/{id}', [WeddingBookingController::class, 'update'])->name('wedding.update');  // Mengupdate booking
Route::get('/wedding/bookings/destroy/{id}', [WeddingBookingController::class, 'destroy'])->name('wedding.destroy'); // Menghapus booking

