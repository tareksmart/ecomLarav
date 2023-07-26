<?php

use App\Http\Controllers\dashBoard\CategoryController;
use Illuminate\Support\Facades\Route;
Route::resource('dashboard/category',CategoryController::class);
Route::get('dashboard', [DashBoardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');