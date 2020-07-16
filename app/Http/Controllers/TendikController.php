<?php

namespace App\Http\Controllers;

use App\Tendik;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class TendikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_tendik = \App\Tendik::orderByRaw('nama ASC')->get();
        return view('tendik.index', ['data_tendik' => $data_tendik]);
    }

    //function untuk tambah
    public function tambah(Request $request)
    {
        $request->validate([
            'nama' => 'min:5',
            'tempat_lahir' => 'min:5',
            'alamat' => 'min:10',
            'no_hp' => 'unique:tendik|min:12|max:13',
            'email' => 'required|unique:tendik|email',
        ]);
        //Menambah data ke table Tendik
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

        //Menambah acoun user dengan role petugas sesuai tugas
        $pengguna = User::create([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('no_hp')),
            'role' => $request->input('tugas'),
        ]);
        return redirect('/tendik/index')->with("sukses", "Data Tenaga Kependidikan Berhasil Ditambahkan, PTK bisa login ke sistem dengan menggunakan email sesuai yang  didaftarkan dan password menggunakan nomor HP !");
    }

    //function untuk masuk ke view edit
    public function edit($id_tendik)
    {
        $tendik = \App\Tendik::find($id_tendik);
        return view('tendik/edit', ['tendik' => $tendik]);
    }
    public function update(Request $request, $id_tendik)
    {
        $request->validate([
            'nama' => 'min:5',
            'tempat_lahir' => 'min:5',
            'alamat' => 'min:10',
            'no_hp' => 'min:12|max:13',
            'email' => 'email',
        ]);
        $tendik = \App\Tendik::find($id_tendik);
        $tendik->update($request->all());
        $tendik->save();
        return redirect('tendik/index')->with('sukses', 'Data Tenaga Kependidikan Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id)
    {
        try {
            $tendik = \App\Tendik::find($id);
            $tendik->delete();
            return redirect('tendik/index')->with('sukses', 'Data Tenaga Kependidikan Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('warning', 'Maaf data tidak dapat dihapus, masih terdapat data pada tabel lain yang terpaut dengan data ini!');
        }
    }
}
