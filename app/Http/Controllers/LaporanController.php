<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\TransaksiPembayaran;
use App\Setor;
use App\Tarik;
use App\Pemasukan;
use App\Pengeluaran;

class LaporanController extends Controller
{
    public function tPembayaranIndex()
    {
        $data_transaksi = \App\TransaksiPembayaran::all();
        return view('/laporankeuangan/transaksipembayaran/index', compact('data_transaksi'));
    }

    public function tSetorTarikIndex()
    {
        $data_setor = \App\Setor::all();
        $data_tarik = \App\Tarik::all();
        return view('/laporankeuangan/setortariktunai/index', compact('data_setor','data_tarik'));
    }
    public function tKeuanganSekolah()
    {
        $data_pemasukan = \App\Pemasukan::all();
        $data_pengeluaran = \App\Pengeluaran::all();
        return view('/laporankeuangan/keuangansekolah/index', compact('data_pemasukan','data_pengeluaran'));
    }
}
