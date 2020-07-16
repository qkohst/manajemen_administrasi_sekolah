<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiPembayaranExport;
use App\Exports\SetorTarikExport;
use App\Exports\KeuanganSekolahExport;
use Carbon\Carbon;


class LaporanController extends Controller
{
    //Laporan Transaksi Pembayaran
    public function tPembayaranIndex()
    {
        $data_id_pesdik = \App\TransaksiPembayaran::select('pesdik_id')->groupBy('pesdik_id')->get();
        $data_id_rombel = \App\TransaksiPembayaran::select('rombel_id')->groupBy('rombel_id')->get();
        $tgl_1 = \App\TransaksiPembayaran::first();
        $tgl_2 = \App\TransaksiPembayaran::latest()->first();
        $tgl_awal = $tgl_1->created_at;
        $tgl_akhir = $tgl_2->created_at;

        $daftar_nama = \App\TransaksiPembayaran::groupBy('pesdik_id')->orderByRaw('pesdik_id DESC')->get();
        $daftar_kelas = \App\TransaksiPembayaran::groupBy('rombel_id')->orderByRaw('rombel_id DESC')->get();
        $data_transaksi = \App\TransaksiPembayaran::orderByRaw('created_at DESC')->get();
        $total_transaksi = \App\TransaksiPembayaran::all()->sum('jumlah_bayar');
        return view('/laporankeuangan/transaksipembayaran/index', compact('data_transaksi', 'daftar_nama', 'daftar_kelas', 'data_id_pesdik', 'data_id_rombel', 'tgl_awal', 'tgl_akhir'));
    }

    public function tPembayaranfilterByNama(Request $request)
    {
        $pesdik_id = $request->input('filterNama');

        $data_id_pesdik = \App\TransaksiPembayaran::select('pesdik_id')->where('pesdik_id', $pesdik_id)->get();
        $data_id_rombel = \App\TransaksiPembayaran::select('rombel_id')->groupBy('rombel_id')->get();
        $tgl_1 = \App\TransaksiPembayaran::first();
        $tgl_2 = \App\TransaksiPembayaran::latest()->first();
        $tgl_awal = $tgl_1->created_at;
        $tgl_akhir = $tgl_2->created_at;

        $daftar_nama = \App\TransaksiPembayaran::groupBy('pesdik_id')->orderByRaw('pesdik_id DESC')->get();
        $daftar_kelas = \App\TransaksiPembayaran::groupBy('rombel_id')->orderByRaw('rombel_id DESC')->get();
        $data_transaksi = \App\TransaksiPembayaran::where('pesdik_id', $pesdik_id)->orderByRaw('created_at DESC')->get();
        return view('/laporankeuangan/transaksipembayaran/index', compact('data_transaksi', 'daftar_nama', 'daftar_kelas', 'data_id_pesdik', 'data_id_rombel', 'tgl_awal', 'tgl_akhir'));
    }

    public function tPembayaranfilterByKelas(Request $request)
    {
        $id_rombel = $request->input('filterKelas');

        $data_id_pesdik = \App\TransaksiPembayaran::select('pesdik_id')->groupBy('pesdik_id')->get();
        $data_id_rombel = \App\TransaksiPembayaran::select('rombel_id')->where('rombel_id', $id_rombel)->get();
        $tgl_1 = \App\TransaksiPembayaran::first();
        $tgl_2 = \App\TransaksiPembayaran::latest()->first();
        $tgl_awal = $tgl_1->created_at;
        $tgl_akhir = $tgl_2->created_at;

        $daftar_nama = \App\TransaksiPembayaran::groupBy('pesdik_id')->orderByRaw('pesdik_id DESC')->get();
        $daftar_kelas = \App\TransaksiPembayaran::groupBy('rombel_id')->orderByRaw('rombel_id DESC')->get();
        $data_transaksi = \App\TransaksiPembayaran::where('rombel_id', $id_rombel)->orderByRaw('created_at DESC')->get();
        return view('/laporankeuangan/transaksipembayaran/index', compact('data_transaksi', 'daftar_nama', 'daftar_kelas', 'data_id_pesdik', 'data_id_rombel', 'tgl_awal', 'tgl_akhir'));
    }

