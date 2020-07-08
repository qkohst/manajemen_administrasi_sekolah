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


Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

//Route untuk user Admin
Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {

    Route::get('/guru/index', 'GuruController@index');
    Route::post('/guru/tambah', 'GuruController@tambah');
    Route::get('/guru/{id}/edit', 'GuruController@edit');
    Route::post('/guru/{id}/update', 'GuruController@update');
    Route::get('/guru/{id}/delete', 'GuruController@delete');

    Route::get('/tendik/index', 'TendikController@index');
    Route::post('/tendik/tambah', 'TendikController@tambah');
    Route::get('/tendik/{id}/edit', 'TendikController@edit');
    Route::post('/tendik/{id}/update', 'TendikController@update');
    Route::get('/tendik/{id}/delete', 'TendikController@delete');

    Route::get('/rombel/index', 'RombelController@index');
    Route::post('/rombel/tambah', 'RombelController@tambah');
    Route::get('/rombel/{id}/anggota', 'RombelController@anggota');
    Route::get('/rombel/{rombel}/tambahAnggota', 'RombelController@tambahAnggota');
    Route::post('/rombel/{id_rombel}/simpanAnggota', 'RombelController@simpanAnggota');
    Route::get('/rombel/{id}/edit', 'RombelController@edit');
    Route::post('/rombel/{id}/update', 'RombelController@update');
    Route::get('/rombel/{id}/delete', 'RombelController@delete');

    Route::get('/tapel/index', 'TapelController@index');
    Route::post('/tapel/tambah', 'TapelController@tambah');
    Route::get('/tapel/{id}/edit', 'TapelController@edit');
    Route::post('/tapel/{id}/update', 'TapelController@update');
    Route::get('/tapel/{id}/delete', 'TapelController@delete');

    Route::get('/pesdik/index', 'PesdikController@index');
    Route::get('/pesdik/create', 'PesdikController@create');
    Route::post('/pesdik/tambah', 'PesdikController@tambah');
    Route::get('/pesdik/{id}/edit', 'PesdikController@edit');
    Route::post('/pesdik/{id}/update', 'PesdikController@update');
    Route::get('/pesdik/{id}/delete', 'PesdikController@delete');

    Route::get('/pesdik/{id}/registrasi', 'PesdikController@registrasi');
    Route::post('/pesdik/{id}/keluar', 'PesdikController@keluar');
    Route::get('/pesdik/keluarindex', 'PesdikController@keluarindex');
    Route::post('/pesdik/{id}/alumni', 'PesdikController@alumni');
    Route::get('/pesdik/alumniindex', 'PesdikController@alumniindex');

    Route::get('/pengumuman/{id}/edit', 'PengumumanController@edit');
    Route::post('/pengumuman/{id}/update', 'PengumumanController@update');
    Route::get('/pengumuman/{id}/delete', 'PengumumanController@delete');

    //Route delete untuk admin
    Route::get('/suratmasuk/{id}/delete', 'SuratMasukController@delete');
    Route::get('/suratkeluar/{id}/delete', 'SuratKeluarController@delete');
    Route::get('/klasifikasi/{id}/delete', 'KlasifikasiController@delete');
    Route::delete('disposisi/{suratmasuk}/{id}', 'DisposisiController@destroy')->name('disposisi.destroy');
    Route::get('/keuangan/pemasukan/{id}/delete', 'PemasukanController@delete');
    Route::get('/keuangan/pemasukan/{id}/deletekategori', 'PemasukanController@deletekategori');
    Route::get('/keuangan/pengeluaran/{id}/delete', 'PengeluaranController@delete');
    Route::get('/keuangan/pengeluaran/{id}/deletekategori', 'PengeluaranController@deletekategori');
    Route::get('/tabungan/setor/{id}/delete', 'SetorController@delete');
    Route::get('/tabungan/tarik/{id}/delete', 'TarikController@delete');
    Route::get('/pembayaran/tagihan/{id}/delete', 'TagihanController@delete');

    //Route untuk instansi dan pengguna contoller
    Route::resource('/instansi', 'InstansiController');
    Route::resource('/pengguna', 'PenggunaController');
});

