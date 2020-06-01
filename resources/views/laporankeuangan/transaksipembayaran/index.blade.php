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
                <h3><i class="nav-icon far fa-handshake nav-icon my-1 btn-sm-1"></i> Laporan Transaksi Pembayaran</h3>
                <hr>
            </div>
        </div>
        <!-- Untuk Refress -->
        <div class="row">
            <!-- Menu Donwload dan Cetak -->
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
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
                                <td>{{$transaksi->pesdik->rombel->nama_rombel}} {{$transaksi->pesdik->rombel->tapel->semester}} {{$transaksi->pesdik->rombel->tapel->tahun}}</td>
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