    public function tPembayaranfilterByTanggal(Request $request)
    {
        $tgl_awal = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        $data_id_pesdik = \App\TransaksiPembayaran::select('pesdik_id')->groupBy('pesdik_id')->get();
        $data_id_rombel = \App\TransaksiPembayaran::select('rombel_id')->groupBy('rombel_id')->get();

        $daftar_nama = \App\TransaksiPembayaran::groupBy('pesdik_id')->orderByRaw('pesdik_id DESC')->get();
        $daftar_kelas = \App\TransaksiPembayaran::groupBy('rombel_id')->orderByRaw('rombel_id DESC')->get();
        $data_transaksi = \App\TransaksiPembayaran::whereBetween('created_at', [$tgl_awal, $tgl_akhir])->orderByRaw('created_at DESC')->get();
        return view('/laporankeuangan/transaksipembayaran/index', compact('data_transaksi', 'daftar_nama', 'daftar_kelas', 'data_id_pesdik', 'data_id_rombel', 'tgl_awal', 'tgl_akhir'));
    }

    public function tPembayaranDownloadExcel()
    {
        $namafile = 'Laporan_transaksi_pembayaran_siswa_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new TransaksiPembayaranExport, $namafile);
    }

    public function tPembayaranCetak(Request $request)
    {
        $inst = \App\Instansi::first();
        $data_id_pesdik = $request->id_pesdik;
        $data_id_rombel = $request->id_rombel;
        $tgl_awal = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        $data_transaksi = \App\TransaksiPembayaran::whereIn('pesdik_id', $data_id_pesdik)->whereIn('rombel_id', $data_id_rombel)->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->get();
        $total_transaksi = \App\TransaksiPembayaran::whereIn('pesdik_id', $data_id_pesdik)->whereIn('rombel_id', $data_id_rombel)->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->sum('jumlah_bayar');
        return view('/laporankeuangan/transaksipembayaran/cetak', compact('inst', 'data_transaksi', 'tgl_awal', 'tgl_akhir', 'total_transaksi'));
    }


    //Laporan Setor dan Tarik Tunai
    public function tSetorTarikIndex()
    {
        $data_id_pesdik = \App\Setor::select('pesdik_id')->groupBy('pesdik_id')->get();
        $data_id_rombel = \App\Setor::select('rombel_id')->groupBy('rombel_id')->get();
        $tgl_1 = \App\Setor::first();
        $tgl_awal = $tgl_1->created_at;
        $tgl_akhir = Carbon::now();

        $daftar_nama = \App\Setor::groupBy('pesdik_id')->orderByRaw('pesdik_id DESC')->get();
        $daftar_kelas = \App\Setor::groupBy('rombel_id')->orderByRaw('rombel_id DESC')->get();

        $data_setor = \App\Setor::orderByRaw('created_at DESC')->get();
        $total_setor = \App\Setor::all()->sum('jumlah');

        $data_tarik = \App\Tarik::orderByRaw('created_at DESC')->get();
        $total_tarik = \App\Tarik::all()->sum('jumlah');

        return view('/laporankeuangan/setortariktunai/index', compact('daftar_nama', 'daftar_kelas', 'data_setor', 'total_setor', 'data_tarik', 'total_tarik', 'data_id_pesdik', 'data_id_rombel', 'tgl_awal', 'tgl_akhir'));
    }

    public function tSetorTarikfilterByNama(Request $request)
    {
        $pesdik_id = $request->input('filterNama');

        $data_id_pesdik = \App\Setor::select('pesdik_id')->where('pesdik_id', $pesdik_id)->get();
        $data_id_rombel = \App\Setor::select('rombel_id')->groupBy('rombel_id')->get();

        $tgl_1 = \App\Setor::first();
        $tgl_awal = $tgl_1->created_at;
        $tgl_akhir = Carbon::now();

        $daftar_nama = \App\Setor::groupBy('pesdik_id')->orderByRaw('pesdik_id DESC')->get();
        $daftar_kelas = \App\Setor::groupBy('rombel_id')->orderByRaw('rombel_id DESC')->get();

        $data_setor = \App\Setor::where('pesdik_id', $pesdik_id)->orderByRaw('created_at DESC')->get();
        $total_setor = \App\Setor::where('pesdik_id', $pesdik_id)->sum('jumlah');

        $data_tarik = \App\Tarik::where('pesdik_id', $pesdik_id)->orderByRaw('created_at DESC')->get();
        $total_tarik = \App\Tarik::where('pesdik_id', $pesdik_id)->sum('jumlah');

        return view('/laporankeuangan/setortariktunai/index', compact('daftar_nama', 'daftar_kelas', 'data_setor', 'total_setor', 'data_tarik', 'total_tarik', 'data_id_pesdik', 'data_id_rombel', 'tgl_awal', 'tgl_akhir'));
    }