//Route untuk user Petugas Administrasi Keuangan dan Admin
Route::group(['middleware' => ['auth', 'checkRole:admin,PetugasAdministrasiKeuangan']], function () {

    Route::get('/pembayaran/tagihan/index', 'TagihanController@index')->name('pembayaran.tagihan.index');
    Route::get('/pembayaran/tagihan/create', 'TagihanController@create');
    Route::post('/pembayaran/tagihan/tambah', 'TagihanController@tambah')->name('pembayaran.tagihan.tambah');
    Route::get('/pembayaran/tagihan/{id}/edit', 'TagihanController@edit');
    Route::post('/pembayaran/tagihan/{id}/update', 'TagihanController@update');
    Route::post('/pembayaran/tagihan/filter', 'TagihanController@filter');
    Route::get('/pembayaran/tagihan/{filter}/print', 'TagihanController@print');

    Route::get('/pembayaran/transaksipembayaran/index', 'TransaksiPembayaranController@index')->name('pembayaran.transaksipembayaran.index');
    Route::post('/pembayaran/transaksipembayaran/cari_pesdik', 'TransaksiPembayaranController@cari_pesdik');
    Route::post('/pembayaran/transaksipembayaran/{id}/form_bayar', 'TransaksiPembayaranController@form_bayar');
    Route::post('/pembayaran/transaksipembayaran/bayar', 'TransaksiPembayaranController@bayar');
    Route::post('/pembayaran/transaksipembayaran/cetak_invoice', 'TransaksiPembayaranController@cetak_invoice');

    Route::get('/tabungan/setor/index', 'SetorController@index');
    Route::post('/tabungan/setor/tambah', 'SetorController@tambah');
    Route::get('/tabungan/setor/{id}/edit', 'SetorController@edit');
    Route::post('/tabungan/setor/{id}/update', 'SetorController@update');
    Route::get('/tabungan/setor/{id}/cetak', 'SetorController@cetak');
    Route::get('/tabungan/setor/{id}/cetakprint', 'SetorController@cetakprint');


    Route::get('/tabungan/tarik/index', 'TarikController@index');
    Route::post('/tabungan/tarik/tambah', 'TarikController@tambah');
    Route::get('/tabungan/tarik/{id}/edit', 'TarikController@edit');
    Route::post('/tabungan/tarik/{id}/update', 'TarikController@update');
    Route::get('/tabungan/tarik/{id}/cetak', 'TarikController@cetak');
    Route::get('/tabungan/tarik/{id}/cetakprint', 'TarikController@cetakprint');

    Route::get('/keuangan/pemasukan/index', 'PemasukanController@index');
    Route::post('/keuangan/pemasukan/tambah', 'PemasukanController@tambah');
    Route::get('/keuangan/pemasukan/{id}/edit', 'PemasukanController@edit');
    Route::post('/keuangan/pemasukan/{id}/update', 'PemasukanController@update');

    Route::post('/keuangan/pemasukan/tambahkategori', 'PemasukanController@tambahkategori');
    Route::get('/keuangan/pemasukan/{id}/deletekategori', 'PemasukanController@deletekategori');

    Route::get('/keuangan/pengeluaran/index', 'PengeluaranController@index');
    Route::post('/keuangan/pengeluaran/tambah', 'PengeluaranController@tambah');
    Route::get('/keuangan/pengeluaran/{id}/edit', 'PengeluaranController@edit');
    Route::post('/keuangan/pengeluaran/{id}/update', 'PengeluaranController@update');

    Route::post('/keuangan/pengeluaran/tambahkategori', 'PengeluaranController@tambahkategori');

    Route::get('/pembayaran/transaksipembayaran/index', 'TransaksiPembayaranController@index')->name('pembayaran.transaksipembayaran.index');
    Route::post('/pembayaran/transaksipembayaran/cari_pesdik', 'TransaksiPembayaranController@cari_pesdik');
    Route::post('/pembayaran/transaksipembayaran/{id}/form_bayar', 'TransaksiPembayaranController@form_bayar');
    Route::post('/pembayaran/transaksipembayaran/bayar', 'TransaksiPembayaranController@bayar');
    Route::post('/pembayaran/transaksipembayaran/cetak_invoice', 'TransaksiPembayaranController@cetak_invoice');

    Route::get('/laporankeuangan/transaksipembayaran/index', 'LaporanController@tPembayaranIndex')->name('laporankeuangan.transaksipembayaran.index');
    Route::post('/laporankeuangan/transaksipembayaran/filterByNama', 'LaporanController@tPembayaranfilterByNama')->name('laporankeuangan.transaksipembayaran.filterByNama');
    Route::post('/laporankeuangan/transaksipembayaran/filterByKelas', 'LaporanController@tPembayaranfilterByKelas')->name('laporankeuangan.transaksipembayaran.filterByKelas');
    Route::post('/laporankeuangan/transaksipembayaran/filterByTanggal', 'LaporanController@tPembayaranfilterByTanggal')->name('laporankeuangan.transaksipembayaran.filterByTanggal');
    Route::get('/laporankeuangan/transaksipembayaran/DownloadExcel', 'LaporanController@tPembayaranDownloadExcel')->name('laporankeuangan.transaksipembayaran.DownloadExcel');
    Route::post('/laporankeuangan/transaksipembayaran/cetak', 'LaporanController@tPembayaranCetak');

    Route::get('/laporankeuangan/setortariktunai/index', 'LaporanController@tSetorTarikIndex')->name('laporankeuangan.setortariktunai.index');
    Route::post('/laporankeuangan/setortariktunai/filterByNama', 'LaporanController@tSetorTarikfilterByNama')->name('laporankeuangan.setortariktunai.filterByNama');
    Route::post('/laporankeuangan/setortariktunai/filterByKelas', 'LaporanController@tSetorTarikfilterByKelas')->name('laporankeuangan.setortariktunai.filterByKelas');
    Route::post('/laporankeuangan/setortariktunai/filterByTanggal', 'LaporanController@tSetorTarikfilterByTanggal')->name('laporankeuangan.setortariktunai.filterByTanggal');
    Route::get('/laporankeuangan/setortariktunai/DownloadExcel', 'LaporanController@tSetorTarikDownloadExcel')->name('laporankeuangan.setortariktunai.DownloadExcel');
    Route::post('/laporankeuangan/setortariktunai/cetak', 'LaporanController@tSetorTarikCetak');

    Route::get('/laporankeuangan/keuangansekolah/index', 'LaporanController@tKeuanganSekolahIndex')->name('laporankeuangan.keuangansekolah.index');
    Route::post('/laporankeuangan/keuangansekolah/filterByKategori', 'LaporanController@tKeuanganSekolahfilterByKategori')->name('laporankeuangan.keuangansekolah.filterByKategori');
    Route::post('/laporankeuangan/keuangansekolah/filterByTanggal', 'LaporanController@tKeuanganSekolahfilterByTanggal')->name('laporankeuangan.keuangansekolah.filterByTanggal');
    Route::get('/laporankeuangan/keuangansekolah/DownloadExcel', 'LaporanController@tKeuanganSekolahDownloadExcel')->name('laporankeuangan.keuangansekolah.DownloadExcel');
    Route::post('/laporankeuangan/keuangansekolah/cetak', 'LaporanController@tKeuanganSekolahCetak');
});

