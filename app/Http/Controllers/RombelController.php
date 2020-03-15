<?php

namespace App\Http\Controllers;

use App\Rombel;
use App\Pesdik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_rombel = \App\Rombel::all();
        $data_guru = \App\Guru::all();
        return view('rombel.index',['data_rombel'=> $data_rombel],['data_guru'=>$data_guru]);
    }

    //function untuk tambah
    public function tambah (Request $request)
    {
        $request->validate([
            'nama_rombel' => 'unique:rombel|min:3',
            'wali_kelas' => 'unique:rombel',
        ]);
       $rombel = new Rombel();
       $rombel->kelas   = $request->input('kelas');
       $rombel->nama_rombel   = $request->input('nama_rombel');
       $rombel->wali_kelas   = $request->input('wali_kelas');
       $rombel->save();
       return redirect('/rombel/index')->with("sukses", "Data Rombongan Belajar Berhasil Ditambahkan");
    }

     //function untuk anggota Rombel
    public function anggota($nama_rombel)
    {
        $data_pesdik = \App\Pesdik::where('rombel',$nama_rombel)->get();
        return view('rombel.anggota',['data_pesdik'=> $data_pesdik]);
    }

     //function untuk masuk ke view edit
    public function edit ($id_rombel)
    {
        $rombel = \App\Rombel::find($id_rombel);
        $data_guru = \App\Guru::all();
        return view('rombel/edit',['rombel'=>$rombel],['data_guru'=>$data_guru]);
    }
    public function update (Request $request, $id_rombel)
    {
        $request->validate([
            'nama_rombel' => 'min:3',
        ]);
        $rombel = \App\Rombel::find($id_rombel);
        $rombel->update($request->all());
        $rombel->save();
        return redirect('rombel/index') ->with('sukses','Data Rombongan Belajar Berhasil Diedit');
    }
     //function untuk hapus
     public function delete($id)
     {
         $rombel=\App\Rombel::find($id);
         $rombel->delete();
         return redirect('rombel/index') ->with('sukses','Data Rombongan Belajar Berhasil Dihapus');
     }
}