    public function tSetorTarikfilterByKelas(Request $request)
    {
        $id_rombel = $request->input('filterKelas');

        $data_id_pesdik = \App\Setor::select('pesdik_id')->groupBy('pesdik_id')->get();
        $data_id_rombel = \App\Setor::select('rombel_id')->where('rombel_id', $id_rombel)->get();
        $tgl_1 = \App\Setor::first();
        $tgl_awal = $tgl_1->created_at;
        $tgl_akhir = Carbon::now();

        $daftar_nama = \App\Setor::groupBy('pesdik_id')->orderByRaw('pesdik_id DESC')->get();
        $daftar_kelas = \App\Setor::groupBy('rombel_id')->orderByRaw('rombel_id DESC')->get();

        $data_setor = \App\Setor::where('rombel_id', $id_rombel)->orderByRaw('created_at DESC')->get();
        $total_setor = \App\Setor::where('rombel_id', $id_rombel)->sum('jumlah');

        $data_tarik = \App\Tarik::where('rombel_id', $id_rombel)->orderByRaw('created_at DESC')->get();
        $total_tarik = \App\Tarik::where('rombel_id', $id_rombel)->sum('jumlah');

        return view('/laporankeuangan/setortariktunai/index', compact('daftar_nama', 'daftar_kelas', 'data_setor', 'total_setor', 'data_tarik', 'total_tarik', 'data_id_pesdik', 'data_id_rombel', 'tgl_awal', 'tgl_akhir'));
    }

    public function tSetorTarikfilterByTanggal(Request $request)
    {
        $tgl_awal = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        $data_id_pesdik = \App\Setor::select('pesdik_id')->groupBy('pesdik_id')->get();
        $data_id_rombel = \App\Setor::select('rombel_id')->groupBy('rombel_id')->get();

        $daftar_nama = \App\Setor::groupBy('pesdik_id')->orderByRaw('pesdik_id DESC')->get();
        $daftar_kelas = \App\Setor::groupBy('rombel_id')->orderByRaw('rombel_id DESC')->get();

        $data_setor = \App\Setor::whereBetween('created_at', [$tgl_awal, $tgl_akhir])->orderByRaw('created_at DESC')->get();
        $total_setor = \App\Setor::whereBetween('created_at', [$tgl_awal, $tgl_akhir])->sum('jumlah');

        $data_tarik = \App\Tarik::whereBetween('created_at', [$tgl_awal, $tgl_akhir])->orderByRaw('created_at DESC')->get();
        $total_tarik = \App\Tarik::whereBetween('created_at', [$tgl_awal, $tgl_akhir])->sum('jumlah');

        return view('/laporankeuangan/setortariktunai/index', compact('daftar_nama', 'daftar_kelas', 'data_setor', 'total_setor', 'data_tarik', 'total_tarik', 'data_id_pesdik', 'data_id_rombel', 'tgl_awal', 'tgl_akhir'));
    }


    public function tSetorTarikCetak(Request $request)
    {
        $inst = \App\Instansi::first();
        $data_id_pesdik = $request->id_pesdik;
        $data_id_rombel = $request->id_rombel;
        $tgl_awal = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        $data_setor = \App\Setor::whereIn('pesdik_id', $data_id_pesdik)->whereIn('rombel_id', $data_id_rombel)->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->get();
        $total_setor = \App\Setor::whereIn('pesdik_id', $data_id_pesdik)->whereIn('rombel_id', $data_id_rombel)->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->sum('jumlah');

        $data_tarik = \App\Tarik::whereIn('pesdik_id', $data_id_pesdik)->whereIn('rombel_id', $data_id_rombel)->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->get();
        $total_tarik = \App\Tarik::whereIn('pesdik_id', $data_id_pesdik)->whereIn('rombel_id', $data_id_rombel)->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->sum('jumlah');

        return view('/laporankeuangan/setortariktunai/cetak', compact('inst', 'tgl_awal', 'tgl_akhir', 'data_setor', 'total_setor', 'data_tarik', 'total_tarik'));
    }

    public function tSetorTarikDownloadExcel()
    {
        $namafile = 'Laporan_setor_tarik_tunai_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new SetorTarikExport, $namafile);
    }