//Route untuk user Petugas Administrasi Surat dan Admin
Route::group(['middleware' => ['auth', 'checkRole:admin,PetugasAdministrasiSurat']], function () {

    Route::get('/suratmasuk', 'SuratMasukController@index');
    Route::get('/suratmasuk/index', 'SuratMasukController@index');
    Route::get('/suratmasuk/create', 'SuratMasukController@create');
    Route::post('/suratmasuk/tambah', 'SuratMasukController@tambah');
    Route::get('/suratmasuk/{id}/tampil', 'SuratMasukController@tampil');
    Route::get('viewAlldownloadfile', 'SuratMasukController@downfunc');
    Route::get('/suratmasuk/{id}/edit', 'SuratMasukController@edit');
    Route::post('/suratmasuk/{id}/update', 'SuratMasukController@update');

    Route::get('/suratmasuk/agenda', 'SuratMasukController@agenda')->name('suratmasuk.agenda');
    Route::post('/suratmasuk/filter_agenda', 'SuratMasukController@filter_agenda');
    Route::post('/suratmasuk/cetakagenda', 'SuratMasukController@cetakagenda');

    Route::get('/suratmasuk.agendamasukdownload_excel', 'SuratMasukController@agendamasukdownload_excel')->name('suratmasuk.downloadexcel');
    Route::get('/suratmasuk/galeri', 'SuratMasukController@galeri');

    Route::get('/suratkeluar', 'SuratKeluarController@index');
    Route::get('/suratkeluar/index', 'SuratKeluarController@index');
    Route::get('/suratkeluar/create', 'SuratKeluarController@create');
    Route::post('/suratkeluar/tambah', 'SuratKeluarController@tambah');
    Route::get('/suratkeluar/{id}/tampil', 'SuratKeluarController@tampil');
    Route::get('viewAlldownloadfile', 'SuratKeluarController@downfunc');
    Route::get('/suratkeluar/{id}/edit', 'SuratKeluarController@edit');
    Route::post('/suratkeluar/{id}/update', 'SuratKeluarController@update');

    Route::get('/suratkeluar/agenda', 'SuratKeluarController@agenda')->name('suratkeluar.agenda');
    Route::post('/suratkeluar/filter_agenda', 'SuratKeluarController@filter_agenda');
    Route::post('/suratkeluar/cetakagenda', 'SuratKeluarController@cetakagenda');
    Route::get('/suratkeluar.agendakeluardownload_excel', 'SuratKeluarController@agendakeluardownload_excel')->name('suratkeluar.downloadexcel');
    Route::get('/suratkeluar/galeri', 'SuratKeluarController@galeri');


    Route::get('/klasifikasi', 'KlasifikasiController@index');
    Route::get('/klasifikasi/index', 'KlasifikasiController@index');
    Route::get('/klasifikasi/create', 'KlasifikasiController@create');
    Route::post('/klasifikasi/tambah', 'KlasifikasiController@tambah');
    Route::get('/klasifikasi/{id}/edit', 'KlasifikasiController@edit');
    Route::post('/klasifikasi/{id}/update', 'KlasifikasiController@update');

    Route::post('/klasifikasi.import', 'KlasifikasiController@import');

    Route::get('disposisi/{suratmasuk}', 'DisposisiController@index')->name('disposisi.index');
    Route::post('disposisi/{suratmasuk}', 'DisposisiController@store')->name('disposisi.store');
    Route::get('disposisi/{suratmasuk}/create', 'DisposisiController@create')->name('disposisi.create');
    Route::get('disposisi/{suratmasuk}/{id}/edit', 'DisposisiController@edit')->name('disposisi.edit');
    Route::get('disposisi/{suratmasuk}/{id}', 'DisposisiController@update')->name('disposisi.update');
    Route::get('/disposisi/{suratmasuk}/{id}/download', 'DisposisiController@download')->name('disposisi.download');
});

