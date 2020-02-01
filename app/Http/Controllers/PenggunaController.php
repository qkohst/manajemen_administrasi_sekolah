<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $data_pengguna = \App\User::all();
        return view('pengguna.index',['data_pengguna'=> $data_pengguna]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        return view('pengguna/create');
    }

    //Function untuk tambah
    public function tambah (Request $request)
    {
        $request->validate([
            'name' => 'unique:users|min:5',
            'email' => 'unique:users',
        ]);
        $hash = Hash::make($request->input('password'));
        $pengguna = new User();
        $pengguna->name         = $request->input('name');
        $pengguna->email        = $request->input('email');
        $pengguna->password     = $hash;
        $pengguna->role         = $request->input('role');
        $pengguna->save();
        return redirect('/pengguna/index')->with("sukses", "Data Pengguna Berhasil Ditambahkan");
    }

    //Function untuk Update
    public function edit ($id)
    {
        $pengguna = \App\User::find($id);
        return view('pengguna/edit',['pengguna'=>$pengguna]);
    }
    public function update (Request $request, $id)
    {
        $pengguna = \App\User::find($id);
        $pengguna->update($request->all());
        $pengguna->save();
        return redirect('pengguna/index') ->with('sukses','Data Pengguna Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id)
    {
        $pengguna=\App\User::find($id);
        $pengguna->delete();
        return redirect('pengguna/index') ->with('sukses','Data Pengguna Berhasil Dihapus');
    }
}
