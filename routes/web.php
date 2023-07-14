<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Profil\ProfilController;
use App\Http\Controllers\Beranda\BeritaController;
use App\Http\Controllers\Beranda\DaerahController;
use App\Http\Controllers\Beranda\ProdukController;
use App\Http\Controllers\Beranda\SearchController;
use App\Http\Controllers\Beranda\BerandaController;
use App\Http\Controllers\Berita\PostBeritaController;
use App\Http\Controllers\Daerah\PostDaerahController;
use App\Http\Controllers\Produk\PostProdukController;
use App\Http\Controllers\Upload\UploadImageController;
use App\Http\Controllers\Upload\UploadVideoController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Berita\KategoriBeritaController;
use App\Http\Controllers\Daerah\KategoriDaerahController;
use App\Http\Controllers\Produk\KategoriProdukController;
use App\Http\Controllers\Pemerintah\PostPemerintahController;
use App\Http\Controllers\Pemerintah\PostRiwayatKerjaController;
use App\Http\Controllers\Pemerintah\PostRiwayatPendidikanController;

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
Route::get('/berita/tags/{slug}', [BeritaController::class, 'tags'])->name('berita.tags');
Route::get('/daerah', [DaerahController::class, 'index'])->name('daerah.index');
Route::get('/daerah/{slug}', [DaerahController::class, 'show'])->name('daerah.show');
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{slug}', [ProdukController::class, 'show'])->name('produk.show');
Route::post('/search', [SearchController::class, 'search'])->name('search');

// auth
Route::get('/login', [LoginController::class, 'login'])->name('auth.login')->middleware('guest');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('auth.authenticate')->middleware('guest');
Route::get('/logout', [LogoutController::class, 'logout'])->name('auth.logout')->middleware('auth');

// Filepond
Route::controller(UploadVideoController::class)->group(function () {
    Route::post('video/upload', 'store')->name('video.upload');
    Route::delete('video/delete', 'destroy')->name('video.delete');
});

Route::controller(UploadImageController::class)->group(function () {
    Route::post('image/upload', 'store')->name('image.upload');
    Route::delete('image/delete', 'destroy')->name('image.delete');
});

// Route::controller('/login', [LoginController::class, 'login'])->name('login');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
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
    // Route::resource('profil-desa', ProfilController::class);
    Route::get('beranda-profil', [ProfilController::class, 'page'])->name('profil-desa.page');
    Route::get('profil-desa', [ProfilController::class, 'index'])->name('profil-desa.index');
    Route::put('profil-desa/{id}', [ProfilController::class, 'update'])->name('profil-desa.update');
    // pemerintah
    Route::resource('perangkat-desa', PostPemerintahController::class);
    Route::delete('riwayatkerja/delete/{id}', [PostRiwayatKerjaController::class, 'destroy']);
    Route::delete('riwayatpendidikan/delete/{id}', [PostRiwayatPendidikanController::class, 'destroy']);
});


