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
        $data_tarik = \App\Tarik::all();
        $data_pesdik = \App\Pesdik::all();
        return view('/tabungan/tarik/index', compact('data_tarik','data_pesdik'));
    }

    //function untuk tambah
    public function tambah (Request $request)
    {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $tarik = new Tarik();
        $tarik->pesdik_id           = $request->input('pesdik_id');
        $tarik->tanggal             = $request->input('tanggal');
        $tarik->jumlah              = $request->input('jumlah');
        $tarik->keterangan          = $request->input('keterangan');
        $tarik->users_id            = Auth::id();
        $tarik->save();
        return redirect('/tabungan/tarik/index')->with("sukses", "Data Tarik Tunai Berhasil Ditambahkan");
    }

    //function untuk masuk ke view edit
    public function edit ($id_tarik)
    {
       $tarik = \App\Tarik::find($id_tarik);
       return view('/tabungan/tarik/edit', compact('tarik'));
    }

    public function update (Request $request, $id_tarik)
    {
       $request->validate([
          'jumlah' => 'numeric',
       ]);
       $tarik = \App\Tarik::find($id_tarik);
       $tarik->update($request->all());
       $tarik->save();
       return redirect('/tabungan/tarik/index') ->with('sukses','Data Tarik Tunai Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id)
    {
        $tarik=\App\Tarik::find($id);
        $tarik->delete();
        return redirect('/tabungan/tarik/index') ->with('sukses','Data Tarik Tunai Berhasil Dihapus');
    }

    //function untuk masuk ke view cetak
    public function cetak ($id_tarik)
    {
       $tarik = \App\Tarik::find($id_tarik);
       return view('/tabungan/tarik/cetak', compact('tarik'));
    }

    //function untuk masuk ke view cetak
    public function cetakprint ($id_tarik)
    {
       $tarik = \App\Tarik::find($id_tarik);
       return view('/tabungan/tarik/cetakprint', compact('tarik'));
    }
}
