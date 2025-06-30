<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\ItemController;
use App\Http\Controllers\Dashboard\StockInController;
use App\Http\Controllers\Dashboard\StockOutController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Data Pegawai
    Route::get('/dashboard/pegawai', [EmployeeController::class, 'index'])->name('dashboard.employee.index');
    Route::get('/dashboard/pegawai/tambah', [EmployeeController::class, 'create'])->name('dashboard.employee.create');
    Route::post('/dashboard/pegawai/tambah', [EmployeeController::class, 'store'])->name('dashboard.employee.store');
    Route::get('/dashboard/pegawai/{id}/ubah', [EmployeeController::class, 'edit'])->name('dashboard.employee.edit');
    Route::put('/dashboard/pegawai/{id}/ubah', [EmployeeController::class, 'update'])->name('dashboard.employee.update');
    Route::delete('/dashboard/pegawai/{id}/hapus', [EmployeeController::class, 'destroy'])->name('dashboard.employee.destroy');

    // Data Barang
    Route::get('/dashboard/data-barang', [ItemController::class, 'index'])->name('dashboard.item.index');
    Route::get('/dashboard/data-barang/tambah', [ItemController::class, 'create'])->name('dashboard.item.create');
    Route::post('/dashboard/data-barang/tambah', [ItemController::class, 'store'])->name('dashboard.item.store');
    Route::get('/dashboard/data-barang/{id}/ubah', [ItemController::class, 'edit'])->name('dashboard.item.edit');
    Route::put('/dashboard/data-barang/{id}/ubah', [ItemController::class, 'update'])->name('dashboard.item.update');
    Route::delete('/dashboard/data-barang/{id}/hapus', [ItemController::class, 'destroy'])->name('dashboard.item.destroy');

    // Data Barang Masuk
    Route::get('/dashboard/barang-masuk', [StockInController::class, 'index'])->name('dashboard.stockin.index');
    Route::get('/dashboard/barang-masuk/tambah', [StockInController::class, 'create'])->name('dashboard.stockin.create');
    Route::post('/dashboard/barang-masuk/tambah', [StockInController::class, 'store'])->name('dashboard.stockin.store');
    Route::get('/dashboard/barang-masuk/{id}/ubah', [StockInController::class, 'edit'])->name('dashboard.stockin.edit');
    Route::put('/dashboard/barang-masuk/{id}/ubah', [StockInController::class, 'update'])->name('dashboard.stockin.update');
    Route::delete('/dashboard/barang-masuk/{id}/hapus', [StockInController::class, 'destroy'])->name('dashboard.stockin.destroy');

    // Data Barang Keluar
    Route::get('/dashboard/barang-keluar', [StockOutController::class, 'index'])->name('dashboard.stockout.index');
    Route::get('/dashboard/barang-keluar/tambah', [StockOutController::class, 'create'])->name('dashboard.stockout.create');
    Route::post('/dashboard/barang-keluar/tambah', [StockOutController::class, 'store'])->name('dashboard.stockout.store');
    Route::get('/dashboard/barang-keluar/{id}/ubah', [StockOutController::class, 'edit'])->name('dashboard.stockout.edit');
    Route::put('/dashboard/barang-keluar/{id}/ubah', [StockOutController::class, 'update'])->name('dashboard.stockout.update');
    Route::delete('/dashboard/barang-keluar/{id}/hapus', [StockOutController::class, 'destroy'])->name('dashboard.stockout.destroy');
});
