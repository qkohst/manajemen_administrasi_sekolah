<?php

namespace App\Http\Controllers;

use App\Pemasukan;
use App\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PemasukanController extends Controller
{
    public function index()
    {
        $data_pemasukan = \App\Pemasukan::orderByRaw('created_at DESC')->get();
        $data_kategori = \App\Kategori::where('jenis_kategori', 1)->where('id', '!=', 1)->orderByRaw('nama_kategori ASC')->get();
        return view('/keuangan/pemasukan/index', compact('data_pemasukan', 'data_kategori'));
    }

    //function untuk tambah
    public function tambah(Request $request)
    {
        $request->validate([
            'jumlah' => 'numeric',
            'keterangan' => 'min:10',
        ]);
        $pemasukan = new Pemasukan();
        $pemasukan->kategori_id      = $request->input('kategori_id');
        $pemasukan->jumlah           = $request->input('jumlah');
        $pemasukan->keterangan       = $request->input('keterangan');
        $pemasukan->save();
        return redirect('/keuangan/pemasukan/index')->with("sukses", "Data Pemasukan Berhasil Ditambahkan");
    }

    //function untuk masuk ke view edit
    public function edit($id_pemasukan)
    {
        $pemasukan = \App\Pemasukan::find($id_pemasukan);
        $data_kategori = \App\Kategori::where('jenis_kategori', 1)->get();
        return view('/keuangan/pemasukan/editpemasukan', compact('pemasukan', 'data_kategori'));
    }
    public function update(Request $request, $id_pemasukan)
    {
        $request->validate([
            'jumlah' => 'numeric',
            'keterangan' => 'min:10',
        ]);
        $pemasukan = \App\Pemasukan::find($id_pemasukan);
        $pemasukan->update($request->all());
        $pemasukan->save();
        return redirect('/keuangan/pemasukan/index')->with('sukses', 'Data Pemasukan Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id)
    {
        $pemasukan = \App\Pemasukan::find($id);
        $pemasukan->delete();
        return redirect('/keuangan/pemasukan/index')->with('sukses', 'Data Pemasukan Berhasil Dihapus');
    }

    //KATEGORI PEMASUKAN
    //function untuk tambahkategori
    public function tambahkategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'min:5',
        ]);
        $kategori = new Kategori();
        $kategori->jenis_kategori   = 1;
        $kategori->nama_kategori    = $request->input('nama_kategori');
        $kategori->save();
        return redirect('/keuangan/pemasukan/index')->with("sukses", "Data Kategori Berhasil Ditambahkan");
    }
    //function untuk hapus
    public function deletekategori($id)
    {
        try {
            $kategori = \App\Kategori::find($id);
            $kategori->delete();
            return redirect('/keuangan/pemasukan/index')->with('sukses', 'Data Kategori Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('warning', 'Maaf data tidak dapat dihapus, masih terdapat data pada tabel lain yang terpaut dengan data ini!');
        }
    }
}
