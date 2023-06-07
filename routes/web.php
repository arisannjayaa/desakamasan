<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profil\ProfilController;
use App\Http\Controllers\Beranda\BerandaController;
use App\Http\Controllers\Beranda\BeritaController;
use App\Http\Controllers\Beranda\SearchController;
use App\Http\Controllers\Berita\PostBeritaController;
use App\Http\Controllers\Daerah\PostDaerahController;
use App\Http\Controllers\Produk\PostProdukController;
use App\Http\Controllers\Produk\KategoriProdukController;
use App\Http\Controllers\Upload\UploadImageController;
use App\Http\Controllers\Upload\UploadVideoController;
use App\Http\Controllers\Berita\KategoriBeritaController;
use App\Http\Controllers\Daerah\KategoriDaerahController;

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
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/daerah-wisata', [BerandaController::class, 'daerah'])->name('beranda.daerah');
Route::get('/daerah-wisata/{slug}', [BerandaController::class, 'details_daerah'])->name('beranda.daerah.details');
Route::get('/login-admin', [LoginController::class, 'login'])->name('auth.login');
Route::post('/search', [SearchController::class, 'search'])->name('search');


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
    // berita-post
    Route::resource('berita-post', PostBeritaController::class);
    // berita-kategori
    Route::resource('berita-kategori', KategoriBeritaController::class);
    // Daerah
    Route::resource('daerah-post', PostDaerahController::class);
    // daerah-kategori
    Route::resource('daerah-kategori', KategoriDaerahController::class);
    // produk
    Route::resource('produk-post', PostProdukController::class);
    // produk-kategori
    Route::resource('produk-kategori', KategoriProdukController::class);
    // Profil
    Route::resource('profil-desa', ProfilController::class);
    // pemerintah
    Route::resource('perangkat-desa', PemerintahanController::class);
});
