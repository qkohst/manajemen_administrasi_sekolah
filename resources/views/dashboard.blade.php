@extends('layouts.master')
@section('content')
@if(session('warning'))
<div class="callout callout-warning alert alert-warning alert-dismissible fade show" role="alert">
  <h5><i class="fas fa-info"></i> Peringatan :</h5>
  {{session('warning')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<div class="row">
  <div class="container-fluid">
    <!-- Info boxes -->
    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'PetugasAdministrasiSurat')
    <div class="row">
      <div class="flex-fill col-md-3" style="padding: 4px 4px 4px 4px">
        <div class="info-box md-3">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-envelope"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Surat Masuk</span>
            <span class="info-box-number">
              {{DB::table('suratmasuk')->count()}}
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class=" flex-fill col-md-3" style="padding: 4px 4px 4px 4px">
        <div class="info-box md-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-envelope-open"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Surat Keluar</span>
            <span class="info-box-number">{{DB::table('suratkeluar')->count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="flex-fill col-md-3" style="padding: 4px 4px 4px 4px">
        <div class="info-box md-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-layer-group"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Klasifikasi</span>
            <span class="info-box-number">{{DB::table('klasifikasi')->count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class=" flex-fill" style="padding: 4px 4px 4px 4px">
        <div class="info-box md-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Pengguna</span>
            <span class="info-box-number">{{DB::table('users')->count()}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    @endif
    <!-- /.row -->
  </div>
  @if (auth()->user()->role == 'admin' || auth()->user()->role == 'PetugasAdministrasiKeuangan')
  <div class="col-md-9">
    <section class="content card" style="padding: 15px 15px 40px 15px ">
      <div class="box">
        <div class="row">
          <div class="col">
            <h4><i class="nav-icon fas fa-warehouse my-0 btn-sm-1"></i> Rekap Data Sekolah</h4>
            <hr>
          </div>
        </div>
        <div class="card-body">
          <!-- Small boxes (Stat box) -->
          <div class="filter-container p-0 row d-flex justify-content-center">
            <div class="col-lg-3 col-md-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{DB::table('guru')->count()}}</h3>
                  <p>Guru</p>
                </div>
                <div class="icon">
                  <i class="nav-icon fas fa-graduation-cap"></i>
                </div>
                <p class="small-box-footer">Jumlah Guru</p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{DB::table('tendik')->count()}}</h3>
                  <p>Tendik</p>
                </div>
                <div class="icon">
                  <i class="nav-icon fas fa-graduation-cap"></i>
                </div>
                <p class="small-box-footer">Jumlah Tendik</p>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-md-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{DB::table('pesdik')->where('status',"Aktif")->count()}}</h3>
                  <p>Peserta Didik</p>
                </div>
                <div class="icon">
                  <i class="nav-icon fas fa-child nav-icon"></i>
                </div>
                <p class="small-box-footer">Jumlah Peserta Didik</p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{DB::table('rombel')->where('tapel_id', DB::table('rombel')->MAX('tapel_id'))->count()}}</h3>
                  <p>Rombel</p>
                </div>
                <div class="icon">
                  <i class="nav-icon fas fa-users"></i>
                </div>
                <p class="small-box-footer">Jumlah Rombel</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="col-md-3">
    <section class="content card" style="padding: 15px 15px 0px 15px ">
      <div class="box">
        <div class="row">
          <div class="col">
            <h4><i class="nav-icon fas fa-dollar-sign my-0 btn-sm-1"></i> Keuangan Sekolah</h4>
            <hr>
          </div>
        </div>
        <div class="card-body p-0">
          <?php
          $jumlah_pengeluaran = DB::table('pengeluaran')
            ->sum('pengeluaran.jumlah');
          $jumlah_pemasukan = DB::table('pemasukan')
            ->sum('pemasukan.jumlah');
          ?>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="javascript:void(0)" class="product-title">Jumlah Pemasukan</a>
            <h5>@currency($jumlah_pemasukan),00</h5>
            <hr>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="javascript:void(0)" class="product-title">Jumlah Pengeluaran</a>
            <h5> @currency($jumlah_pengeluaran),00</h5>
            <hr>
          </ul>
          <ul class="products-list product-list-in-card pl-1 pr-1">
            <a href="javascript:void(0)" class="product-title">Saldo</a>
            <h5>@currency($jumlah_pemasukan-$jumlah_pengeluaran),00</h5>
            <hr />
          </ul>
        </div>
      </div>
    </section>
  </div>
  @endif
  <div class="col-md-6">
    <section class="content card" style="padding: 10px 10px 10px 10px ">
      <div class="box">
        <div class="row">
          <div class="col">
            <h4><i class="nav-icon fas fa-bullhorn my-0 btn-sm-1"></i> Pengumuman</h4>
            <hr>
          </div>
        </div>
        <div class="tab-pane" id="timeline">
          <!-- The timeline -->
          <div class="timeline timeline-inverse">
            <!-- timeline time label -->
            <div class="time-label">
              <span class="bg-success">
                Pengumuman Terakhir
              </span>
            </div>
            @foreach($data_pengumuman as $pengumuman)
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <div>
              <i class="fas fa-envelope bg-primary"></i>

              <div class="timeline-item">
                <span class="time"><i class="far fa-calendar-alt"></i> {{$pengumuman->created_at}} <br> {{$pengumuman->created_at->diffForHumans()}} </span>
                <h3 class="timeline-header"><a class="text-primary">{{$pengumuman->judul}}</a><br>{{$pengumuman->users->role}} </h3>
                <div class="timeline-body">
                  {!!$pengumuman->isi!!}
                </div>
              </div>
            </div>
            <!-- END timeline item -->
            @endforeach
            <div>
              <i class="far fa-clock bg-gray"></i>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="col-md-3">
    <section class="content card" style="padding: 10px 10px 10px 10px ">
      <div class="box">
        <div class="row">
          <div class="col">
            <h4><i class="nav-icon fas fa-headset my-0 btn-sm-1"></i> Team Teknis</h4>
            <hr>
          </div>
        </div>
        <div class="card-body p-0">
          <ul class="products-list product-list-in-card pl-2 pr-2">
            @foreach($data_admin as $admin)
            <li class="item">
              <div class="product-img">
                <img src="/adminLTE/img/support.png" alt="Product Image" class="img-size-50">
              </div>
              <div class="product-info">
                <a href="javascript:void(0)" class="product-title">{{$admin->name}}
                  <span class="badge badge-warning float-right">Administrator</span></a>
                <span class="product-description">
                  Email : {{$admin->email}}
                </span>
              </div>
            </li>
            @endforeach
            @foreach($data_petugas as $petugas)
            <li class="item">
              <div class="product-img">
                <img src="/adminLTE/img/support.png" alt="Product Image" class="img-size-50">
              </div>
              <div class="product-info">
                <a href="javascript:void(0)" class="product-title">{{$petugas->nama}}
                  <span class="badge badge-warning float-right">{{$petugas->tugas}}</span></a>
                <span class="product-description">
                  Email : {{$petugas->email}}
                </span>
                <span class="product-description text-info">
                  HP : {{$petugas->no_hp}}
                </span>
              </div>
            </li>
            @endforeach
            <!-- /.item -->
          </ul>
        </div>
      </div>
    </section>
  </div>
  <div class="col-md-3">
    <section class="content card" style="padding: 10px 10px 10px 10px ">
      <div class="box">
        <div class="row">
          <div class="col">
            <h4><i class="nav-icon fas fa-user-tag my-0 btn-sm-1"></i> Riwayat Login</h4>
            <hr>
          </div>
        </div>
        <div class="card-body p-0">
          <ul class="products-list product-list-in-card pl-2 pr-2">
            @foreach($data_login as $user_login)
            <li class="item">
              <div class="product-img">
                <img src="/adminLTE/img/user.png" alt="Product Image" class="img-size-50">
              </div>
              <div class="product-info">
                <a href="javascript:void(0)" class="product-title">{{$user_login->name}}
                  <span class="badge float-right"><i class="far fa-clock"></i> {{$user_login->created_at->diffForHumans()}}</span></a>

                <span class="product-description">
                  {{$user_login->email}}
                </span>
              </div>
            </li>
            @endforeach
            <!-- /.item -->
          </ul>
        </div>
      </div>
    </section>
  </div>
  @endsection