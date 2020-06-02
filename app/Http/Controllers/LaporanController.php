<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiPembayaranExport;
use Carbon\Carbon;


class LaporanController extends Controller
{
    //Laporan Transaksi Pembayaran
    public function tPembayaranIndex()
    {
        $data_id_pesdik = \App\TransaksiPembayaran::select('pesdik_id')->groupBy('pesdik_id')->get();
        $data_id_rombel = \App\TransaksiPembayaran::select('id_rombel')->groupBy('id_rombel')->get();
        $tgl_1 = \App\TransaksiPembayaran::first();
        $tgl_2 = \App\TransaksiPembayaran::latest()->first();
        $tgl_awal = $tgl_1->created_at;
        $tgl_akhir = $tgl_2->created_at;

        $daftar_nama = \App\TransaksiPembayaran::groupBy('pesdik_id')->get();
        $daftar_kelas = \App\TransaksiPembayaran::groupBy('id_rombel')->get();
        $data_transaksi = \App\TransaksiPembayaran::all();
        $total_transaksi = \App\TransaksiPembayaran::all()->sum('jumlah_bayar');
        return view('/laporankeuangan/transaksipembayaran/index', compact('data_transaksi', 'daftar_nama', 'daftar_kelas', 'data_id_pesdik', 'data_id_rombel', 'tgl_awal', 'tgl_akhir'));
    }

    public function tPembayaranfilterByNama(Request $request)
    {
        $pesdik_id = $request->input('filterNama');

        $data_id_pesdik = \App\TransaksiPembayaran::select('pesdik_id')->where('pesdik_id', $pesdik_id)->get();
        $data_id_rombel = \App\TransaksiPembayaran::select('id_rombel')->groupBy('id_rombel')->get();
        $tgl_1 = \App\TransaksiPembayaran::first();
        $tgl_2 = \App\TransaksiPembayaran::latest()->first();
        $tgl_awal = $tgl_1->created_at;
        $tgl_akhir = $tgl_2->created_at;

        $daftar_nama = \App\TransaksiPembayaran::groupBy('pesdik_id')->get();
        $daftar_kelas = \App\TransaksiPembayaran::groupBy('id_rombel')->get();
        $data_transaksi = \App\TransaksiPembayaran::where('pesdik_id', $pesdik_id)->get();
        return view('/laporankeuangan/transaksipembayaran/index', compact('data_transaksi', 'daftar_nama', 'daftar_kelas', 'data_id_pesdik', 'data_id_rombel', 'tgl_awal', 'tgl_akhir'));
    }

    public function tPembayaranfilterByKelas(Request $request)
    {
        $id_rombel = $request->input('filterKelas');

        $data_id_pesdik = \App\TransaksiPembayaran::select('pesdik_id')->groupBy('pesdik_id')->get();
        $data_id_rombel = \App\TransaksiPembayaran::select('id_rombel')->where('id_rombel',$id_rombel)->get();
        $tgl_1 = \App\TransaksiPembayaran::first();
        $tgl_2 = \App\TransaksiPembayaran::latest()->first();
        $tgl_awal = $tgl_1->created_at;
        $tgl_akhir = $tgl_2->created_at;
        
        $daftar_nama = \App\TransaksiPembayaran::groupBy('pesdik_id')->get();
        $daftar_kelas = \App\TransaksiPembayaran::groupBy('id_rombel')->get();
        $data_transaksi = \App\TransaksiPembayaran::where('id_rombel', $id_rombel)->get();
        return view('/laporankeuangan/transaksipembayaran/index', compact('data_transaksi', 'daftar_nama', 'daftar_kelas', 'data_id_pesdik', 'data_id_rombel', 'tgl_awal', 'tgl_akhir'));
    }

    public function tPembayaranfilterByTanggal(Request $request)
    {
        $tgl_awal = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        $data_id_pesdik = \App\TransaksiPembayaran::select('pesdik_id')->groupBy('pesdik_id')->get();
        $data_id_rombel = \App\TransaksiPembayaran::select('id_rombel')->groupBy('id_rombel')->get();

        $daftar_nama = \App\TransaksiPembayaran::groupBy('pesdik_id')->get();
        $daftar_kelas = \App\TransaksiPembayaran::groupBy('id_rombel')->get();
        $data_transaksi = \App\TransaksiPembayaran::whereBetween('created_at', [$tgl_awal, $tgl_akhir])->get();
        return view('/laporankeuangan/transaksipembayaran/index', compact('data_transaksi', 'daftar_nama', 'daftar_kelas', 'data_id_pesdik', 'data_id_rombel', 'tgl_awal', 'tgl_akhir'));
    }

    public function tPembayaranDownloadExcel()
    {
        return Excel::download(new TransaksiPembayaranExport, 'TransaksiPembayaran(All).xlsx');
    }

    public function tPembayaranCetak(Request $request)
    {
        $inst = \App\Instansi::first();
        $data_id_pesdik = $request->id_pesdik;
        $data_id_rombel = $request->id_rombel;
        $tgl_awal = $request->input('tgl_awal');
        $tgl_akhir = $request->input('tgl_akhir');

        $data_transaksi = \App\TransaksiPembayaran::whereIn('pesdik_id', $data_id_pesdik)->whereIn('id_rombel', $data_id_rombel)->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->get();
        $total_transaksi = \App\TransaksiPembayaran::whereIn('pesdik_id', $data_id_pesdik)->whereIn('id_rombel', $data_id_rombel)->whereBetween('created_at', [$tgl_awal, $tgl_akhir])->sum('jumlah_bayar');
        // dd($data_transaksi);
        return view('/laporankeuangan/transaksipembayaran/cetak', compact('inst', 'data_transaksi', 'tgl_awal', 'tgl_akhir','total_transaksi'));
    }


    //Laporan Setor dan Tarik Tunai
    public function tSetorTarikIndex()
    {
        $data_setor = \App\Setor::all();
        $data_tarik = \App\Tarik::all();
        return view('/laporankeuangan/setortariktunai/index', compact('data_setor', 'data_tarik'));
    }

    //Laporan Keuangan Sekolah
    public function tKeuanganSekolah()
    {
        $data_pemasukan = \App\Pemasukan::all();
        $data_pengeluaran = \App\Pengeluaran::all();
        return view('/laporankeuangan/keuangansekolah/index', compact('data_pemasukan', 'data_pengeluaran'));
    }
}
