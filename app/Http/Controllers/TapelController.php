<?php

namespace App\Http\Controllers;

use App\Tapel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TapelController extends Controller
{
    public function index()
    {
        $data_tapel = \App\Tapel::all();
        return view('tapel.index', ['data_tapel' => $data_tapel]);
    }

    //function untuk tambah
    public function tambah(Request $request)
    {
        $request->validate([
            'tahun' => '',
        ]);
        $tapel = new Tapel();
        $tapel->tahun   = $request->input('tahun');
        $tapel->semester   = $request->input('semester');
        $tapel->save();
        return redirect('/tapel/index')->with("sukses", "Data Tahun Pelajaran Berhasil Ditambahkan");
    }

    //function untuk masuk ke view edit
    public function edit($id_tapel)
    {
        $tapel = \App\Tapel::find($id_tapel);
        return view('tapel/edit', ['tapel' => $tapel]);
    }
    public function update(Request $request, $id_tapel)
    {
        $request->validate([
            'tahun' => 'min:9|max:9',
        ]);
        $tapel = \App\Tapel::find($id_tapel);
        $tapel->update($request->all());
        $tapel->save();
        return redirect('tapel/index')->with('sukses', 'Data Tahun Pelajaran Berhasil Diedit');
    }
    //function untuk hapus
    public function delete($id)
    {
        try {
            $tapel = \App\Tapel::find($id);
            $tapel->delete();
            return redirect('tapel/index')->with('sukses', 'Data Tahun Pelajaran Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('warning', 'Maaf data tidak dapat dihapus, masih terdapat data pada tabel lain yang terpaut dengan data ini!');
        }
    }
}
