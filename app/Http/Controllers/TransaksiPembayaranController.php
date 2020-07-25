<?php

namespace App\Http\Controllers;


use App\TransaksiPembayaran;
use App\Pemasukan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransaksiPembayaranController extends Controller
{
    public function index()
    {
        $data_pesdik = \App\Pesdik::orderByRaw('nama ASC')->get();
        return view('/pembayaran/transaksipembayaran/index', compact('data_pesdik'));
    }

    public function cari_pesdik(Request $request)
    {
        $cari = $request->input('cari_pesdik');
        $data_pesdik = \App\Pesdik::orderByRaw('nama ASC')->get();
        $identitas_pendik = \App\Pesdik::where('id', $cari)->first();

        //Mencari Data Tagihan Per Siswa
        $pesdik_pilih = \App\Anggotarombel::select('rombel_id')->where('pesdik_id', $cari)->get();
        $pesdik_jk = \App\Pesdik::select('jenis_kelamin')->where('id', $cari)->first();
        $pilih_jk =  \App\Tagihan::whereIn('jenis_kelamin', $pesdik_jk)->orWhere('jenis_kelamin', 'Semua')->get();

        $id_tagihan_terbayar = \App\TransaksiPembayaran::select('tagihan_id')->where('pesdik_id', $cari)->get();
        $tagihan_siswa = \App\Tagihan::whereIn('rombel_id', $pesdik_pilih)->whereNotIn('id', $id_tagihan_terbayar)
            ->WhereIn('jenis_kelamin', $pilih_jk)->orderByRaw('rombel_id DESC')->get();
        $tagihan_terbayar = \App\TransaksiPembayaran::where('pesdik_id', $cari)
            ->leftJoin('tagihan', function ($join) {
                $join->on('transaksipembayaran.tagihan_id', '=', 'tagihan.id');
            })
            ->orderByRaw('transaksipembayaran.rombel_id DESC')->get();
        $jumlah_tagihan = \App\Tagihan::whereIn('rombel_id', $pesdik_pilih)
            ->WhereIn('jenis_kelamin', $pilih_jk)->sum('nominal');
        $jumlah_terbayar =  \App\TransaksiPembayaran::where('pesdik_id', $cari)
            ->sum('jumlah_bayar');
        // dd($tagihan_siswa);

        return view('/pembayaran/transaksipembayaran/cari_pesdik', compact('data_pesdik', 'identitas_pendik', 'tagihan_siswa', 'tagihan_terbayar', 'jumlah_tagihan', 'jumlah_terbayar'));
    }

    public function form_bayar(Request $request, $id_pesdik)
    {
        $tagihan = $request->input('pilih');
        if ($tagihan > 0) {
            $pesdik = $id_pesdik;
            $pilihTagihan = $request->input('pilih');
            $pesdik_pilih = \App\Anggotarombel::select('rombel_id')->where('pesdik_id', $id_pesdik)->get();
            $tagihan_siswa =  \App\Tagihan::whereIn('id', $pilihTagihan)->get();
            return view('/pembayaran/transaksipembayaran/form_bayar', compact('pesdik', 'tagihan_siswa', 'pesdik_pilih', 'pilihTagihan'));
        } else {
            return redirect('/pembayaran/transaksipembayaran/index')->with('warning', 'Maaf belum ada tagihan pembayaran siswa yang dipilih, mohon ulangi proses dan centang pada checkbox disamping kanan tabel tagihan pembayaran siswa !');
        }
    }

    public function bayar(Request $request)

    {
        $users_id = Auth::id();
        $tagihan_id = $request->tagihan_id;
        $pesdik_id = $request->pesdik_id;
        $rombel_id = $request->rombel_id;
        $nominal = $request->nominal;
        $jumlah_bayar = $request->jumlah_bayar;

        for ($count = 0; $count < count($tagihan_id); $count++) {
            $data = array(
                'tagihan_id' => $tagihan_id[$count],
                'users_id'  => $users_id,
                'pesdik_id'  => $pesdik_id[$count],
                'rombel_id'  => $rombel_id[$count],
                'jumlah_bayar'  => $jumlah_bayar[$count],
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now()

            );
            $insert_data[] = $data;
        }
        TransaksiPembayaran::insert($insert_data);
        $tagihan_dibayar = \App\TransaksiPembayaran::whereIn('tagihan_id', $tagihan_id)->where('pesdik_id', $pesdik_id)->get();
        $identitas = $tagihan_dibayar->first();

        //memasukkan data pembayaran siswa ke pemasukan sekolah
        $jumlah_transaksi = \App\TransaksiPembayaran::whereIn('tagihan_id', $tagihan_id)->where('pesdik_id', $pesdik_id)->sum('jumlah_bayar');
        $siswa=\App\Pesdik::select('nama')->where('id',$pesdik_id)->first();
        $nama_siswa=$siswa->nama;
        $pemasukan = new Pemasukan();
        $pemasukan->kategori_id      = '1';
        $pemasukan->jumlah           = $jumlah_transaksi;
        $pemasukan->keterangan       = $nama_siswa;
        $pemasukan->save();

        return view('/pembayaran/transaksipembayaran/invoice_bukti_pembayaran', compact('identitas', 'tagihan_dibayar', 'tagihan_id', 'pesdik_id'));
    }

    public function cetak_invoice(Request $request)
    {
        $tagihan_id = $request->id_tagih;
        $pesdik_id = $request->id_pesdik;
        $tagihan_dibayar = \App\TransaksiPembayaran::whereIn('tagihan_id', $tagihan_id)->where('pesdik_id', $pesdik_id)->get();
        $identitas = $tagihan_dibayar->first();
        return view('/pembayaran/transaksipembayaran/cetak_invoice', compact('identitas', 'tagihan_dibayar', 'tagihan_id', 'pesdik_id'));
    }

    public function siswaindex($id)
    {
        $pesdik = \App\Pesdik::where('id', $id)->get();
        $id_pesdik_login = $pesdik->first();

        $pesdik = \App\Anggotarombel::groupBy('pesdik_id')->orderByRaw('updated_at - created_at DESC')->get();
        $data = \App\Anggotarombel::where('pesdik_id', $id)->get();
        $data_pesdik = $data->last();

        //Mencari Data Tagihan Per Siswa
        $pesdik_pilih = \App\Anggotarombel::select('rombel_id')->where('pesdik_id', $id)->get();
        $pesdik_jk = \App\Pesdik::select('jenis_kelamin')->where('id', $id)->first();
        $pilih_jk =  \App\Tagihan::whereIn('jenis_kelamin', $pesdik_jk)->orWhere('jenis_kelamin', 'Semua')->get();

        $id_tagihan_terbayar = \App\TransaksiPembayaran::select('tagihan_id')->where('pesdik_id', $id)->get();
        $tagihan_siswa = \App\Tagihan::whereIn('rombel_id', $pesdik_pilih)->whereNotIn('id', $id_tagihan_terbayar)
            ->WhereIn('jenis_kelamin', $pilih_jk)->orderByRaw('rombel_id DESC')->get();
        $tagihan_terbayar = \App\TransaksiPembayaran::where('pesdik_id', $id)
            ->leftJoin('tagihan', function ($join) {
                $join->on('transaksipembayaran.tagihan_id', '=', 'tagihan.id');
            })
            ->orderByRaw('transaksipembayaran.rombel_id DESC')->get();
        $jumlah_tagihan = \App\Tagihan::whereIn('rombel_id', $pesdik_pilih)
            ->WhereIn('jenis_kelamin', $pilih_jk)->sum('nominal');
        $jumlah_terbayar =  \App\TransaksiPembayaran::where('pesdik_id', $id)
            ->sum('jumlah_bayar');

        return view('/pembayaran/transaksipembayaran/siswaindex', compact('id_pesdik_login', 'data_pesdik', 'tagihan_siswa', 'tagihan_terbayar', 'jumlah_tagihan', 'jumlah_terbayar'));
    }
}
