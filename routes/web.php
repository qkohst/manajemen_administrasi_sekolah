<?php

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


Route::get('/login','AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');
Route::get('/logout','AuthController@logout');

Route::group(['middleware' => ['auth','checkRole:admin,petugas']], function () {

    Route::get('/', function () {
        return view('/dasboard');
    });

    Route::get('/dasboard','DashboardController@index');

    //Route Untuk Surat Masuk
    Route::get('/suratmasuk','SuratmasukController@index');
    Route::get('/suratmasuk/index','SuratmasukController@index');

    //Route Untuk Tambah Data Surat Masuk
    Route::get('/suratmasuk/create','SuratmasukController@create');
    Route::post('/suratmasuk/tambah','SuratmasukController@tambah');
    Route::get('/suratmasuk/{id}/tampil','SuratmasukController@tampil');

    // Route untuk download file Surat Masuk
    Route::get('viewAlldownloadfile','SuratmasukController@downfunc');

    //Route untuk edit Surat Masuk
    Route::get('/suratmasuk/{id}/edit','SuratmasukController@edit');
    Route::post('/suratmasuk/{id}/update','SuratmasukController@update');

    //Route untuk Hapus Surat Masuk
    Route::get('/suratmasuk/{id}/delete','SuratmasukController@delete');

    //Route untuk Agenda Surat Masuk
    Route::get('/suratmasuk/agenda','SuratmasukController@agenda');
    Route::get('/suratmasuk/agendamasukcetak_pdf', 'SuratmasukController@agendamasukcetak_pdf');

    //Route untuk Geleri Surat Masuk
    Route::get('/suratmasuk/galeri','SuratmasukController@galeri');

    // Route untuk Surat Keluar
    Route::get('/suratkeluar', 'SuratKeluarController@index');
    Route::get('/suratkeluar/index','SuratKeluarController@index');

    //Route Untuk Tambah Data Surat Keluar
    Route::get('/suratkeluar/create','SuratKeluarController@create');
    Route::post('/suratkeluar/tambah','SuratKeluarController@tambah');
    Route::get('/suratkeluar/{id}/tampil','SuratKeluarController@tampil');

    // Route untuk download file Surat Keluar
    Route::get('viewAlldownloadfile','SuratKeluarController@downfunc');

    //Route untuk edit Surat Keluar
    Route::get('/suratkeluar/{id}/edit','SuratKeluarController@edit');
    Route::post('/suratkeluar/{id}/update','SuratKeluarController@update');

    //Route untuk Hapus Surat Keluar
    Route::get('/suratkeluar/{id}/delete','SuratKeluarController@delete');

    //Route untuk Agenda Surat Keluar
    Route::get('/suratkeluar/agenda','SuratKeluarController@agenda');
    Route::get('/suratkeluar/agendakeluarcetak_pdf', 'SuratKeluarController@agendakeluarcetak_pdf');

    //Route untuk Geleri Surat Keluar
    Route::get('/suratkeluar/galeri','SuratKeluarController@galeri');

    // Route untuk Klasifikasi
    Route::get('/klasifikasi', 'KlasifikasiController@index');
    Route::get('/klasifikasi/index','KlasifikasiController@index');

    //Route Untuk Tambah Data Klasifikasi
    Route::get('/klasifikasi/create','KlasifikasiController@create');
    Route::post('/klasifikasi/tambah','KlasifikasiController@tambah');

    //Route untuk edit Klasifikasi
    Route::get('/klasifikasi/{id}/edit','KlasifikasiController@edit');
    Route::post('/klasifikasi/{id}/update','KlasifikasiController@update');

    //Route untuk Hapus Surat Keluar
    Route::get('/klasifikasi/{id}/delete','KlasifikasiController@delete');

    //Route untuk Modal Import Data
    // Route::post('/klasifikasi/import','KlasifikasiController@importexcel')->name('klasifikasi.import');
    Route::post('/klasifikasi.import', 'KlasifikasiController@import');

});

Route::group(['middleware' => ['auth','checkRole:admin']], function () {

    //Route Untuk Pengguna
    Route::get('/pengguna','PenggunaController@index');
    Route::get('/pengguna/index','PenggunaController@index');

    //Route Untuk Tambah Data Pengguna
    Route::get('/pengguna/create','PenggunaController@create');
    Route::post('/pengguna/tambah','PenggunaController@tambah');

    //Route untuk Edit Data Pengguna
    Route::get('/pengguna/{id}/edit','PenggunaController@edit');
    Route::post('/pengguna/{id}/update','PenggunaController@update');

    //Route untuk Hapus Data Pengguna
    Route::get('/pengguna/{id}/delete','PenggunaController@delete');

});
