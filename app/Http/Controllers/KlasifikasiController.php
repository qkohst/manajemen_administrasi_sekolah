<?php

namespace App\Http\Controllers;

use App\Klasifikasi;
use App\Imports\KlasifikasiImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class KlasifikasiController extends Controller
{
    public function index()
    {
        $data_klasifikasi = \App\Klasifikasi::orderByRaw('kode ASC')->get();
        return view('klasifikasi.index', ['data_klasifikasi' => $data_klasifikasi]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        return view('klasifikasi/create');
    }

    //function untuk tambah
    public function tambah(Request $request)
    {
        $request->validate([
            'nama' => 'unique:klasifikasi|min:5',
            'kode' => 'unique:klasifikasi|max:2',
            'uraian' => 'min:5',
        ]);
        $klasifikasi = new Klasifikasi();
        $klasifikasi->nama   = $request->input('nama');
        $klasifikasi->kode   = $request->input('kode');
        $klasifikasi->uraian = $request->input('uraian');
        $klasifikasi->save();
        return redirect('/klasifikasi/index')->with("sukses", "Data Klasifikasi Berhasil Ditambahkan");
    }

    //function untuk masuk ke view edit
    public function edit($id_klasifikasi)
    {
        $klasifikasi = \App\Klasifikasi::find($id_klasifikasi);
        return view('klasifikasi/edit', ['klasifikasi' => $klasifikasi]);
    }
    public function update(Request $request, $id_klasifikasi)
    {
        $request->validate([
            'nama' => 'min:5',
            'kode' => 'max:2',
            'uraian' => 'min:5',
        ]);
        $klasifikasi = \App\Klasifikasi::find($id_klasifikasi);
        $klasifikasi->update($request->all());
        $klasifikasi->save();
        return redirect('klasifikasi/index')->with('sukses', 'Data Klasifikasi Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id_klasifikasi)
    {
        try {
            $klasifikasi = \App\Klasifikasi::find($id_klasifikasi);
            $klasifikasi->delete();
            return redirect('klasifikasi/index')->with('sukses', 'Data Klasifikasi Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('warning', 'Maaf data tidak dapat dihapus, masih terdapat data pada tabel lain yang terpaut dengan data ini!');
        }
    }
}
