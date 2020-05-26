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
        return view('/pembayaran/transaksipembayaran/index', compact('pesdik', 'rombel'));
    }

    public function cari_pesdik(Request $request)
    {
        $cari = $request->input('cari_pesdik');
        $pesdik = \App\Anggotarombel::groupBy('pesdik_id')->orderByRaw('updated_at - created_at DESC')->get();
        $data = \App\Anggotarombel::where('pesdik_id', $cari)->get();
        $data_pesdik = $data->last();

        //Olah Lagi
        $pesdik_pilih = \App\Anggotarombel::select('rombel_id')->where('pesdik_id', $cari)->get();
        $pesdik_jk = \App\Pesdik::select('jenis_kelamin')->where('id', $cari)->get();
        $pilih_jk =  \App\Tagihan::whereIn('jenis_kelamin', $pesdik_jk)->orWhere('jenis_kelamin', 'Semua')->get();

        // $tagihan_siswa =  \App\Tagihan::whereIn('rombel_id', $pesdik_pilih)
        //     ->WhereIn('jenis_kelamin', $pilih_jk)->get();
        
        $tagihan_siswa = \App\Tagihan::whereIn('rombel_id', $pesdik_pilih)
        ->WhereIn('jenis_kelamin', $pilih_jk)
        ->leftJoin('transaksipembayaran', 'tagihan.id', '=', 'transaksipembayaran.tagihan_id')
        ->get();
        //End Olah Lagi
        // dd($coba);
        return view('/pembayaran/transaksipembayaran/cari_pesdik', compact('pesdik', 'cari', 'data_pesdik', 'tagihan_siswa', 'pesdik_pilih', 'pilih_jk'));
    }

    public function form_bayar(Request $request, $id_pesdik)
    {
        //Olah Lagi
        $pesdik = $id_pesdik;
        $pilihTagihan = $request->Input('pilih');
        $pesdik_pilih = \App\Anggotarombel::select('rombel_id')->where('pesdik_id', $id_pesdik)->get();
        $tagihan_siswa =  \App\Tagihan::whereIn('id', $pilihTagihan)->get();
        //End Olah Lagi
        // dd($coba);
        return view('/pembayaran/transaksipembayaran/form_bayar', compact('pesdik', 'tagihan_siswa', 'pesdik_pilih', 'pilihTagihan'));
    }

    public function bayar(Request $request)
    {
        $users_id = Auth::id();
        $tagihan_id = $request->tagihan_id;
        $pesdik_id = $request->pesdik_id;
        $nominal = $request->nominal;
        $jumlah_bayar = $request->jumlah_bayar;

        for ($count = 0; $count < count($tagihan_id); $count++) {
            $data = array(
                'tagihan_id' => $tagihan_id[$count],
                'users_id'  => $users_id,
                'pesdik_id'  => $pesdik_id[$count],
                'jumlah_bayar'  => $jumlah_bayar[$count]
            );
            $insert_data[] = $data;
        }
        // dd($insert_data);
        TransaksiPembayaran::insert($insert_data);
        // return response()->json([
        //     'success'  => 'Data Rincian Tagihan Berhasil Ditambahkan !!!'
        // ]);

        // return view('/pembayaran/transaksipembayaran/form_bayar', compact('pesdik','tagihan_siswa', 'pesdik_pilih', 'pilihTagihan'));
    }
}
