<?php

namespace App\Http\Controllers;

use App\Pesdik;
use App\Rombel;
use App\Pesdikkeluar;
use App\Pesdikalumni;
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
                'nisn' => 'unique:pesdik|numeric|min:10',
                'induk' => 'unique:pesdik|numeric|min:2',
           ]);
           $pesdik = new Pesdik();
           $pesdik->nama     = $request->input('nama');
           $pesdik->jenis_kelamin = $request->input('jenis_kelamin');
           $pesdik->nisn          = $request->input('nisn');
           $pesdik->induk         = $request->input('induk');
           $pesdik->rombel_id     = $request->input('rombel');
           $pesdik->tempat_lahir    = $request->input('tempat_lahir');
           $pesdik->tanggal_lahir   = $request->input('tanggal_lahir');
           $pesdik->jenis_pendaftaran   = $request->input('jenis_pendaftaran');
           $pesdik->tanggal_masuk   = $request->input('tanggal_masuk');
           $pesdik->save();
           return redirect('/pesdik/index')->with("sukses", "Data Peserta Didik Berhasil Ditambahkan");
        }

         //function untuk masuk ke modal
        public function registrasi ($id_pesdik)
        {
            $pesdik = \App\Pesdik::find($id_pesdik);
            $data_rombel = \App\Rombel::all();
            return view('pesdik/registrasi',['pesdik'=>$pesdik],['data_rombel'=>$data_rombel]);
        }

        //function untuk registrasi keluar
        public function keluar(Request $request, $id_pesdik)
        {
            $request->validate([
                'alasan_keluar' => 'min:10',
           ]);
            $pesdik=\App\Pesdik::find($id_pesdik);
            $data_rombel = \App\Rombel::all();
            //deklarasi variabel
            $nama               = $pesdik->nama;
            $jenis_kelamin      = $pesdik->jenis_kelamin;
            $nisn               = $pesdik->nisn;
            $induk              = $pesdik->induk;
            $tempat_lahir       = $pesdik->tempat_lahir;
            $tanggal_lahir      = $pesdik->tanggal_lahir;
            $rombel_sebelumnya  = $pesdik->rombel->nama_rombel;
            $jenis_pendaftaran  = $pesdik->jenis_pendaftaran;
            $tanggal_masuk      = $pesdik->tanggal_masuk;

            $pesdikkeluar = new Pesdikkeluar();
            $pesdikkeluar->nama             = $nama;
            $pesdikkeluar->jenis_kelamin    = $jenis_kelamin;
            $pesdikkeluar->nisn             = $nisn;
            $pesdikkeluar->induk            = $induk;
            $pesdikkeluar->tempat_lahir     = $tempat_lahir;
            $pesdikkeluar->tanggal_lahir    = $tanggal_lahir;
            $pesdikkeluar->jenis_pendaftaran= $jenis_pendaftaran;
            $pesdikkeluar->tanggal_masuk    = $tanggal_masuk;
            $pesdikkeluar->rombel_sebelumnya= $rombel_sebelumnya;
            $pesdikkeluar->keluar_karena   = $request->input('keluar_karena');
            $pesdikkeluar->tanggal_keluar   = $request->input('tanggal_keluar');
            $pesdikkeluar->alasan_keluar   = $request->input('alasan_keluar');
            $pesdikkeluar->save();
            $pesdik->delete();
            return redirect('pesdik/index') ->with('sukses','Registrasi Peserta Didik Keluar, Berhasil');
        }
        
        //function untuk masuk ke view pesdik keluar
        public function keluarindex()
        {
            $data_pesdikkeluar = \App\Pesdikkeluar::all();
            return view('pesdik.keluarindex',['data_pesdikkeluar'=> $data_pesdikkeluar]);
        }

        //function untuk registrasi alumni
        public function alumni(Request $request, $id_pesdik)
        {
            $request->validate([
                'keterangan' => 'min:10',
           ]);
            $pesdik=\App\Pesdik::find($id_pesdik);

            //deklarasi variabel
            $nama               = $pesdik->nama;
            $jenis_kelamin      = $pesdik->jenis_kelamin;
            $nisn               = $pesdik->nisn;
            $induk              = $pesdik->induk;
            $tempat_lahir       = $pesdik->tempat_lahir;
            $tanggal_lahir      = $pesdik->tanggal_lahir;
            $jenis_pendaftaran  = $pesdik->jenis_pendaftaran;
            $tanggal_masuk      = $pesdik->tanggal_masuk;

            $pesdikalumni = new Pesdikalumni();
            $pesdikalumni->nama             = $nama;
            $pesdikalumni->jenis_kelamin    = $jenis_kelamin;
            $pesdikalumni->nisn             = $nisn;
            $pesdikalumni->induk            = $induk;
            $pesdikalumni->tempat_lahir     = $tempat_lahir;
            $pesdikalumni->tanggal_lahir    = $tanggal_lahir;
            $pesdikalumni->jenis_pendaftaran= $jenis_pendaftaran;
            $pesdikalumni->tanggal_masuk    = $tanggal_masuk;
            $pesdikalumni->tanggal_lulus   = $request->input('tanggal_lulus');
            $pesdikalumni->melanjutkan_ke   = $request->input('melanjutkan_ke');
            $pesdikalumni->keterangan   = $request->input('keterangan');
            $pesdikalumni->save();
            $pesdik->delete();
            return redirect('pesdik/index') ->with('sukses','Registrasi Peserta Didik Lulus, Berhasil');
        }

        //function untuk masuk ke view pesdik alumni
        public function alumniindex()
        {
            $data_pesdikalumni = \App\Pesdikalumni::all();
            return view('pesdik.alumniindex',['data_pesdikalumni'=> $data_pesdikalumni]);
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
                'nisn' => 'numeric|min:10',
                'induk' => 'numeric|min:2',
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
