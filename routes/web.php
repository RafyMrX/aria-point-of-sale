<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/',[AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login',[AuthController::class, 'postlogin'])->middleware('guest');

Route::get('/logout',[AuthController::class, 'logout'])->middleware('auth');


Route::middleware(['auth'])->group(function () {
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
Route::get('/exportsales/{id}',[PagesController::class, 'salespdf'])->name('salespdf');
// retur penjualan
Route::get('/sales-retur',[PagesController::class, 'retursales'])->name('retur.sales');

Route::get('/exportsalesretur/{id}',[PagesController::class, 'returpdf']);

Route::get('/sales/reports',[PagesController::class, 'reportSales'])->name('sales.report');
// transaksi pembelian 
// retur pembelian

});


