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
                <h3><i class="nav-icon fas fa-credit-card my-1 btn-sm-1"></i> Laporan Setor & Tarik Tunai</h3>
                <hr>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active btn-sm" href="#setor" data-toggle="tab"><i class="fas fa-credit-card"></i> Laporan Setor Tunai</a></li>
                    <li class="nav-item"><a class="nav-link btn-sm" href="#pesdik" data-toggle="tab"><i class="fas fa-child"></i> Laporan Tarik Tunai</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="setor">
                        <div class="row">
                            <div class="row table-responsive">
                                <div class="col-12">
                                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                                        <thead>
                                            <tr class="bg-light">
                                                <th>No.</th>
                                                <th>Nama Pesdik</th>
                                                <th>Kelas Saat Ini </th>
                                                <th>Tanggal Setor</th>
                                                <th>Jumlah</th>
                                                <th>Keterangan</th>
                                                <th>Petugas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0; ?>
                                            @foreach($data_setor as $setor)
                                            <?php $no++; ?>
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$setor->pesdik->nama}}</td>
                                                <td>{{$setor->pesdik->rombel->nama_rombel}} {{$setor->pesdik->rombel->tapel->semester}} {{$setor->pesdik->rombel->tapel->tahun}}</td>
                                                <td>{{$setor->tanggal}}</td>
                                                <td>@currency($setor->jumlah),00</td>
                                                <td>{{$setor->keterangan}}</td>
                                                <td>{{$setor->users->name}}</td>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="pesdik">
                        <div class="row">
                            <div class="row table-responsive">
                                <div class="col-12">
                                    <table class="table table-hover table-head-fixed" id='tabelAgendaKeluar'>
                                        <thead>
                                            <tr class="bg-light">
                                                <th>No.</th>
                                                <th>Nama Pesdik</th>
                                                <th>Kelas Saat Ini </th>
                                                <th>Tanggal Penarikan</th>
                                                <th>Jumlah</th>
                                                <th>Keterangan</th>
                                                <th>Petugas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0; ?>
                                            @foreach($data_tarik as $tarik)
                                            <?php $no++; ?>
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$tarik->pesdik->nama}}</td>
                                                <td>{{$tarik->pesdik->rombel->nama_rombel}} {{$tarik->pesdik->rombel->tapel->semester}} {{$tarik->pesdik->rombel->tapel->tahun}}</td>
                                                <td>{{$tarik->tanggal}}</td>
                                                <td>@currency($tarik->jumlah),00</td>
                                                <td>{{$tarik->keterangan}}</td>
                                                <td>{{$tarik->users->name}}</td>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection