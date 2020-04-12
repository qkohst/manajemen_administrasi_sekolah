<?php

namespace App\Http\Controllers;


use App\TransaksiPembayaran;
use App\Tagihan;
use App\Anggotarombel;
use App\Pesdik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiPembayaranController extends Controller
{
    public function index()
    {
        $pesdik = \App\Anggotarombel::groupBy('pesdik_id')->orderByRaw('updated_at - created_at DESC')->get();
        $rombel = \App\Anggotarombel::groupBy('rombel_id')->orderByRaw('updated_at - created_at DESC')->get();
        return view('/pembayaran/transaksipembayaran/index', compact('pesdik','rombel'));
    }

    public function cari_pesdik(Request $request)
    {
        // $cari = $request->input('cari_pesdik');
        // $rombel = $request->input('pilih_rombel');
        // $data = \App\Anggotarombel::where('pesdik_id',$cari)->get();
        // $data_pesdik = $data->first();
        // $tagihan_siswa =  \App\Tagihan::where('rombel_id',$rombel)->get();

        $cari = $request->input('cari_pesdik');
        $pesdik = \App\Anggotarombel::groupBy('pesdik_id')->orderByRaw('updated_at - created_at DESC')->get();
        $data = \App\Anggotarombel::where('pesdik_id',$cari)->get();
        $data_pesdik = $data->first();

        $tagihan_siswa =  \App\Tagihan::all();
        
        return view('/pembayaran/transaksipembayaran/cari_pesdik', compact('pesdik','cari','data_pesdik','tagihan_siswa'));
    }
}
