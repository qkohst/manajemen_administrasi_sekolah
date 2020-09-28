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
                <h4><i class="nav-icon fas fa-dollar-sign my-1 btn-sm-1"></i> Laporan Keuangan Sekolah</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h6 class="card-header bg-secondary p-2"><i class="fas fa-filter"></i> Filter Data</h6>
                    <div class="card-body bg-light">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="/laporankeuangan/keuangansekolah/filterByTanggal" method="POST">
                                    {{csrf_field()}}
                                    <label>Berdasarkan Rentang Tanggal</label>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" />
                                        </div>
                                        <div class="col-md-1 text-center">
                                            s/d
                                        </div>
                                        <div class="col-md-5">
                                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" onchange="this.form.submit();" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form action="/laporankeuangan/keuangansekolah/filterByKategori" method="POST">
                                    {{csrf_field()}}
                                    <label>Berdasarkan Kategori</label>
                                    <select name="filterKategori" id="filterKategori" class="form-control select2bs4 my-1 mr-sm-1" onchange="this.form.submit();">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($daftar_kategori as $list_kategori)
                                        <option value="{{ $list_kategori->id }}">{{$list_kategori->nama_kategori}}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="/laporankeuangan/keuangansekolah/cetak" method="POST" target="_blank">
                    {{csrf_field()}}
                    @foreach($data_id_kategori as $id_kategori)
                    <input name="id_kategori[]" type="text" class="d-none" id="id_kategori[]" value="{{$id_kategori->id}}">
                    @endforeach

                    <input name="tgl_awal" type="text" class="d-none" id="tgl_awal" value="{{$tgl_awal}}">
                    <input name="tgl_akhir" type="text" class="d-none" id="tgl_akhir" value="{{$tgl_akhir}}">
                    <button type="submit" class="btn btn-primary btn-sm my-2 mr-sm-2 float-right"><i class="fas fa-print"></i> Cetak</button>
                </form>
                <a class="btn btn-primary btn-sm my-2 mr-sm-2 float-right" href="{{route('laporankeuangan.keuangansekolah.DownloadExcel')}}" role="button"><i class="fas fa-file-excel"></i> Download Excel</a>
                <a class="btn btn-success btn-sm my-2 mr-sm-2 float-right" href="index" role="button"><i class="fas fa-sync-alt"></i> Refresh</a>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-light">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active btn-sm" href="#setor" data-toggle="tab"><i class="fas fa-money-bill-alt nav-icon"></i> Laporan Pemasukan Sekolah</a></li>
                    <li class="nav-item"><a class="nav-link btn-sm" href="#pesdik" data-toggle="tab"><i class="fas fa-money-bill-alt nav-icon"></i> Laporan Pengeluaran Sekolah</a></li>
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
                                                <th>Kategori</th>
                                                <th>Tanggal Pemasukan</th>
                                                <th>Jumlah</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0; ?>
                                            @foreach($data_pemasukan as $pemasukan)
                                            <?php $no++; ?>
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$pemasukan->kategori->nama_kategori}}</td>
                                                <td>{{$pemasukan->created_at}}</td>
                                                <td>@currency($pemasukan->jumlah),00</td>
                                                <td>{{$pemasukan->keterangan}}</td>
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
                                                <th>Kategori</th>
                                                <th>Tanggal Pemasukan</th>
                                                <th>Jumlah</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0; ?>
                                            @foreach($data_pengeluaran as $pengeluaran)
                                            <?php $no++; ?>
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$pengeluaran->kategori->nama_kategori}}</td>
                                                <td>{{$pengeluaran->created_at}}</td>
                                                <td>@currency($pengeluaran->jumlah),00</td>
                                                <td>{{$pengeluaran->keterangan}}</td>
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