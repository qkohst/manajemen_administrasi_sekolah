<?php

namespace App\Http\Controllers;

use App\Pesdik;
use App\Rombel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PesdikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_pesdik = \App\Pesdik::all();
        return view('pesdik.index',['data_pesdik'=> $data_pesdik]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        $data_pesdik = \App\Pesdik::all();
        $data_rombel = \App\Rombel::all();
        return view('pesdik.create', ['data_pesdik' => $data_pesdik],['data_rombel'=>$data_rombel]);
    }

        //function untuk tambah
        public function tambah (Request $request)
        {
           $request->validate([
                'nama' => 'min:5',
                'nisn' => 'unique:pesdik|min:5',
                'iduk' => 'unique:pesdik|min:5',
           ]);
           $pesdik = new Pesdik();
           $pesdik->nama     = $request->input('nama');
           $pesdik->jenis_kelamin = $request->input('jenis_kelamin');
           $pesdik->nisn          = $request->input('nisn');
           $pesdik->induk         = $request->input('induk');
           $pesdik->rombel    = $request->input('rombel');
           $pesdik->tempat_lahir    = $request->input('tempat_lahir');
           $pesdik->tanggal_lahir   = $request->input('tanggal_lahir');
           $pesdik->jenis_pendaftaran   = $request->input('jenis_pendaftaran');
           $pesdik->tanggal_masuk   = $request->input('tanggal_masuk');
           $pesdik->save();
           return redirect('/pesdik/index')->with("sukses", "Data Peserta Didik Berhasil Ditambahkan");
        }

         //function untuk masuk ke view edit
        public function edit ($id_pesdik)
        {
            $pesdik = \App\Pesdik::find($id_pesdik);
            $data_rombel = \App\Rombel::all();
            return view('pesdik/edit',['pesdik'=>$pesdik],['data_rombel'=>$data_rombel]);
        }
        public function update (Request $request, $id_pesdik)
        {
            $request->validate([
                'nama' => 'min:5',
                'nisn' => 'min:5',
                'iduk' => 'min:5',
            ]);
            $pesdik = \App\Pesdik::find($id_pesdik);
            $pesdik->update($request->all());
            $pesdik->save();
            return redirect('pesdik/index') ->with('sukses','Data Rombongan Belajar Berhasil Diedit');
        }

        //function untuk hapus
        public function delete($id_pesdik)
        {
            $pesdik=\App\Pesdik::find($id_pesdik);
            $pesdik->delete();
            return redirect('pesdik/index') ->with('sukses','Data Peserta Didik Berhasil Dihapus');
        }
}
