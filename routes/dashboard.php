<?php

use App\Http\Controllers\dashBoard\CategoryController;
use App\Http\Controllers\DashBoardController;
use Illuminate\Support\Facades\Route;


Route::group([
'middleware'=>['auth'],//كل الروترات اللى تحت لازم تعدى على الميدل ده
'as'=>'dashboard.',//اى اسم راوت سوف يسبقه dashboard
'prefix'=>'dashboard'//هنا اى راوت نفسه اللى هو dashboard/category
///سيصبح dashboard/dashboard/category كمثال 
],function(){
    Route::resource('/category',CategoryController::class);

    Route::get('/', [DashBoardController::class,'index'])
    ->name('dashboard');
});