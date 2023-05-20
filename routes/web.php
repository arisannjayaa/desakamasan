<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Berita\BeritaController;
use App\Http\Controllers\Profil\ProfilController;
use App\Http\Controllers\Upload\UploadVideoController;
use App\Http\Controllers\Upload\UploadImageController;

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
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('layouts.admin');
});

// berita
Route::resource('berita', BeritaController::class);
Route::get('/berita/table',[BeritaController::class, 'table'])->name('berita.table');

Route::resource('profil', ProfilController::class);

// Filepond
Route::controller(UploadVideoController::class)->group(function () {
    Route::post('video/upload', 'store')->name('video.upload');
    Route::delete('video/delete', 'destroy')->name('video.delete');
});

Route::controller(UploadImageController::class)->group(function () {
    Route::post('image/upload', 'store')->name('image.upload');
    Route::delete('image/delete', 'destroy')->name('image.delete');
});
