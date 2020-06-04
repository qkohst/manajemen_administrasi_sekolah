<?php

namespace App\Http\Controllers;

use App\Pengeluaran;
use App\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class PengeluaranController extends Controller
{
    public function index()
    {
        $data_pengeluaran = \App\Pengeluaran::all();
        $data_kategori = \App\Kategori::where('jenis_kategori', 2)->get();
        return view('/keuangan/pengeluaran/index', compact('data_pengeluaran','data_kategori'));
    }

    //function untuk tambah
    public function tambah (Request $request)
    {
        $request->validate([
            'jumlah' => 'numeric',
            'keterangan' => 'min:10',
        ]);
       $pengeluaran = new Pengeluaran();
       $pengeluaran->kategori_id      = $request->input('kategori_id');
       $pengeluaran->jumlah           = $request->input('jumlah');
       $pengeluaran->keterangan       = $request->input('keterangan');
       $pengeluaran->save();
       return redirect('/keuangan/pengeluaran/index')->with("sukses", "Data Pengeluaran Berhasil Ditambahkan");
    }

     //function untuk masuk ke view edit
     public function edit ($id_pengeluaran)
     {
         $pengeluaran = \App\Pengeluaran::find($id_pengeluaran);
         $data_kategori = \App\Kategori::where('jenis_kategori', 2)->get();
         return view('/keuangan/pengeluaran/editpengeluaran', compact('pengeluaran','data_kategori'));
     }
     public function update (Request $request, $id_pengeluaran)
     {
         $request->validate([
            'jumlah' => 'numeric',
            'keterangan' => 'min:10',
         ]);
         $pengeluaran = \App\Pengeluaran::find($id_pengeluaran);
         $pengeluaran->update($request->all());
         $pengeluaran->save();
         return redirect('/keuangan/pengeluaran/index') ->with('sukses','Data Pengeluaran Berhasil Diedit');
     }

    //function untuk hapus
    public function delete($id)
    {
        $pengeluaran=\App\Pengeluaran::find($id);
        $pengeluaran->delete();
        return redirect('/keuangan/pengeluaran/index') ->with('sukses','Data Pengeluaran Berhasil Dihapus');
    }

     //KATEGORI PENGELUARAN
    //function untuk tambahkategori
    public function tambahkategori (Request $request)
    {
        $request->validate([
            'nama_kategori' => 'min:5',
        ]);
       $kategori = new Kategori();
       $kategori->jenis_kategori   = 2;
       $kategori->nama_kategori    = $request->input('nama_kategori');
       $kategori->save();
       return redirect('/keuangan/pengeluaran/index')->with("sukses", "Data Kategori Berhasil Ditambahkan");
    }
      //function untuk hapus
      public function deletekategori($id)
      {
          $kategori=\App\Kategori::find($id);
          $kategori->delete();
          return redirect('/keuangan/pengeluaran/index') ->with('sukses','Data Kategori Berhasil Dihapus');
      }
}
