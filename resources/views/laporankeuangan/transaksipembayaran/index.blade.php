@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 20px 20px  ">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success" role="alert">
            {{session('sukses')}}
        </div>
        @endif
        <div class="row">
            <div class="col">
                <h4><i class="nav-icon far fa-handshake nav-icon my-1 btn-sm-1"></i> Laporan Transaksi Pembayaran</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h6 class="card-header bg-secondary p-2"><i class="fas fa-filter"></i> Filter Data</h6>
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-md-3">
                                <form action="/laporankeuangan/transaksipembayaran/filterByNama" method="POST">
                                    {{csrf_field()}}
                                    <label>Berdasarkan Nama Siswa</label>
                                    <select name="filterNama" id="filterNama" class="form-control select2bs4 my-1 mr-sm-1" onchange="this.form.submit();">
                                        <option value="">-- Pilih Nama Siswa --</option>
                                        @foreach($daftar_nama as $list_nama)
                                        <option value="{{ $list_nama->pesdik_id }}">{{$list_nama->pesdik->nisn}}/{{$list_nama->pesdik->induk}} - {{$list_nama->pesdik->nama}}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                            <div class="col-md-3">
                                <form action="/laporankeuangan/transaksipembayaran/filterByKelas" method="POST">
                                    {{csrf_field()}}
                                    <label>Berdasarkan Kelas</label>
                                    <select name="filterKelas" id="filterKelas" class="form-control select2bs4 my-1 mr-sm-1" onchange="this.form.submit();">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach($daftar_kelas as $list_kelas)
                                        <option value="{{ $list_kelas->rombel_id }}">{{$list_kelas->rombel->nama_rombel}} {{$list_kelas->rombel->tapel->semester}} {{$list_kelas->rombel->tapel->tahun}}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <form action="/laporankeuangan/transaksipembayaran/filterByTanggal" method="POST">
                                    {{csrf_field()}}
                                    <label>Berdasarkan Rentang Tanggal Pembayaran</label>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" />
                                        </div>
                                        <div class="col-md-2 text-center">
                                            s/d
                                        </div>
                                        <div class="col-md-5">
                                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" onchange="this.form.submit();" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="/laporankeuangan/transaksipembayaran/cetak" method="POST" target="_blank">
                    {{csrf_field()}}
                    @foreach($data_id_pesdik as $id_pesdik)
                    <input name="id_pesdik[]" type="text" class="d-none" id="id_pesdik[]" value="{{$id_pesdik->pesdik_id}}">
                    @endforeach
                    @foreach($data_id_rombel as $id_rombel)
                    <input name="id_rombel[]" type="text" class="d-none" id="id_rombel[]" value="{{$id_rombel->rombel_id}}">
                    @endforeach

                    <input name="tgl_awal" type="text" class="d-none" id="tgl_awal" value="{{$tgl_awal}}">
                    <input name="tgl_akhir" type="text" class="d-none" id="tgl_akhir" value="{{$tgl_akhir}}">

                    <button type="submit" class="btn btn-primary btn-sm my-2 mr-sm-2 float-right"><i class="fas fa-print"></i> Cetak</button>
                </form>
                <a class="btn btn-primary btn-sm my-2 mr-sm-2 float-right" href="{{route('laporankeuangan.transaksipembayaran.DownloadExcel')}}" role="button"><i class="fas fa-file-excel"></i> Download Excel</a>
                <a class="btn btn-success btn-sm my-2 mr-sm-2 float-right" href="index" role="button"><i class="fas fa-sync-alt"></i> Refresh</a>
            </div>
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-hover table-head-fixed" id='agenda'>
                        <thead>
                            <tr class="bg-light">
                                <th>No.</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Rincian</th>
                                <th>Nominal Dibayar</th>
                                <th>Tanggal Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($data_transaksi as $transaksi)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$transaksi->pesdik->nama}}</td>
                                <td>{{$transaksi->rombel->nama_rombel}} {{$transaksi->rombel->tapel->semester}} {{$transaksi->pesdik->rombel->tapel->tahun}}</td>
                                <td>{{$transaksi->tagihan->rincian}}</td>
                                <td>@currency($transaksi->jumlah_bayar),00</td>
                                <td>{{$transaksi->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection