<?php

namespace App\Http\Controllers;

use App\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Instansi $instansi)
    {
        $instansi = Instansi::all();
        return view('instansi.index', compact('instansi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instansi.create');
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
            'nama'     => 'required',
            'pimpinan' => 'required',
            'file'     => 'file|mimes:jpeg,png|max:2048',
        ]);

        $filelogo = $request->file;
        $newlogo = time().$filelogo->getClientOriginalName();

        $ins = Instansi::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'pimpinan' => $request->pimpinan,
            'email' => $request->email,
            'file' => 'uploads/logo/'.$newlogo,
        ]);

        $filelogo->move('uploads/logo/', $newlogo);
        return redirect()->route('instansi.index')->with('sukses','Data Instansi Berhasil Disimpan');

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
        $instansi= Instansi::findorfail($id);
        return view('instansi.edit', compact('instansi'));
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
        $this->validate($request, [
            'nama' => 'required',
            'pimpinan' => 'required',
            'email' => 'email|required',
            'file' => 'file|mimes:jpeg,png|max:2048',
        ]);

        $post = Instansi::findorfail($id);

        if ($request->has('file')) {
            $filelogo = $request->file;
            $newlogo = time().$filelogo->getClientOriginalName();
            $filelogo->move('uploads/logo/', $newlogo);

            $post_data = [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'pimpinan' => $request->pimpinan,
                'email' => $request->email,
                'file' => 'uploads/logo/'.$newlogo,
            ];
        } else {
            $post_data = [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'pimpinan' => $request->pimpinan,
                'email' => $request->email,
            ];
        }

        $post->update($post_data);

        return redirect()->route('instansi.index')->with('sukses','Data Instansi Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
