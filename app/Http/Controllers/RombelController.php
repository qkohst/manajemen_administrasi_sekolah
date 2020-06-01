<?php

namespace Laravel\Http\Controllers;

use Laravel\Rombel;
use Laravel\Pesdik;
use Laravel\Tapel;
use Laravel\Anggotarombel;
use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_rombel = \Laravel\Rombel::all();
        $data_guru = \Laravel\Guru::all();
        $data_tapel = \Laravel\Tapel::all();
        return view('rombel.index', compact('data_rombel','data_guru','data_tapel'));
    }

    //function untuk tambah
    public function tambah (Request $request)
    {
        $request->validate([
            'nama_rombel' => 'min:3',
        ]);
       $rombel = new Rombel();
       $rombel->tapel_id   = $request->input('tapel_id');
       $rombel->kelas   = $request->input('kelas');
       $rombel->nama_rombel   = $request->input('nama_rombel');
       $rombel->wali_kelas   = $request->input('wali_kelas');
       $rombel->save();
       return redirect('/rombel/index')->with("sukses", "Data Rombongan Belajar Berhasil Ditambahkan");
    }

     //function untuk anggota Rombel
    public function anggota($id_rombel)
    {  
        $data_anggota = \Laravel\Anggotarombel::where('rombel_id',$id_rombel)->get();
        return view('rombel.anggota',['data_anggota'=> $data_anggota]);
    }

     //function untuk masuk ke view edit
    public function edit ($id_rombel)
    {
        $rombel = \Laravel\Rombel::find($id_rombel);
        $data_guru = \Laravel\Guru::all();
        $data_tapel = \Laravel\Tapel::all();
        return view('rombel/edit', compact('rombel','data_guru','data_tapel'));
    }
    public function update (Request $request, $id_rombel)
    {
        $request->validate([
            'nama_rombel' => 'min:3',
        ]);
        $rombel = \Laravel\Rombel::find($id_rombel);
        $rombel->update($request->all());
        $rombel->save();
        return redirect('rombel/index') ->with('sukses','Data Rombongan Belajar Berhasil Diedit');
    }
     //function untuk hapus
     public function delete($id)
     {
         $rombel=\Laravel\Rombel::find($id);
         $rombel->delete();
         return redirect('rombel/index') ->with('sukses','Data Rombongan Belajar Berhasil Dihapus');
     }
}
