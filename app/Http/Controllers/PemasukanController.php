<?php

namespace App\Http\Controllers;

use App\Pemasukan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PemasukanController extends Controller
{
    public function index()
    {
        $data_pemasukan = \App\Pemasukan::all();
        return view('/keuangan/pemasukan/index', compact('data_pemasukan'));
    }

    //function untuk tambah
    public function tambah (Request $request)
    {
        $request->validate([
            'jumlah' => 'numeric',
            'keterangan' => 'min:10',
        ]);
       $pemasukan = new Pemasukan();
       $pemasukan->kategori_id      = $request->input('kategori_id');
       $pemasukan->tanggal          = $request->input('tanggal');
       $pemasukan->jumlah           = $request->input('jumlah');
       $pemasukan->keterangan       = $request->input('keterangan');
       $pemasukan->save();
       return redirect('/keuangan/pemasukan/index')->with("sukses", "Data Pemasukan Berhasil Ditambahkan");
    }

    //function untuk hapus
    public function delete($id)
    {
        $pemasukan=\App\Pemasukan::find($id);
        $pemasukan->delete();
        return redirect('/keuangan/pemasukan/index') ->with('sukses','Data Rombongan Belajar Berhasil Dihapus');
    }
}
