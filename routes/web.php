<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index'); // Xem giỏ hàng
    Route::post('/add/{book}', [CartController::class, 'add'])->name('cart.add'); // Thêm sách vào giỏ hàng
    Route::post('/update/{book}', [CartController::class, 'update'])->name('cart.update'); // Cập nhật số lượng sách
    Route::post('/remove/{book}', [CartController::class, 'remove'])->name('cart.remove'); // Xóa sách khỏi giỏ hàng
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear'); // Xóa toàn bộ giỏ hàng
});

// Trang chủ hiển thị danh sách sách
Route::get('/', [BookController::class, 'index'])->name('home');

// Xác thực người dùng (Laravel Authentication)
Auth::routes();

// Trang Dashboard (chỉ hiển thị sau khi đăng nhập)
Route::get('/dashboard', [HomeController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Định tuyến quản lý sách (chỉ admin mới có quyền thêm, sửa, xóa)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('books', BookController::class)->except(['index', 'show']);
});

// Định tuyến xem sách (mọi người đều có thể xem)
Route::resource('books', BookController::class)->only(['index', 'show']);

// Định tuyến thanh toán (chỉ cho người dùng đã đăng nhập)
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
});
