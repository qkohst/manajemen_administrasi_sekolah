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
    <h4><i class="nav-icon fas fa-credit-card my-1 btn-sm-1"></i> Data Tarik Tunai</h4>
    <hr>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile bg-light">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="/adminLTE/img/user.png" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><b>{{$id_pesdik_login->nama}}</b></h3>
                <p class="text-muted text-center">{{$id_pesdik_login->rombel->nama_rombel}} {{$id_pesdik_login->rombel->tapel->semester}}</p>
                <ul class="list-group list-group-unbordered bg-light mb-3">
                  <li class="list-group-item bg-light">
                    <b>Status</b>
                    <a class="float-right">{{$id_pesdik_login->status}}</a>
                  </li>
                  <li class="list-group-item bg-light">
                    <b>TTL</b>
                    <a class="float-right">{{$id_pesdik_login->tempat_lahir}}, {{$id_pesdik_login->tanggal_lahir}}</a>
                  </li>
                  <li class="list-group-item bg-light">
                    <b>Jenis Kelamin</b> <a class="float-right">{{$id_pesdik_login->jenis_kelamin}}</a>
                  </li>
                  <li class="list-group-item bg-light">
                    <b>NISN/Induk</b>
                    <a class="float-right">{{$id_pesdik_login->induk}}</a>
                    <a class="float-right">/</a>
                    <a class="float-right">{{$id_pesdik_login->nisn}}</a>
                  </li>
                  <li class="list-group-item bg-light">
                    <b>Jenis Pendaftaran</b> <a class="float-right">{{$id_pesdik_login->jenis_pendaftaran}}</a>
                  </li>
                  <li class="list-group-item bg-light">
                    <b>Tanggal Masuk</b> <a class="float-right">{{$id_pesdik_login->tanggal_masuk}}</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-9">
            <div class="card">
              <div class="card-header bg-light p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active btn-sm" href="#setor" data-toggle="tab"><i class="fas fa-credit-card"></i> Rekap Data Tarik Tunai</a></li>
                  <li class="nav-item"><a class="nav-link btn-sm" href="#pesdik" data-toggle="tab"><i class="fas fa-dollar-sign"></i> Saldo Tabungan</a></li>
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
                                <th>No. Trans</th>
                                <th>Nama Pesdik</th>
                                <th>Tanggal</th>
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
                                <td>TT0{{$tarik->id}}</td>
                                <td>{{$tarik->pesdik->nama}}</td>
                                <td>{{$tarik->tanggal}}</td>
                                <td>@currency($tarik->jumlah),00</td>
                                <td>{{$tarik->keterangan}}</td>
                                <td>{{$tarik->users->name}}</td>
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
                          <table class="table table-hover table-head-fixed" id='agenda'>
                            <thead>
                              <tr class="bg-light">
                                <th>No.</th>
                                <th>NISN </th>
                                <th>Nama Pesdik</th>
                                <th>Rombel</th>
                                <th>Saldo Tabungan</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $no = 0; ?>
                              @foreach($data_pesdik as $pesdik)
                              <?php $no++; ?>
                              <tr>
                                <td>{{$no}}</td>
                                <td>{{$pesdik->nisn}}</td>
                                <td>{{$pesdik->nama}}</td>
                                <td>{{$pesdik->rombel->nama_rombel}}</td>
                                <?php
                                $id = $pesdik->id;
                                $total_setor = DB::table('setor')->where('setor.pesdik_id', '=', $id)
                                  ->sum('setor.jumlah');
                                $total_tarik = DB::table('tarik')->where('tarik.pesdik_id', '=', $id)
                                  ->sum('tarik.jumlah');
                                ?>
                                <td>@currency($total_setor-$total_tarik),00</td>
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
              <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
          </div>
        </div><!-- /.container-fluid -->
    </section>
  </div>
</section>
@endsection