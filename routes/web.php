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

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/peta-kerawanan', 'PetaKerawananController@index')->name('admin.peta-kerawanan.index');

    Route::get('/laporan-deteksi-dini', 'LaporanDeteksiController@index')->name('admin.laporan-deteksi.index');

    Route::get('/master-instrument', 'MasterInstrumentController@index')->name('admin.master-instrument.index');
    Route::post('/master-instrument', 'MasterInstrumentController@store')->name('admin.master-instrument.store');
    Route::put('/master-instrument/{id}/update', 'MasterInstrumentController@update')->name('admin.master-instrument.update');
    Route::delete('/master-instrument/{id}/delete', 'MasterInstrumentController@delete')->name('admin.master-instrument.delete');

    Route::get('/data-user', 'UserController@index')->name('admin.data-user.index');
    Route::post('/data-user', 'UserController@store')->name('admin.data-user.store');
    Route::put('/data-user/{id}/update', 'UserController@update')->name('admin.data-user.update');
    Route::delete('/data-user/{id}/delete', 'UserController@destroy')->name('admin.data-user.delete');

    Route::get('/data-upt', 'UptController@index')->name('admin.data-upt.index');
    Route::post('/data-upt', 'UptController@store')->name('admin.data-upt.store');
    Route::put('/data-upt/{id}/update', 'UptController@update')->name('admin.data-upt.update');
    Route::delete('/data-upt/{id}/delete', 'UptController@destroy')->name('admin.data-upt.delete');
});

Route::middleware(['auth', 'isUser'])->group(function () {
    Route::get('/laporan-deteksi-dini-user', 'UserLaporanController@index')->name('user.laporan-user.index');
    Route::get('/laporan-deteksi-dini-user/{id}', 'UserLaporanController@export')->name('user.laporan-user.export');
    
    Route::get('/ganti-password', 'GantiPasswordController@index')->name('user.ganti-password.index');
    Route::post('/ganti-password', 'GantiPasswordController@store')->name('user.ganti-password.store');

    Route::get('/input-deteksi-dini', 'InputDeteksiDiniController@index')->name('user.input-deteksi-dini.index');
    Route::get('/input-deteksi-dini/create', 'InputDeteksiDiniController@create')->name('user.input-deteksi-dini.create');
    Route::post('/input-deteksi-dini', 'InputDeteksiDiniController@store')->name('user.input-deteksi-dini.store');
    Route::get('/input-deteksi-dini/{id}', 'InputDeteksiDiniController@detail')->name('user.input-deteksi-dini.detail');
    Route::get('/input-deteksi-dini/{id}/print', 'InputDeteksiDiniController@detailPrint')->name('user.input-deteksi-dini.detail-print');
    Route::get('/input-deteksi-dini/{id}/edit', 'InputDeteksiDiniController@edit')->name('user.input-deteksi-dini.edit');
    Route::put('/input-deteksi-dini/{id}/update', 'InputDeteksiDiniController@update')->name('user.input-deteksi-dini.update');
    Route::delete('/input-deteksi-dini/{id}/delete', 'InputDeteksiDiniController@delete')->name('user.input-deteksi-dini.delete');
});

