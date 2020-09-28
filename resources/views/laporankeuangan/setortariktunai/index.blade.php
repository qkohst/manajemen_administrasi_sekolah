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
                <h4><i class="nav-icon fas fa-credit-card my-1 btn-sm-1"></i> Laporan Setor & Tarik Tunai</h4>
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
                                <form action="/laporankeuangan/setortariktunai/filterByNama" method="POST">
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
                                <form action="/laporankeuangan/setortariktunai/filterByKelas" method="POST">
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
                                <form action="/laporankeuangan/setortariktunai/filterByTanggal" method="POST">
                                    {{csrf_field()}}
                                    <label>Berdasarkan Rentang Tanggal Transaksi</label>
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
                <form action="/laporankeuangan/setortariktunai/cetak" method="POST" target="_blank">
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
                <a class="btn btn-primary btn-sm my-2 mr-sm-2 float-right" href="{{route('laporankeuangan.setortariktunai.DownloadExcel')}}" role="button"><i class="fas fa-file-excel"></i> Download Excel</a>
                <a class="btn btn-success btn-sm my-2 mr-sm-2 float-right" href="index" role="button"><i class="fas fa-sync-alt"></i> Refresh</a>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-light">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active btn-sm" href="#setor" data-toggle="tab"><i class="fas fa-credit-card"></i> Laporan Setor Tunai</a></li>
                    <li class="nav-item"><a class="nav-link btn-sm" href="#pesdik" data-toggle="tab"><i class="fas fa-credit-card"></i> Laporan Tarik Tunai</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="setor">
                        <div class="row">
                            <div class="row table-responsive">
                                <div class="col-12">
                                    <table class="table table-hover table-head-fixed" id='agenda'>
                                        <thead>
                                            <tr class="bg-light">
                                                <th>No.</th>
                                                <th>Nama Pesdik</th>
                                                <th>Kelas</th>
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
                                                <td>{{$setor->rombel->nama_rombel}} {{$setor->rombel->tapel->semester}} {{$setor->pesdik->rombel->tapel->tahun}}</td>
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
                                    <table class="table table-hover table-head-fixed" id='agenda2'>
                                        <thead>
                                            <tr class="bg-light">
                                                <th>No.</th>
                                                <th>Nama Pesdik</th>
                                                <th>Kelas</th>
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
                                                <td>{{$tarik->rombel->nama_rombel}} {{$tarik->rombel->tapel->semester}} {{$tarik->pesdik->rombel->tapel->tahun}}</td>
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