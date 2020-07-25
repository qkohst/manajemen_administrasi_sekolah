<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $pengguna)
    {
        $data_pengguna = $pengguna->orderByRaw('name ASC')->get();
        return view('pengguna.index', compact('data_pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users|min:5',
            'email' => 'required|unique:users|email',
        ]);

        $pengguna = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
            'role' => $request->role,
        ]);

        return redirect()->route('pengguna.index')->with('sukses', 'Data administrator berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_pengguna = User::findorfail($id);
        return view('pengguna.edit', compact('data_pengguna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pengguna = User::findorfail($id);

        $this->validate($request, [
            'name' => 'required|min:5',
            'password' => 'required|min:6',
        ]);

        $data_pengguna = [
            'name' => $request->name,
            'password' => Hash::make($request->input('password')),
        ];

        $pengguna->update($data_pengguna);

        return redirect()->route('pengguna.index')->with('sukses', 'Data pengguna berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pengguna = User::findorfail($id);
            $pengguna->delete();

            return redirect()->route('pengguna.index')->with('sukses', 'Data pengguna berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with('warning', 'Maaf data pengguna tidak dapat dihapus, masih terdapat data yang terpaut dengan data pengguna !');
        }
    }
}
