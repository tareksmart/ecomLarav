<?php

use App\Http\Controllers\crud;
use App\Http\Controllers\db;
use App\Http\Controllers\get;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});
// Route::get('users', [get::class,'get']);
// Route::get('users/post',[get::class,'post']);
// Route::get('users/edit',[get::class,'edit']);

Route::controller(get::class)->group(function(){
    Route::get('users', 'get');
    Route::get('users/post','post');
    Route::get('users/edit/{id}','edit');
});
Route::controller(db::class)->group(function(){
Route::get('db/create','create');
Route::get('db/edite','edite');
});
Route::resource('emp',crud::class)->only('create');

Route::controller(PostsController::class)->group(function (){
    Route::get('posts/create','create')->name('create');
    Route::post('posts/insert','insert')->name('post.insert');
    Route::get('posts/allPosts','getData')->name('data');

    Route::get('posts/edit/{id}','edite')->name('posts.edite');
    Route::put('posts/ed/{id}','ed')->name('ed');
    Route::get('posts/delete/{id}','delete')->name('del');
});

