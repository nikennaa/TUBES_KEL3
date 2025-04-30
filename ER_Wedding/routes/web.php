<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController; // ← tambahkan ini di atas (kalau belum)
use App\Http\Controllers\RegistController;
use App\Http\Controllers\UpdateProductController;

Route::get('/product', [ProductController::class, 'index'])->name('products.index');
Route::match(['get', 'post'], '/login', [LoginController::class, 'index'])->name('login');


// Tampilkan halaman register
Route::get('/regist', [RegistController::class, 'index'])->name('regist');

// Proses data dari form register
Route::post('/regist', [RegistController::class, 'store'])->name('regist.store');
Route::post('/productstore', [ProductController::class, 'store'])->name('products.store');
Route::get('/product/edit/{id_product}', [ProductController::class, 'edit'])->name('products.edit');
Route::post('/product/update/{id_product}', [UpdateProductController::class, 'update'])->name('products.update');
Route::get('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
