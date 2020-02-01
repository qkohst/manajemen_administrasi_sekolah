<?php

namespace App\Http\Controllers;
use App\Suratmasuk;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Auth;

class SuratmasukController extends Controller
{
    public function index()
    {
        $data_suratmasuk = \App\Suratmasuk::all();
        return view('suratmasuk.index',['data_suratmasuk'=> $data_suratmasuk]);
    }

    //function untuk masuk ke view Tambah
    public function create()
    {
        $data_klasifikasi = \App\Klasifikasi::all();
        return view('suratmasuk/create', ['data_klasifikasi' => $data_klasifikasi]);
    }

    //function untuk tambah
     public function tambah (Request $request)
     {
        $request->validate([
            'filemasuk' => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'no_surat' => 'unique:suratmasuk|min:5',
            'isi' => 'min:5',
            'keterangan' => 'min:5',
        ]);
        $suratmasuk = new Suratmasuk();
        $suratmasuk->no_surat   = $request->input('no_surat');
        $suratmasuk->asal_surat = $request->input('asal_surat');
        $suratmasuk->isi        = $request->input('isi');
        $suratmasuk->kode       = $request->input('kode');
        $suratmasuk->tgl_surat  = $request->input('tgl_surat');
        $suratmasuk->tgl_terima = $request->input('tgl_terima');
        $suratmasuk->keterangan = $request->input('keterangan');
        $file                   = $request->file('filemasuk');
        $fileName   = 'suratMasuk-'. $file->getClientOriginalName();
        $file->move('datasuratmasuk/', $fileName);
        $suratmasuk->filemasuk  = $fileName;
        $suratmasuk->users_id = Auth::id();
        $suratmasuk->save();
        return redirect('/suratmasuk/index')->with("sukses", "Data Surat Masuk Berhasil Ditambahkan");

     }

    //function untuk melihat file
    public function tampil($id_suratmasuk)
    {
        $suratmasuk = \App\Suratmasuk::find($id_suratmasuk);
        return view('suratmasuk/tampil',['suratmasuk'=>$suratmasuk]);
    }

    //function untuk download file
    public function downfunc(){

        $downloads=DB::table('suratmasuk')->get();
        return view('suratmasuk.tampil',compact('downloads'));
    }

    //function untuk masuk ke view edit
    public function edit ($id_suratmasuk)
    {
        $data_klasifikasi = \App\Klasifikasi::all();
        $suratmasuk = \App\Suratmasuk::find($id_suratmasuk);
        return view('suratmasuk/edit',['suratmasuk'=>$suratmasuk],['data_klasifikasi'=>$data_klasifikasi]);
    }
    public function update (Request $request, $id_suratmasuk)
    {
        $request->validate([
            'filemasuk' => 'mimes:jpg,jpeg,png,doc,docx,pdf',
            'no_surat' => 'min:5',
            'isi' => 'min:5',
            'keterangan' => 'min:5',
        ]);
        $suratmasuk = \App\Suratmasuk::find($id_suratmasuk);
        $suratmasuk->update($request->all());
        //Untuk Update File
        if($request->hasFile('filemasuk')){
            $request->file('filemasuk')->move('datasuratmasuk/','suratMasuk-'. $request->file('filemasuk')->getClientOriginalName());
            $suratmasuk->filemasuk = 'suratMasuk-'. $request->file('filemasuk')->getClientOriginalName();
            $suratmasuk->save();
        }
        return redirect('suratmasuk/index') ->with('sukses','Data Surat Masuk Berhasil Diedit');
    }

    //function untuk hapus
    public function delete($id_suratmasuk)
    {
        $suratmasuk=\App\Suratmasuk::find($id_suratmasuk);
        $suratmasuk->delete();
        return redirect('suratmasuk/index') ->with('sukses','Data Surat Masuk Berhasil Dihapus');
    }


    //Function Untuk Agenda Surat Masuk
    public function agenda(Request $request)
    {
        $data_suratmasuk = \App\Suratmasuk::all();
       return view('suratmasuk.agenda',['data_suratmasuk'=> $data_suratmasuk]);
    }

    //Function Untuk Download Agenda Surat Masuk
    public function agendamasukcetak_pdf()
    {
        $suratmasuk = Suratmasuk::all();
        $pdf = PDF::loadview('suratmasuk.cetakagendaPDF',['suratmasuk'=>$suratmasuk]);
        return $pdf->download('AgendaSuratMasuk.pdf');
    }

    //Function Untuk Agenda Surat Masuk
    public function galeri(Request $request)
    {
        $data_suratmasuk = \App\Suratmasuk::all();
       return view('suratmasuk.galeri',['data_suratmasuk'=> $data_suratmasuk]);
    }
}
