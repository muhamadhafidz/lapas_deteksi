<?php

// use App\Http\Controllers\ProfilYayasanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home.index');
Route::get('/donasi', 'HomeController@donasi')->name('home.donasi');
Route::get('/profil', 'HomeController@profil')->name('home.profil');
Route::get('/struktur', 'HomeController@struktur')->name('home.struktur');
Route::post('/uploadDonasi', 'HomeController@uploadDonasi')->name('home.uploadDonasi');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::put('/ubah-password/{id}', 'HomeController@update')->name('ubah-password');

Route::middleware(['isAdmin'])->group(function () {
    Route::put('profil-yayasan/upload-foto/{id}/{tipe}', 'ProfilYayasanController@uploadFoto')->name('profil-yayasan.uploadFoto');
    Route::resource('profil-yayasan', 'ProfilYayasanController')->names('profil-yayasan');
    Route::resource('donatur', DonaturController::class)->names('master-donatur');
    Route::resource('pengurus', PengurusController::class)->names('master-pengurus');
    Route::resource('anak-asuh', AnakAsuhController::class)->names('master-anak-asuh');
    Route::resource('pengguna', PenggunaController::class)->names('pengguna');
    Route::resource('data-donasi', DataDonasiController::class)->names('data-donasi');
    Route::resource('pemasukan', PemasukanController::class)->names('pemasukan');
    Route::resource('pengeluaran', PengeluaranController::class)->names('pengeluaran');
});

Route::middleware(['isUser'])->group(function () {
    Route::resource('data-donasi', DataDonasiController::class)->names('data-donasi');
    Route::resource('pemasukan', PemasukanController::class)->names('pemasukan');
    Route::resource('pengeluaran', PengeluaranController::class)->names('pengeluaran');
});


Route::get('/home', 'HomeController@index')->name('home');
