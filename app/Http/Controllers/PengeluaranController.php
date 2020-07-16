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
        $data_pengeluaran = \App\Pengeluaran::orderByRaw('created_at DESC')->get();
        $data_kategori = \App\Kategori::where('jenis_kategori', 2)->orderByRaw('nama_kategori ASC')->get();
        return view('/keuangan/pengeluaran/index', compact('data_pengeluaran', 'data_kategori'));
    }

    //function untuk tambah
    public function tambah(Request $request)
    {
        //Menentukan saldo keuangan sekolah
        $total_pengeluaran = DB::table('pengeluaran')
            ->sum('pengeluaran.jumlah');
        $total_pemasukan = DB::table('pemasukan')
            ->sum('pemasukan.jumlah');
        $saldo = $total_pemasukan - $total_pengeluaran;

        $jumlah_pengeluaran = $request->input('jumlah');
        if ($jumlah_pengeluaran > $saldo) {
            return redirect()->back()->with('warning', 'Maaf saldo keuangan sekolah kurang dari nominal yang anda masukan pada kolom jumlah !');
        } else {
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
    }

    //function untuk masuk ke view edit
    public function edit($id_pengeluaran)
    {
        $pengeluaran = \App\Pengeluaran::find($id_pengeluaran);
        $data_kategori = \App\Kategori::where('jenis_kategori', 2)->get();
        return view('/keuangan/pengeluaran/editpengeluaran', compact('pengeluaran', 'data_kategori'));
    }
    public function update(Request $request, $id_pengeluaran)
    {
        //Menentukan saldo keuangan sekolah
        $total_pengeluaran = DB::table('pengeluaran')
            ->sum('pengeluaran.jumlah');
        $total_pemasukan = DB::table('pemasukan')
            ->sum('pemasukan.jumlah');
        $saldo = $total_pemasukan - $total_pengeluaran;

        $jumlah_pengeluaran = $request->input('jumlah');
        if ($jumlah_pengeluaran > $saldo) {
            return redirect()->back()->with('warning', 'Maaf saldo keuangan sekolah kurang dari nominal yang anda masukan pada kolom jumlah !');
        } else {
            $request->validate([
                'jumlah' => 'numeric',
                'keterangan' => 'min:10',
            ]);
            $pengeluaran = \App\Pengeluaran::find($id_pengeluaran);
            $pengeluaran->update($request->all());
            $pengeluaran->save();
            return redirect('/keuangan/pengeluaran/index')->with('sukses', 'Data Pengeluaran Berhasil Diedit');
        }
    }

    //function untuk hapus
    public function delete($id)
    {
        $pengeluaran = \App\Pengeluaran::find($id);
        $pengeluaran->delete();
        return redirect('/keuangan/pengeluaran/index')->with('sukses', 'Data Pengeluaran Berhasil Dihapus');
    }

    //KATEGORI PENGELUARAN
    //function untuk tambahkategori
    public function tambahkategori(Request $request)
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
        try {
            $kategori = \App\Kategori::find($id);
            $kategori->delete();
            return redirect('/keuangan/pengeluaran/index')->with('sukses', 'Data Kategori Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('warning', 'Maaf data tidak dapat dihapus, masih terdapat data pada tabel lain yang terpaut dengan data ini!');
        }
    }
}
