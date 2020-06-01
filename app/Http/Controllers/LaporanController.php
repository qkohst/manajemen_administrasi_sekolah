<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\TransaksiPembayaran;
use Laravel\Setor;
use Laravel\Tarik;
use Laravel\Pemasukan;
use Laravel\Pengeluaran;

class LaporanController extends Controller
{
    public function tPembayaranIndex()
    {
        $data_transaksi = \Laravel\TransaksiPembayaran::all();
        return view('/laporankeuangan/transaksipembayaran/index', compact('data_transaksi'));
    }

    public function tSetorTarikIndex()
    {
        $data_setor = \Laravel\Setor::all();
        $data_tarik = \Laravel\Tarik::all();
        return view('/laporankeuangan/setortariktunai/index', compact('data_setor','data_tarik'));
    }
    public function tKeuanganSekolah()
    {
        $data_pemasukan = \Laravel\Pemasukan::all();
        $data_pengeluaran = \Laravel\Pengeluaran::all();
        return view('/laporankeuangan/keuangansekolah/index', compact('data_pemasukan','data_pengeluaran'));
    }
}
