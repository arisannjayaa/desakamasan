<?php

use App\Http\Controllers\Beranda\BerandaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Berita\BeritaController;
use App\Http\Controllers\Profil\ProfilController;
use App\Http\Controllers\Daerah\DaerahController;
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

// Beranda
Route::get('/', [BerandaController::class, 'index']);

// berita
Route::resource('berita', BeritaController::class);
Route::post('berita/table', [BeritaController::class, 'datatable'])->name('berita.table');
// Profil
Route::resource('profil', ProfilController::class);

// Daerah
Route::resource('daerah', DaerahController::class);

// Filepond
Route::controller(UploadVideoController::class)->group(function () {
    Route::post('video/upload', 'store')->name('video.upload');
    Route::delete('video/delete', 'destroy')->name('video.delete');
});

Route::controller(UploadImageController::class)->group(function () {
    Route::post('image/upload', 'store')->name('image.upload');
    Route::delete('image/delete', 'destroy')->name('image.delete');
});
