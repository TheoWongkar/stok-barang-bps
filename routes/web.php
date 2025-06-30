<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/pegawai', [EmployeeController::class, 'index'])->name('dashboard.employee.index');
    Route::get('/dashboard/pegawai/tambah', [EmployeeController::class, 'create'])->name('dashboard.employee.create');
    Route::post('/dashboard/pegawai/tambah', [EmployeeController::class, 'store'])->name('dashboard.employee.store');
    Route::get('/dashboard/pegawai/{id}/ubah', [EmployeeController::class, 'edit'])->name('dashboard.employee.edit');
    Route::put('/dashboard/pegawai/{id}/ubah', [EmployeeController::class, 'update'])->name('dashboard.employee.update');
    Route::delete('/dashboard/pegawai/{id}/hapus', [EmployeeController::class, 'destroy'])->name('dashboard.employee.destroy');
});
