@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
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
        <h3><i class="nav-icon far fa-handshake nav-icon my-1 btn-sm-1"></i> Transaksi Pembayaran Siswa</h3>
        <hr>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <h6 class="card-header bg-secondary p-2"><i class="fas fa-search"></i> CARI DATA SISWA</h6>
                            <div class="card-body table-responsive bg-light">
                                <form action="/pembayaran/transaksipembayaran/cari_pesdik" method="POST">
                                    {{csrf_field()}}
                                    <select name="cari_pesdik" id="cari_pesdik" class="form-control select2bs4" onchange="this.form.submit();">
                                        <option value="">-- Pilih Siswa --</option>
                                        @foreach($pesdik as $data)
                                        <option value="{{ $data->pesdik_id }}">{{$data->pesdik->nisn}}/{{$data->pesdik->induk}} - {{$data->pesdik->nama}}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile bg-light">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="/adminLTE/img/user.png" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center"><b>{{$data_pesdik->pesdik->nama}}</b></h3>
                                <p class="text-muted text-center">{{$data_pesdik->rombel->nama_rombel}} {{$data_pesdik->rombel->tapel->semester}}</p>
                                <ul class="list-group list-group-unbordered bg-light mb-3">
                                    <li class="list-group-item bg-light">
                                        <b>Status</b>
                                        <a class="float-right">{{$data_pesdik->pesdik->status}}</a>
                                    </li>
                                    <li class="list-group-item bg-light">
                                        <b>TTL</b>
                                        <a class="float-right">{{$data_pesdik->pesdik->tempat_lahir}}, {{$data_pesdik->pesdik->tanggal_lahir}}</a>
                                    </li>
                                    <li class="list-group-item bg-light">
                                        <b>Jenis Kelamin</b> <a class="float-right">{{$data_pesdik->pesdik->jenis_kelamin}}</a>
                                    </li>
                                    <li class="list-group-item bg-light">
                                        <b>NISN/Induk</b>
                                        <a class="float-right">{{$data_pesdik->pesdik->induk}}</a>
                                        <a class="float-right">/</a>
                                        <a class="float-right">{{$data_pesdik->pesdik->nisn}}</a>
                                    </li>
                                    <li class="list-group-item bg-light">
                                        <b>Jenis Pendaftaran</b> <a class="float-right">{{$data_pesdik->pesdik->jenis_pendaftaran}}</a>
                                    </li>
                                    <li class="list-group-item bg-light">
                                        <b>Tanggal Masuk</b> <a class="float-right">{{$data_pesdik->pesdik->tanggal_masuk}}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-9">
                        <div class="card">
                            <h6 class="card-header bg-secondary p-2"><i class="fas fa-money-check-alt"></i> TAGIHAN PEMBAYARAN SISWA</h6>
                            <div class="card-body bg-light table-responsive">
                                <form action="/pembayaran/transaksipembayaran/{{$data_pesdik->pesdik->id}}/form_bayar" method="GET">
                                    {{csrf_field()}}
                                    <table class="table table-bordered table-head-fixed bg-white" id='tabelAgendaMasuk'>
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>Kelas</th>
                                                <!-- <th>Jenis Kelamin</th> -->
                                                <th>Rincian</th>
                                                <th>Batas Pembayaran</th>
                                                <th>Tagihan</th>
                                                <th>Terbayar</th>
                                                <th>Sisa Tagihan</th>
                                                <th>Pilih</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0; ?>
                                            @foreach($tagihan_siswa as $tagih)
                                            <?php $no++; ?>
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$tagih->rombel->nama_rombel}} {{$tagih->rombel->tapel->semester}}</td>
                                                <!-- <td>{{$tagih->jenis_kelamin}}</td> -->
                                                <td>{{$tagih->rincian}}</td>
                                                <td>{{$tagih->batas_bayar}}</td>
                                                <td>@currency($tagih->nominal),00</td>
                                                <td>@currency($tagih->jumlah_bayar),00</td>
                                                <td>@currency($tagih->nominal-$tagih->jumlah_bayar),00</td>
                                                <td align="center">
                                                <input type="checkbox" id="pilih[]" name="pilih[]" value="{{$tagih->id}}">
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" align="center"><b>Jumlah</b></td>
                                                <td align="left">
                                                    <?php
                                                    $jumlah_tagihan = \App\Tagihan::whereIn('rombel_id', $pesdik_pilih)
                                                        ->WhereIn('jenis_kelamin', $pilih_jk)->sum('nominal');
                                                    ?>
                                                    <b>@currency($jumlah_tagihan),00</b><br>
                                                </td>
                                                <td align="left">
                                                    <?php
                                                    $jumlah_terbayar =  \App\TransaksiPembayaran::where('pesdik_id', $data_pesdik->pesdik->id)
                                                    ->sum('jumlah_bayar');
                                                    ?>
                                                    <b>@currency($jumlah_terbayar),00</b><br>
                                                </td>
                                                <td align="left">
                                                    <b>@currency($jumlah_tagihan-$jumlah_terbayar),00</b><br>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm my-1 mr-sm-1" type="submit" id="bayar">Bayar</button>                                            
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </form>
                                <!-- <div class="col-12">
                                    <a class="btn btn-primary btn-sm my-1 mr-sm-1" href="/pembayaran/transaksipembayaran/{{$data_pesdik->pesdik->id}}/form_bayar" role="button"><i class="fas fa-plus"></i>
                                        Bayar</a>
                                    <br>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
</section>
@endsection