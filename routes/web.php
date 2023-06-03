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
Route::get('/', [BerandaController::class, 'index'])->name('beranda.index');
Route::get('/berita', [BerandaController::class, 'berita'])->name('beranda.berita');
Route::get('/berita/{slug}', [BerandaController::class, 'details_berita'])->name('beranda.berita.details');
Route::get('/daerah-wisata', [BerandaController::class, 'daerah'])->name('beranda.daerah');
Route::get('/daerah-wisata/{slug}', [BerandaController::class, 'details_daerah'])->name('beranda.daerah.details');


// Filepond
Route::controller(UploadVideoController::class)->group(function () {
    Route::post('video/upload', 'store')->name('video.upload');
    Route::delete('video/delete', 'destroy')->name('video.delete');
});

Route::controller(UploadImageController::class)->group(function () {
    Route::post('image/upload', 'store')->name('image.upload');
    Route::delete('image/delete', 'destroy')->name('image.delete');
});

Route::prefix('user')->group(function () {
    // berita
    Route::resource('berita', BeritaController::class);
    Route::post('berita/table', [BeritaController::class, 'datatable'])->name('berita.table');

    // Daerah
    Route::resource('daerah', DaerahController::class);

    // Profil
    Route::resource('profil', ProfilController::class);
});
