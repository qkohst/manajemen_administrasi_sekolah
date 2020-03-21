<?php

namespace App\Http\Controllers;

use App\Setor;
use App\Pesdik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SetorController extends Controller
{
    public function index()
    {
        $data_setor = \App\Setor::all();
        $data_pesdik = \App\Pesdik::all();
        return view('/tabungan/setor/index', compact('data_setor','data_pesdik'));
    }

     //function untuk tambah
     public function tambah (Request $request)
     {
         $request->validate([
             'jumlah' => 'numeric',
         ]);
        $setor = new Setor();
        $setor->pesdik_id           = $request->input('pesdik_id');
        $setor->tanggal             = $request->input('tanggal');
        $setor->jumlah              = $request->input('jumlah');
        $setor->keterangan          = $request->input('keterangan');
        $setor->users_id            = Auth::id();
        $setor->save();
        return redirect('/tabungan/setor/index')->with("sukses", "Data Setor Tunai Berhasil Ditambahkan");
     }

      //function untuk masuk ke view edit
      public function edit ($id_setor)
      {
          $setor = \App\Setor::find($id_setor);
          return view('/tabungan/setor/edit', compact('setor'));
      }
      public function update (Request $request, $id_setor)
      {
          $request->validate([
             'jumlah' => 'numeric',
          ]);
          $setor = \App\Setor::find($id_setor);
          $setor->update($request->all());
          $setor->save();
          return redirect('/tabungan/setor/index') ->with('sukses','Data Setor Tunai Berhasil Diedit');
      }

    //function untuk hapus
    public function delete($id)
    {
        $setor=\App\Setor::find($id);
        $setor->delete();
        return redirect('/tabungan/setor/index') ->with('sukses','Data Setor Tunai Berhasil Dihapus');
    }

     //function untuk masuk ke view cetak
     public function cetak ($id_setor)
     {
         $setor = \App\Setor::find($id_setor);
         return view('/tabungan/setor/cetak', compact('setor'));
     }

     //function untuk masuk ke view cetak
     public function cetakprint ($id_setor)
     {
         $setor = \App\Setor::find($id_setor);
         return view('/tabungan/setor/cetakprint', compact('setor'));
     }
}
