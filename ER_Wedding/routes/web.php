<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\WeddingBookingController; // ← tambahkan controller WeddingBookingController

use App\Http\Controllers\ProductController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/', [LandingPageController::class, 'index'])->name('landingPage');
Route::post('/add-to-wishlist', [LandingPageController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/wishlist', [LandingPageController::class, 'showWishlist'])->name('wishlist.index');


// Route::get('/search', [LandingPageController::class, 'searchPage'])->name('search.page');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('admin.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.destroy');
});

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::view('/bantuan', 'help')->name('help');

Route::middleware(['auth', 'role:buyer'])->group(function () {
    Route::post('/products/{product}/comments', [CommentController::class, 'store']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comment.update');
// Rute untuk Wedding Booking
Route::get('/wedding/bookings', [WeddingBookingController::class, 'index'])->name('wedding.index');
Route::get('/wedding/bookings/create', [WeddingBookingController::class, 'create'])->name('wedding.create'); // Form untuk membuat booking
Route::post('/wedding/bookings', [WeddingBookingController::class, 'store'])->name('wedding.store'); // Menyimpan booking baru
Route::get('/wedding/bookings/edit/{id}', [WeddingBookingController::class, 'edit'])->name('wedding.edit'); // Form untuk mengedit booking
Route::put('/wedding/bookings/update/{id}', [WeddingBookingController::class, 'update'])->name('wedding.update');  // Mengupdate booking
Route::get('/wedding/bookings/destroy/{id}', [WeddingBookingController::class, 'destroy'])->name('wedding.destroy'); // Menghapus booking

});




