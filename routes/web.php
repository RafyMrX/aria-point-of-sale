<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
// data supplier
Route::get('/suppliers',[PagesController::class, 'suppliers'])->name('suppliers');
// data outlet
Route::get('/retails',[PagesController::class, 'retails'])->name('retails');
// data kategori
Route::get('/categories',[PagesController::class, 'categories'])->name('categories');
// data kategori
Route::get('/products',[PagesController::class, 'products'])->name('products');
// transaksi penjualan
Route::get('/sales',[PagesController::class, 'sales'])->name('sales');
// transaksi penjualan

