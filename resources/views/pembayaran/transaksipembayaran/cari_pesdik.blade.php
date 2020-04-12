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
                                    <li class="list-group-item">
                                        <b>Status</b>
                                        <a class="float-right">{{$data_pesdik->pesdik->status}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>TTL</b>
                                        <a class="float-right">{{$data_pesdik->pesdik->tempat_lahir}}, {{$data_pesdik->pesdik->tanggal_lahir}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Jenis Kelamin</b> <a class="float-right">{{$data_pesdik->pesdik->jenis_kelamin}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>NISN/Induk</b>
                                        <a class="float-right">{{$data_pesdik->pesdik->induk}}</a>
                                        <a class="float-right">/</a>
                                        <a class="float-right">{{$data_pesdik->pesdik->nisn}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Jenis Pendaftaran</b> <a class="float-right">{{$data_pesdik->pesdik->jenis_pendaftaran}}</a>
                                    </li>
                                    <li class="list-group-item">
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
                                    <table class="table table-bordered table-head-fixed bg-white">
                                        <thead>                  
                                            <tr>
                                            <th style="width: 10px">No</th>
                                            <th>Rincian</th>
                                            <th>Tagihan</th>
                                            <th>Terbayar</th>
                                            <th>Sisa Tagihan</th>
                                            <th>Batas Pembayaran</th>
                                            <th style="width: 40px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;?>
                                            @foreach($tagihan_siswa as $tagih)
                                            <?php $no++ ;?>
                                            <tr>
                                                <td>{{$no}}</td>
                                                <td>{{$tagih->rincian}}</td>
                                                <td>@currency($tagih->nominal),00</td>
                                                <td>Rp.0,00</td>
                                                <td>@currency($tagih->nominal),00</td>
                                                <td>{{$tagih->batas_bayar}}</td>
                                                <td>
                                                <a href="#"
                                                    class="btn btn-success btn-sm"> Bayar</a>
                                            </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
    </div>
</section>
@endsection
