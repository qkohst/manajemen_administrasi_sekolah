<?php

namespace App\Http\Controllers;

use App\Setor;
use App\Pesdik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SetorController extends Controller
{
    public function index()
    {
        $data_setor = \App\Setor::orderByRaw('created_at DESC')->get();
        $data_pesdik = \App\Pesdik::orderByRaw('nama ASC')->get();
        return view('/tabungan/setor/index', compact('data_setor', 'data_pesdik'));
    }

    //function untuk tambah
    public function tambah(Request $request)
    {
        $pilih_pesdik = $request->input('pesdik_id');
        //Mengambil nilai rombel id
        $pesdik = \App\Pesdik::select('rombel_id')->where('id', $pilih_pesdik)->get();
        $data = $pesdik->first();
        $rombel_id = $data->rombel_id;

        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $data_setor = new Setor();
        $data_setor->pesdik_id           = $pilih_pesdik;
        $data_setor->rombel_id           = $rombel_id;
        $data_setor->tanggal             = $request->input('tanggal');
        $data_setor->jumlah              = $request->input('jumlah');
        $data_setor->keterangan          = $request->input('keterangan');
        $data_setor->users_id            = Auth::id();
        $data_setor->save();
        $setor = \App\Setor::find($data_setor->id);
        return view('/tabungan/setor/cetak', compact('setor'));
    }

    //function untuk masuk ke view edit
    public function edit($id_setor)
    {
        $setor = \App\Setor::find($id_setor);
        return view('/tabungan/setor/edit', compact('setor'));
    }
    public function update(Request $request, $id_setor)
    {
        $request->validate([
            'jumlah' => 'numeric',
        ]);
        $setor = \App\Setor::find($id_setor);
        $setor->update($request->all());
        $setor->save();
        return redirect('/tabungan/setor/index')->with('sukses', 'Data Setor Tunai Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id)
    {
        $setor = \App\Setor::find($id);
        $setor->delete();
        return redirect('/tabungan/setor/index')->with('sukses', 'Data Setor Tunai Berhasil Dihapus');
    }

    //function untuk masuk ke view cetak
    public function cetak($id_setor)
    {
        $setor = \App\Setor::find($id_setor);
        return view('/tabungan/setor/cetak', compact('setor'));
    }

    //function untuk masuk ke view cetak
    public function cetakprint($id_setor)
    {
        $setor = \App\Setor::find($id_setor);
        return view('/tabungan/setor/cetakprint', compact('setor'));
    }

    public function siswaindex($id)
    {
        $pesdik = \App\Pesdik::where('id', $id)->get();
        $id_pesdik_login = $pesdik->first();

        $data_pesdik = \App\Pesdik::where('id', $id)->get();
        $data_setor = \App\Setor::where('pesdik_id', $id)->orderByRaw('created_at DESC')->get();
        return view('/tabungan/setor/siswaindex', compact('data_pesdik', 'data_setor', 'id_pesdik_login'));
    }
}