//Route untuk user siswa
Route::group(['middleware' => ['auth', 'checkRole:Siswa']], function () {
    Route::get('/{id}/siswadashboard', 'DashboardController@siswadashboard');
    Route::get('/tabungan/setor/{id}/siswaindex', 'SetorController@siswaindex');
    Route::get('/tabungan/tarik/{id}/siswaindex', 'TarikController@siswaindex');
    Route::get('/pembayaran/transaksipembayaran/{id}/siswaindex', 'TransaksiPembayaranController@siswaindex');
});

//Route untuk user Admin, Petugas Administrasi Surat dan Petugas Administrasi Keuangan
Route::group(['middleware' => ['auth', 'checkRole:admin,PetugasAdministrasiKeuangan,PetugasAdministrasiSurat']], function () {
    Route::get('/', function () {
        return view('/dashboard');
    });

    Route::get('/dashboard', 'DashboardController@index');

    Route::get('/pengumuman/index', 'PengumumanController@index');
    Route::post('/pengumuman/tambah', 'PengumumanController@tambah');
});

//Route untuk user Admin, Petugas Administrasi Surat, Petugas Administrasi Keuangan dan Siswa
Route::group(['middleware' => ['auth', 'checkRole:admin,PetugasAdministrasiKeuangan,PetugasAdministrasiSurat,Siswa']], function () {
    Route::get('/auths/{id}/gantipassword', 'AuthController@gantipassword');
    Route::post('/auths/{id}/simpanpassword', 'AuthController@simpanpassword');
});
