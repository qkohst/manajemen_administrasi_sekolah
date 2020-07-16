<?php

namespace App\Http\Controllers;

use App\Tarik;
use App\Pesdik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TarikController extends Controller
{
    public function index()
    {
        $data_tarik = \App\Tarik::orderByRaw('created_at DESC')->get();
        $data_pesdik = \App\Setor::groupBy('pesdik_id')->orderByRaw('created_at DESC')->get();
        return view('/tabungan/tarik/index', compact('data_tarik', 'data_pesdik'));
    }

    //function untuk tambah
    public function tambah(Request $request)
    {
        $pilih_pesdik = $request->input('pesdik_id');
        //Mengambil nilai rombel id
        $pesdik = \App\Pesdik::select('rombel_id')->where('id', $pilih_pesdik)->get();
        $data = $pesdik->first();
        $rombel_id = $data->rombel_id;

        //menghitung saldo tabungan
        $total_setor = DB::table('setor')->where('setor.pesdik_id', '=', $pilih_pesdik)
            ->sum('setor.jumlah');
        $total_tarik = DB::table('tarik')->where('tarik.pesdik_id', '=', $pilih_pesdik)
            ->sum('tarik.jumlah');
        $saldo_tabungan = $total_setor - $total_tarik;
        $jumlah_penarikan = $request->input('jumlah');

        if ($jumlah_penarikan > $saldo_tabungan) {
            return redirect()->back()->with('warning', 'Maaf saldo tabungan siswa kurang dari nominal yang anda masukkan pada kolom jumlah, harap cek saldo tabungan siswa pada menu Data Peserta Didik !');
        } else {
            $request->validate([
                'jumlah' => 'numeric',
            ]);
            $data_tarik = new Tarik();
            $data_tarik->pesdik_id           = $pilih_pesdik;
            $data_tarik->rombel_id           = $rombel_id;
            $data_tarik->tanggal             = $request->input('tanggal');
            $data_tarik->jumlah              = $request->input('jumlah');
            $data_tarik->keterangan          = $request->input('keterangan');
            $data_tarik->users_id            = Auth::id();
            $data_tarik->save();
            // return redirect('/tabungan/tarik/index')->with("sukses", "Data Tarik Tunai Berhasil Ditambahkan");
            $tarik = \App\Tarik::find($data_tarik->id);
            return view('/tabungan/tarik/cetak', compact('tarik'));
        }
    }

    //function untuk masuk ke view edit
    public function edit($id_tarik)
    {
        $tarik = \App\Tarik::find($id_tarik);
        return view('/tabungan/tarik/edit', compact('tarik'));
    }

    public function update(Request $request, $id_tarik)
    {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $tarik = \App\Tarik::find($id_tarik);
        $tarik->update($request->all());
        $tarik->save();
        return redirect('/tabungan/tarik/index')->with('sukses', 'Data Tarik Tunai Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id)
    {
        $tarik = \App\Tarik::find($id);
        $tarik->delete();
        return redirect('/tabungan/tarik/index')->with('sukses', 'Data Tarik Tunai Berhasil Dihapus');
    }

    //function untuk masuk ke view cetak
    public function cetak($id_tarik)
    {
        $tarik = \App\Tarik::find($id_tarik);
        return view('/tabungan/tarik/cetak', compact('tarik'));
    }

    //function untuk masuk ke view cetak
    public function cetakprint($id_tarik)
    {
        $tarik = \App\Tarik::find($id_tarik);
        return view('/tabungan/tarik/cetakprint', compact('tarik'));
    }

    public function siswaindex($id)
    {
        $pesdik = \App\Pesdik::where('id', $id)->get();
        $id_pesdik_login = $pesdik->first();

        $data_pesdik = \App\Pesdik::where('id', $id)->get();
        $data_tarik = \App\Tarik::where('pesdik_id', $id)->orderByRaw('created_at DESC')->get();
        return view('/tabungan/tarik/siswaindex', compact('data_pesdik', 'data_tarik', 'id_pesdik_login'));
    }
}