    //Laporan Keuangan Sekolah
    public function tKeuanganSekolahIndex()
    {
        $daftar_kategori = \App\Kategori::orderByRaw('nama_kategori ASC')->get();

        $data_id_kategori = \App\Kategori::all();
        $tgl_1 = \App\Pemasukan::first();
        $tgl_awal = $tgl_1->created_at;
        $tgl_akhir = Carbon::now();


        $data_pemasukan = \App\Pemasukan::orderByRaw('created_at DESC')->get();
        $total_pemasukan = \App\Pemasukan::all()->sum('jumlah');

        $data_pengeluaran = \App\Pengeluaran::orderByRaw('created_at DESC')->get();
        $total_pengeluaran = \App\Pengeluaran::all()->sum('jumlah');

        return view('/laporankeuangan/keuangansekolah/index', compact('daftar_kategori', 'data_id_kategori', 'tgl_awal', 'tgl_akhir', 'data_pemasukan', 'total_pemasukan', 'data_pengeluaran', 'total_pengeluaran'));
    }

    public function tKeuanganSekolahfilterByKategori(Request $request)
    {
        $kategori_id = $request->input('filterKategori');

        $data_id_kategori = \App\Kategori::select('id')->where('id', $kategori_id)->get();
        $tgl_1 = \App\Pemasukan::first();
        $tgl_awal = $tgl_1->created_at;
        $tgl_akhir = Carbon::now();


        $daftar_kategori = \App\Kategori::orderByRaw('nama_kategori ASC')->get();

        $data_pemasukan = \App\Pemasukan::where('kategori_id', $kategori_id)->orderByRaw('created_at DESC')->get();
        $total_pemasukan = \App\Pemasukan::where('kategori_id', $kategori_id)->sum('jumlah');

        $data_pengeluaran = \App\Pengeluaran::where('kategori_id', $kategori_id)->orderByRaw('created_at DESC')->get();
        $total_pengeluaran = \App\Pengeluaran::where('kategori_id', $kategori_id)->sum('jumlah');

        return view('/laporankeuangan/keuangansekolah/index', compact('daftar_kategori', 'data_id_kategori', 'tgl_awal', 'tgl_akhir', 'data_pemasukan', 'total_pemasukan', 'data_pengeluaran', 'total_pengeluaran'));
    }

    public function tKeuanganSekolahfilterByTanggal(Request $request)
    {
        $tgl_awal = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');
        $data_id_kategori = \App\Kategori::all();

        $daftar_kategori = \App\Kategori::orderByRaw('nama_kategori ASC')->get();

        $data_pemasukan = \App\Pemasukan::whereBetween('created_at', [$tgl_awal, $tgl_akhir])->orderByRaw('created_at DESC')->get();
        $total_pemasukan = \App\Pemasukan::whereBetween('created_at', [$tgl_awal, $tgl_akhir])->sum('jumlah');

        $data_pengeluaran = \App\Pengeluaran::whereBetween('created_at', [$tgl_awal, $tgl_akhir])->orderByRaw('created_at DESC')->get();
        $total_pengeluaran = \App\Pengeluaran::whereBetween('created_at', [$tgl_awal, $tgl_akhir])->sum('jumlah');

        return view('/laporankeuangan/keuangansekolah/index', compact('daftar_kategori', 'data_id_kategori', 'tgl_awal', 'tgl_akhir', 'data_pemasukan', 'total_pemasukan', 'data_pengeluaran', 'total_pengeluaran'));
    }

    public function tKeuanganSekolahCetak(Request $request)
    {
        $inst = \App\Instansi::first();
        $data_id_kategori = $request->id_kategori;
        $tgl_awal = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        $data_pemasukan = \App\Pemasukan::whereIn('kategori_id', $data_id_kategori)->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->get();
        $total_pemasukan = \App\Pemasukan::whereIn('kategori_id', $data_id_kategori)->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->sum('jumlah');

        $data_pengeluaran = \App\Pengeluaran::whereIn('kategori_id', $data_id_kategori)->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->get();
        $total_pengeluaran = \App\Pengeluaran::whereIn('kategori_id', $data_id_kategori)->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->sum('jumlah');

        return view('/laporankeuangan/keuangansekolah/cetak', compact('inst', 'tgl_awal', 'tgl_akhir', 'data_pemasukan', 'total_pemasukan', 'data_pengeluaran', 'total_pengeluaran'));
    }

    public function tKeuanganSekolahDownloadExcel()
    {
        $namafile = 'Laporan_keuangan_sekolah_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new KeuanganSekolahExport, $namafile);
    }
}
