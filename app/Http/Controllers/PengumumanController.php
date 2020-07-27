<?php

namespace App\Http\Controllers;

use App\Pengumuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    public function index()
    {
        $data_pengumuman = \App\Pengumuman::orderByRaw('created_at DESC')->get();
        return view('pengumuman.index',['data_pengumuman'=> $data_pengumuman]);
    }

    //function untuk tambah
    public function tambah (Request $request)
    {
       $request->validate([
           'judul'  => 'min:5|max:50',
           'isi_pengumuman'    => 'min:10',
       ]);
       $pengumuman = new Pengumuman();
       $pengumuman->judul   = $request->input('judul');
       $pengumuman->isi     = $request->input('isi_pengumuman');
       $pengumuman->users_id = Auth::id();
       $pengumuman->save();
       return redirect('/pengumuman/index')->with("sukses", "Pengumuman Baru Berhasil Diposting");

    }
    //function untuk masuk ke view edit
    public function edit ($id_pengumuman)
    {
        $pengumuman = \App\Pengumuman::find($id_pengumuman);
        return view('pengumuman/edit',['pengumuman'=>$pengumuman]);
    }
    public function update (Request $request, $id_pengumuman)
    {
            $request->validate([
                'judul'  => 'min:5|max:50',
                'isi_pengumuman'    => 'min:10',
            ]);
            $pengumuman = \App\Pengumuman::find($id_pengumuman);
            $pengumuman->judul   = $request->input('judul');
            $pengumuman->isi     = $request->input('isi_pengumuman');
            $pengumuman->update($request->all());
            $pengumuman->save();
            return redirect('pengumuman/index') ->with('sukses','Data Pengumuman Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id_pengumuman)
    {
        $pengumuman=\App\Pengumuman::find($id_pengumuman);
        $pengumuman->delete();
        return redirect('pengumuman/index') ->with('sukses','Data Pengumuman Berhasil Dihapus');
    }

}
