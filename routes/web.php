<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
// data supplier
Route::get('/data-supplier',[SupplierController::class, 'index'])->name('data.supplier');
// data outlet