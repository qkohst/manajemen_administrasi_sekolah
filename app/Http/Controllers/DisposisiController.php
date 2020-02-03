<?php

namespace App\Http\Controllers;

use App\Disposisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disp = Disposisi::all();
        return view('disposisi.index', compact('disp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('disposisi.create');
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
            'tujuan'        => 'required',
            'isi'           => 'required',
            'sifat'         => 'required',
            'batas_waktu'   => 'required',
            'catatan'       => 'required',
        ]);

        $disp = Disposisi::create([
            'tujuan'        => $request->tujuan,
            'isi'           => $request->isi,
            'sifat'         => $request->sifat,
            'batas_waktu'   => $request->batas_waktu,
            'catatan'       => $request->catatan,
            'users_id'      => Auth::id(),

        ]);

        return redirect()->route('disposisi.index')->with('sukses','Disposisi berhasil di Simpan');
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
        $disp = Disposisi::findorfail($id);
        return view('disposisi.edit', compact('disp'));
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
        $disp = Disposisi::findorfail($id);

        $this->validate($request, [
            'tujuan'        => 'required',
            'isi'           => 'required',
            'sifat'         => 'required',
            'batas_waktu'   => 'required',
            'catatan'       => 'required',
        ]);

        $disp_data = [
            'tujuan'        => $request->tujuan,
            'isi'           => $request->isi,
            'sifat'         => $request->sifat,
            'batas_waktu'   => $request->batas_waktu,
            'catatan'       => $request->catatan,
            'users_id'      => Auth::id(),
        ];

        $disp->update($disp_data);

        return redirect()->route('disposisi.index')->with('sukses','Disposisi berhasil di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disp = Disposisi::findorfail($id);
        $disp->delete();

        return redirect()->back()->with('sukses','Disposisi Berhasil di Hapus');
    }
}
