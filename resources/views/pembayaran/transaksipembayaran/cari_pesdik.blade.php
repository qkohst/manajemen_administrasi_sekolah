@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <h4><i class="nav-icon far fa-handshake nav-icon my-1 btn-sm-1"></i> Transaksi Pembayaran Siswa</h4>
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
                                        @foreach($data_pesdik as $pesdik)
                                        <option value="{{$pesdik->id}}">{{$pesdik->nisn}}/{{$pesdik->induk}} - {{$pesdik->nama}}</option>
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
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="/adminLTE/img/user.png" alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center"><b>{{$identitas_pendik->nama}}</b></h3>
                                <p class="text-muted text-center">{{$identitas_pendik->rombel->nama_rombel}} {{$identitas_pendik->rombel->tapel->semester}}</p>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Status</b>
                                        <a class="float-right">{{$identitas_pendik->status}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>TTL</b>
                                        <a class="float-right">{{$identitas_pendik->tempat_lahir}}, {{$identitas_pendik->tanggal_lahir}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Jenis Kelamin</b> <a class="float-right">{{$identitas_pendik->jenis_kelamin}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>NISN/Induk</b>
                                        <a class="float-right">{{$identitas_pendik->induk}}</a>
                                        <a class="float-right">/</a>
                                        <a class="float-right">{{$identitas_pendik->nisn}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Jenis Pendaftaran</b> <a class="float-right">{{$identitas_pendik->jenis_pendaftaran}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tanggal Masuk</b> <a class="float-right">{{$identitas_pendik->tanggal_masuk}}</a>
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
                            <div class="card-body table-responsive">
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    Silahkan centang pada checkbox disamping kanan tabel, lalu klik tombol BAYAR !!!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/pembayaran/transaksipembayaran/{{$identitas_pendik->id}}/form_bayar" method="POST">
                                    {{csrf_field()}}
                                    <table class="table table-hover table-head-fixed" id='tabelAgendaMasuk'>
                                        <thead>
                                            <tr>
                                                <th>Kelas</th>
                                                <th>Rincian</th>
                                                <th>Batas Pembayaran</th>
                                                <th>Tagihan</th>
                                                <th>Terbayar</th>
                                                <th>Sisa Tagihan</th>
                                                <th>Pilih</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tagihan_siswa as $tagih)
                                            <tr>
                                                <td>{{$tagih->rombel->nama_rombel}} {{$tagih->rombel->tapel->semester}}</td>
                                                <td>{{$tagih->rincian}}</td>
                                                <td>{{$tagih->batas_bayar}}</td>
                                                <td>@currency($tagih->nominal),00</td>
                                                <td>@currency($tagih->jumlah_bayar),00</td>
                                                <td>@currency($tagih->nominal-$tagih->jumlah_bayar),00</td>
                                                <td align="center">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox" id="checkboxPrimary{{$tagih->id}}" name="pilih[]" value="{{$tagih->id}}">
                                                        <label for="checkboxPrimary{{$tagih->id}}">
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @foreach($tagihan_terbayar as $terbayar)
                                            <tr>
                                                <td>{{$terbayar->rombel->nama_rombel}} {{$terbayar->rombel->tapel->semester}}</td>
                                                <td>{{$terbayar->rincian}}</td>
                                                <td>{{$terbayar->batas_bayar}}</td>
                                                <td>@currency($terbayar->nominal),00</td>
                                                <td>@currency($terbayar->jumlah_bayar),00</td>
                                                <td>@currency($terbayar->nominal-$terbayar->jumlah_bayar),00</td>
                                                <td align="center">
                                                    <div class="icheck-primary d-inline">
                                                        <input type="checkbox" id="checkboxPrimary{{$tagih->id}}" name="pilih[]" value="{{$tagih->id}}" disabled>
                                                        <label for="checkboxPrimary{{$tagih->id}}">
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" align="center"><b>Jumlah</b></td>
                                                <td align="left"><b>@currency($jumlah_tagihan),00</b><br></td>
                                                <td align="left"><b>@currency($jumlah_terbayar),00</b><br></td>
                                                <td align="left"><b>@currency($jumlah_tagihan-$jumlah_terbayar),00</b><br></td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm my-1 mr-sm-1" type="submit" id="bayar">BAYAR</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
</section>
@endsection