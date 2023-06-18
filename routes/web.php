<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
// data supplier
Route::get('/suppliers',[PagesController::class, 'suppliers'])->name('suppliers');
// data outlet
Route::get('/retails',[PagesController::class, 'retails'])->name('data.supplier');