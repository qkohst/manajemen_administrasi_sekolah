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
        return view('/dashboard');
    });

    Route::get('/dashboard','DashboardController@index');

    Route::get('/suratmasuk','SuratMasukController@index');
    Route::get('/suratmasuk/index','SuratMasukController@index');
    Route::get('/suratmasuk/create','SuratMasukController@create');
    Route::post('/suratmasuk/tambah','SuratMasukController@tambah');
    Route::get('/suratmasuk/{id}/tampil','SuratMasukController@tampil');
    Route::get('viewAlldownloadfile','SuratMasukController@downfunc');
    Route::get('/suratmasuk/{id}/edit','SuratMasukController@edit');
    Route::post('/suratmasuk/{id}/update','SuratMasukController@update');
    Route::get('/suratmasuk/{id}/delete','SuratMasukController@delete');
    Route::get('/suratmasuk/agenda','SuratMasukController@agenda');
    Route::get('/suratmasuk/agendamasukcetak_pdf', 'SuratMasukController@agendamasukcetak_pdf');
    Route::get('/suratmasuk.agendamasukdownload_excel', 'SuratMasukController@agendamasukdownload_excel')->name('suratmasuk.downloadexcel');
    Route::get('/suratmasuk/galeri','SuratMasukController@galeri');

    Route::get('/suratkeluar', 'SuratKeluarController@index');
    Route::get('/suratkeluar/index','SuratKeluarController@index');
    Route::get('/suratkeluar/create','SuratKeluarController@create');
    Route::post('/suratkeluar/tambah','SuratKeluarController@tambah');
    Route::get('/suratkeluar/{id}/tampil','SuratKeluarController@tampil');
    Route::get('viewAlldownloadfile','SuratKeluarController@downfunc');
    Route::get('/suratkeluar/{id}/edit','SuratKeluarController@edit');
    Route::post('/suratkeluar/{id}/update','SuratKeluarController@update');
    Route::get('/suratkeluar/{id}/delete','SuratKeluarController@delete');
    Route::get('/suratkeluar/agenda','SuratKeluarController@agenda');
    Route::get('/suratkeluar/agendakeluarcetak_pdf','SuratKeluarController@agendakeluarcetak_pdf');
    Route::get('/suratkeluar.agendakeluardownload_excel','SuratKeluarController@agendakeluardownload_excel')->name('suratkeluar.downloadexcel');
    Route::get('/suratkeluar/galeri','SuratKeluarController@galeri');


    Route::get('/klasifikasi', 'KlasifikasiController@index');
    Route::get('/klasifikasi/index','KlasifikasiController@index');
    Route::get('/klasifikasi/create','KlasifikasiController@create');
    Route::post('/klasifikasi/tambah','KlasifikasiController@tambah');
    Route::get('/klasifikasi/{id}/edit','KlasifikasiController@edit');
    Route::post('/klasifikasi/{id}/update','KlasifikasiController@update');
    Route::get('/klasifikasi/{id}/delete','KlasifikasiController@delete');

    Route::post('/klasifikasi.import', 'KlasifikasiController@import');

    Route::get('disposisi/{suratmasuk}', 'DisposisiController@index')->name('disposisi.index');
    Route::post('disposisi/{suratmasuk}', 'DisposisiController@store')->name('disposisi.store');
    Route::get('disposisi/{suratmasuk}/create', 'DisposisiController@create')->name('disposisi.create');
    Route::get('disposisi/{suratmasuk}/{id}/edit', 'DisposisiController@edit')->name('disposisi.edit');
    Route::get('disposisi/{suratmasuk}/{id}', 'DisposisiController@update')->name('disposisi.update');
    Route::delete('disposisi/{suratmasuk}/{id}', 'DisposisiController@destroy')->name('disposisi.destroy');
    Route::get('/disposisi/{suratmasuk}/{id}/download', 'DisposisiController@download')->name('disposisi.download');

    Route::get('/guru/index','GuruController@index');
    Route::post('/guru/tambah','GuruController@tambah');
    Route::get('/guru/{id}/edit','GuruController@edit');
    Route::post('/guru/{id}/update','GuruController@update');
    Route::get('/guru/{id}/delete','GuruController@delete');

    Route::get('/tendik/index','TendikController@index');
    Route::post('/tendik/tambah','TendikController@tambah');
    Route::get('/tendik/{id}/edit','TendikController@edit');
    Route::post('/tendik/{id}/update','TendikController@update');
    Route::get('/tendik/{id}/delete','TendikController@delete');

    Route::get('/rombel/index','RombelController@index');
    Route::post('/rombel/tambah','RombelController@tambah');
    Route::get('/rombel/{id}/anggota','RombelController@anggota');
    Route::get('/rombel/{id}/edit','RombelController@edit');
    Route::post('/rombel/{id}/update','RombelController@update');
    Route::get('/rombel/{id}/delete','RombelController@delete');

    Route::get('/tapel/index','TapelController@index');
    Route::post('/tapel/tambah','TapelController@tambah');
    Route::get('/tapel/{id}/edit','TapelController@edit');
    Route::post('/tapel/{id}/update','TapelController@update');
    Route::get('/tapel/{id}/delete','TapelController@delete');

    Route::get('/pesdik/index','PesdikController@index');
    Route::get('/pesdik/create','PesdikController@create');
    Route::post('/pesdik/tambah','PesdikController@tambah');
    Route::get('/pesdik/{id}/edit','PesdikController@edit');
    Route::post('/pesdik/{id}/update','PesdikController@update');
    Route::get('/pesdik/{id}/delete','PesdikController@delete');

    Route::get('/pesdik/{id}/registrasi','PesdikController@registrasi');
    Route::post('/pesdik/{id}/keluar','PesdikController@keluar');
    Route::get('/pesdik/keluarindex','PesdikController@keluarindex');
    Route::post('/pesdik/{id}/alumni','PesdikController@alumni');
    Route::get('/pesdik/alumniindex','PesdikController@alumniindex');

    Route::get('/pengumuman/index','PengumumanController@index');
    Route::post('/pengumuman/tambah','PengumumanController@tambah');
    Route::get('/pengumuman/{id}/edit','PengumumanController@edit');
    Route::post('/pengumuman/{id}/update','PengumumanController@update');
    Route::get('/pengumuman/{id}/delete','PengumumanController@delete');

    Route::get('/keuangan/pemasukan/index','PemasukanController@index');
    Route::post('/keuangan/pemasukan/tambah','PemasukanController@tambah');
    Route::get('/keuangan/pemasukan/{id}/edit','PemasukanController@edit');
    Route::post('/keuangan/pemasukan/{id}/update','PemasukanController@update');
    Route::get('/keuangan/pemasukan/{id}/delete','PemasukanController@delete');
    
    Route::post('/keuangan/pemasukan/tambahkategori','PemasukanController@tambahkategori');
    Route::get('/keuangan/pemasukan/{id}/deletekategori','PemasukanController@deletekategori');

});

Route::group(['middleware' => ['auth','checkRole:admin']], function () {
    Route::resource('/instansi','InstansiController');
    Route::resource('/pengguna','PenggunaController');
});
