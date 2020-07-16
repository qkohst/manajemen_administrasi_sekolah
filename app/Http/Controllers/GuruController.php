<?php

namespace App\Http\Controllers;

use App\Guru;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_guru = \App\Guru::orderByRaw('nama ASC')->get();
        return view('guru.index', ['data_guru' => $data_guru]);
    }

    //function untuk tambah
    public function tambah(Request $request)
    {
        $request->validate([
            'nama' => 'min:5',
            'tempat_lahir' => 'min:5',
            'alamat' => 'min:10',
            'no_hp' => 'unique:guru|min:12|max:13',
            'email' => 'required|unique:guru|email',
        ]);

        //Menambah data ke table guru
        $guru = new Guru();
        $guru->nama   = $request->input('nama');
        $guru->jenis_kelamin   = $request->input('jk');
        $guru->tempat_lahir   = $request->input('tempatlahir');
        $guru->tanggal_lahir   = $request->input('tgllahir');
        $guru->alamat = $request->input('alamat');
        $guru->no_hp = $request->input('no_hp');
        $guru->email = $request->input('email');
        $guru->save();

        // //Menambah acount user dengan role guru
        // $role="Guru";
        // $pengguna = User::create([
        //     'name' => $request->input('nama'),
        //     'email' => $request->input('email'),
        //     'password' => Hash::make($request->input('no_hp')),
        //     'role' => $role,
        // ]);
        return redirect('/guru/index')->with("sukses", "Data Guru Berhasil Ditambahkan");
    }
    //function untuk masuk ke view edit
    public function edit($id_guru)
    {
        $guru = \App\Guru::find($id_guru);
        return view('guru/edit', ['guru' => $guru]);
    }
    public function update(Request $request, $id_guru)
    {
        $request->validate([
            'nama' => 'min:5',
            'tempat_lahir' => 'min:5',
            'alamat' => 'min:10',
            'no_hp' => 'min:12|max:13',
            'email' => 'email',
        ]);
        $guru = \App\Guru::find($id_guru);
        $guru->update($request->all());
        $guru->save();
        return redirect('guru/index')->with('sukses', 'Data Guru Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id)
    {
        try {
            $guru = \App\Guru::find($id);
            $guru->delete();
            return redirect('guru/index')->with('sukses', 'Data Guru Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('warning', 'Maaf data  tidak dapat dihapus, masih terdapat data pada tabel lain yang terpaut dengan data ini !');
        }
    }
}
