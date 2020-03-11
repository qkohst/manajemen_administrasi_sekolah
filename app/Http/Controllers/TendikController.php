<?php

namespace App\Http\Controllers;

use App\Tendik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TendikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_tendik = \App\Tendik::all();
        return view('tendik.index',['data_tendik'=> $data_tendik]);
    }

   //function untuk tambah
   public function tambah (Request $request)
   {
       $request->validate([
           'nama' => 'min:5',
           'tempat_lahir' => 'min:5',
           'alamat' => 'min:10',
           'no_hp' => 'unique:tendik|min:12',
           'email' => 'required|unique:tendik|email',
       ]);
      $tendik = new Tendik();
      $tendik->nama   = $request->input('nama');
      $tendik->jenis_kelamin   = $request->input('jk');
      $tendik->tempat_lahir   = $request->input('tempatlahir');
      $tendik->tanggal_lahir   = $request->input('tgllahir');
      $tendik->alamat = $request->input('alamat');
      $tendik->no_hp = $request->input('no_hp');
      $tendik->email = $request->input('email');
      $tendik->tugas = $request->input('tugas');
      $tendik->save();
      return redirect('/tendik/index')->with("sukses", "Data Tenaga Kependidikan Berhasil Ditambahkan");
   }

    //function untuk masuk ke view edit
    public function edit ($id_tendik)
    {
        $tendik = \App\Tendik::find($id_tendik);
        return view('tendik/edit',['tendik'=>$tendik]);
    }
    public function update (Request $request, $id_tendik)
    {
        $request->validate([
            'nama' => 'min:5',
            'tempat_lahir' => 'min:5',
            'alamat' => 'min:10',
            'no_hp' => 'min:12',
            'email' => 'email',
        ]);
        $tendik = \App\Tendik::find($id_tendik);
        $tendik->update($request->all());
        $tendik->save();
        return redirect('tendik/index') ->with('sukses','Data Tenaga Kependidikan Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id)
    {
        $tendik=\App\Tendik::find($id);
        $tendik->delete();
        return redirect('tendik/index') ->with('sukses','Data Tenaga Kependidikan Berhasil Dihapus');
    }
}
