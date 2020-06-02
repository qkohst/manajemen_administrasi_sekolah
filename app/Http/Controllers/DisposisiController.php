<?php

namespace App\Http\Controllers;

use App\Disposisi;
use App\SuratMasuk;
use App\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class DisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SuratMasuk $suratmasuk)
    {
        $smasuk = $suratmasuk->findorfail($suratmasuk->id);
        $disp = DB::select('select * from disposisis where suratmasuk_id = ?', [$suratmasuk->id]);
        return view('disposisi.index', compact('smasuk','disp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SuratMasuk $suratmasuk)
    {
        $smasuk = $suratmasuk->findorfail($suratmasuk->id);
        return view('disposisi.create', compact('smasuk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SuratMasuk $suratmasuk)
    {
        $smasuk = $suratmasuk->findorfail($suratmasuk->id);
        $this->validate($request, [
            'tujuan'        => 'required|min:5',
            'isi'           => 'required|min:5',
            'sifat'         => 'required|min:5',
            'batas_waktu'   => 'required',
            'catatan'       => 'required|min:5',
        ]);

        $disp = Disposisi::create([
            'tujuan'          => $request->tujuan,
            'isi'             => $request->isi,
            'sifat'           => $request->sifat,
            'batas_waktu'     => $request->batas_waktu,
            'catatan'         => $request->catatan,
            'users_id'        => Auth::id(),
            'suratmasuk_id'   => $suratmasuk->id,
        ]);

        return redirect()->route('disposisi.index', compact('smasuk'))->with('sukses','Data disposisi berhasil ditambahkan');
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
    public function edit(SuratMasuk $suratmasuk, $id)
    {
        $smasuk = $suratmasuk->findorfail($suratmasuk->id);
        $disp = Disposisi::findorfail($id);
        return view('disposisi.edit', compact('disp','smasuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuratMasuk $suratmasuk, $id)
    {
        $smasuk = $suratmasuk->findorfail($suratmasuk->id);
        $disp = Disposisi::findorfail($id);
        $this->validate($request, [
            'tujuan'        => 'required|min:5',
            'isi'           => 'required|min:5',
            'sifat'         => 'required|min:5',
            'batas_waktu'   => 'required',
            'catatan'       => 'required|min:5',
        ]);

        $disp_data = [
            'tujuan'        => $request->tujuan,
            'isi'           => $request->isi,
            'sifat'         => $request->sifat,
            'batas_waktu'   => $request->batas_waktu,
            'catatan'       => $request->catatan,
            'users_id'      => Auth::id(),
            'smasuk_id'     => $suratmasuk->id,
        ];

        $disp->update($disp_data);

        return redirect()->route('disposisi.index', compact('smasuk'))->with('sukses','Data disposisi berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuratMasuk $suratmasuk, $id)
    {
        $smasuk = $suratmasuk->findorfail($suratmasuk->id);
        $disp = Disposisi::findorfail($id);
        $disp->delete();

        return redirect()->route('disposisi.index', compact('smasuk'))->with('sukses','Data disposisi telah dihapus');
    }

    public function download(SuratMasuk $suratmasuk, $id)
    {
        $inst = Instansi::first();
        $smasuk = $suratmasuk->findorfail($suratmasuk->id);
        $disp = Disposisi::findorfail($id);
        return view('/disposisi/download', compact('inst', 'smasuk', 'disp'));
    }
}
