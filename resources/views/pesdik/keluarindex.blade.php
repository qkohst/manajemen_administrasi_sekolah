@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 20px 20px  ">
    <div class="box">
        @if(session('sukses'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('sukses')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col">
                <h4><i class="nav-icon fas fa-child my-0 btn-sm-1"></i> Data Peserta Didik Keluar</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="row table-responsive">
                <div class="col-12">
                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                        <thead>
                            <tr class="bg-light">
                                <th>No.</th>
                                <th>Nama Lengkap</th>
                                <th>Jenis Kelamin</th>
                                <th>NISN</th>
                                <th>No. Induk</th>
                                <th>Tanggal Masuk</th>
                                <th>Rombel Sebelumnya</th>
                                <th>Keluar Karena</th>
                                <th>Tanggal Keluar</th>
                                <th>Alasan Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach($data_pesdikkeluar as $pesdikkeluar)
                            <?php $no++; ?>
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$pesdikkeluar->pesdik->nama}}</td>
                                <td>{{$pesdikkeluar->pesdik->jenis_kelamin}}</td>
                                <td>{{$pesdikkeluar->pesdik->nisn}}</td>
                                <td>{{$pesdikkeluar->pesdik->induk}}</td>
                                <td>{{$pesdikkeluar->pesdik->tanggal_masuk}}</td>
                                <td>{{$pesdikkeluar->pesdik->rombel->nama_rombel}} {{$pesdikkeluar->pesdik->rombel->tapel->tahun}} {{$pesdikkeluar->pesdik->rombel->tapel->semester}}</td>
                                <td>{{$pesdikkeluar->keluar_karena}}</td>
                                <td>{{$pesdikkeluar->tanggal_keluar}}</td>
                                <td>{{$pesdikkeluar->alasan_keluar}}</td>
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