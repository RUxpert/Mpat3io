<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VillaController;

// --- Public ---
Route::get('/', [IndexController::class, 'lp1'])->name('home');
Route::get('/index/lp1', [IndexController::class, 'lp1'])->name('index.lp1');
Route::get('/index/lp2', [IndexController::class, 'lp2'])->name('index.lp2');
Route::get('/index/landing_page', [IndexController::class, 'landing_page'])->name('index.landing_page');

// --- Auth ---
Route::get('/index/masuk', [AuthController::class, 'loginForm'])->name('login');
Route::post('/index/masuk', [AuthController::class, 'login'])->name('login.post');
Route::get('/index/daftar', [AuthController::class, 'registerForm'])->name('register');
Route::post('/index/daftar', [AuthController::class, 'register'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/index/lupa_password', fn() => view('user.login.lupa_password'))->name('lupa_password');

// --- Authenticated ---
Route::middleware(['auth'])->group(function () {

    // Penyewa (tenant) routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard/index', [UserController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/akun', [UserController::class, 'akun'])->name('akun');
        Route::get('/dashboard/detail_akun', [UserController::class, 'detail_akun'])->name('detail_akun');
        Route::post('/dashboard/update_profil', [UserController::class, 'updateProfil'])->name('update_profil');
        Route::get('/dashboard/riwayat', [UserController::class, 'riwayat'])->name('riwayat');
        Route::get('/dashboard/pesanan/{order}', [UserController::class, 'detailPesanan'])->name('detail_pesanan');
        Route::post('/dashboard/batalkan', [UserController::class, 'batalkanPesanan'])->name('batalkan');
        Route::get('/dashboard/finish/{order}', [UserController::class, 'finishPayment'])->name('finish');
        Route::get('/dashboard/faq', [UserController::class, 'faq'])->name('faq');
        Route::get('/dashboard/sk', [UserController::class, 'sk'])->name('sk');
        Route::get('/dashboard/contact', [UserController::class, 'contact'])->name('contact');
        Route::get('/dashboard/kebijakan', [UserController::class, 'kebijakan'])->name('kebijakan');

        // Midtrans Snap token endpoint
        Route::post('/snap-token', [VillaController::class, 'snapToken'])->name('snap_token');
    });

    // Mitra (host/admin) routes
    Route::prefix('admin')->name('admin.')->middleware('role:mitra,admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/tambah', [AdminController::class, 'tambah'])->name('tambah');
        Route::post('/dashboard/simpan', [AdminController::class, 'simpanVilla'])->name('simpan');
        Route::get('/dashboard/edit/{villa}', [AdminController::class, 'edit'])->name('edit');
        Route::post('/dashboard/update/{villa}', [AdminController::class, 'updateVilla'])->name('update_villa');
        Route::get('/dashboard/delete/{villa}', [AdminController::class, 'deleteVilla'])->name('delete_villa');
        Route::get('/dashboard/pesanan', [AdminController::class, 'pesanan'])->name('pesanan');
        Route::post('/dashboard/update_order', [AdminController::class, 'updateOrder'])->name('update_order');
        Route::get('/dashboard/akun', [AdminController::class, 'akun'])->name('akun');
        Route::post('/dashboard/update_profil', [AdminController::class, 'updateProfil'])->name('update_profil');
    });

    // Villa routes (accessible by authenticated users)
    Route::prefix('villa')->name('villa.')->group(function () {
        Route::get('/detail/{villa}', [VillaController::class, 'detail'])->name('detail');
        Route::get('/pesan/{villa}', [VillaController::class, 'pesan'])->name('pesan');
        Route::post('/proses_bayar', [VillaController::class, 'prosesBayar'])->name('proses_bayar');
    });
});
