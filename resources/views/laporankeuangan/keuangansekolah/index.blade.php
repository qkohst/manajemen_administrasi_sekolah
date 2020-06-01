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
                                <li class="nav-item"><a class="nav-link active btn-sm" href="#setor" data-toggle="tab"><i class="fas fa-credit-card"></i> Laporan Pemasukan Sekolah</a></li>
                                <li class="nav-item"><a class="nav-link btn-sm" href="#pesdik" data-toggle="tab"><i class="fas fa-child"></i> Laporan Pengeluaran Sekolah</a></li>
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
                                                        <th>Kategori</th>
                                                        <th>Tanggal Pemasukan</th>
                                                        <th>Jumlah</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 0;?>
                                                    @foreach($data_pemasukan as $pemasukan)
                                                    <?php $no++ ;?>
                                                    <tr>
                                                        <td>{{$no}}</td>
                                                        <td>{{$pemasukan->kategori->nama_kategori}}</td>
                                                        <td>{{$pemasukan->tanggal}}</td>
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
                                            <table class="table table-hover table-head-fixed" id='tabelAgendaKeluar'>
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
                                                    <?php $no = 0;?>
                                                    @foreach($data_pengeluaran as $pengeluaran)
                                                    <?php $no++ ;?>
                                                    <tr>
                                                        <td>{{$no}}</td>
                                                        <td>{{$pengeluaran->kategori->nama_kategori}}</td>
                                                        <td>{{$pengeluaran->tanggal}}</td>
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
