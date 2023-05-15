<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Berita\BeritaController;
use App\Http\Controllers\Profil\ProfilController;

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

Route::resource('berita', BeritaController::class);
Route::resource('profil', ProfilController::class);
