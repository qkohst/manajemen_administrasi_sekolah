@extends('layouts.master')
@section('content')
<div class="row">
  <div class="container-fluid">
   <!-- Info boxes -->
   <div class="d-flex justify-content-center">
          <div class="flex-fill" style="padding: 4px 4px 4px 4px">
            <div class="info-box">
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
          <div class=" flex-fill" style="padding: 4px 4px 4px 4px">
            <div class="info-box mb-3">
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
          <div class="flex-fill" style="padding: 4px 4px 4px 4px">
            <div class="info-box mb-3">
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
          @if (auth()->user()->role == 'admin')
          <div class=" flex-fill" style="padding: 4px 4px 4px 4px">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pengguna</span>
                <span class="info-box-number">{{DB::table('users')->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          @endif
          <!-- /.col -->
        </div>
        <!-- /.row -->
  </div>
<div class="col-9">
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
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{DB::table('guru')->count()}}</h3>
                                <p>Guru</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                            </div>
                            <a href="/guru/index" class="small-box-footer">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{DB::table('tendik')->count()}}</h3>
                                <p>Tendik</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                            </div>
                            <a href="/tendik/index" class="small-box-footer">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{DB::table('pesdik')->count()}}</h3>
                                <p>Peserta Didik</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-child nav-icon"></i>
                            </div>
                            <a href="/pesdik/index" class="small-box-footer">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{DB::table('rombel')->count()}}</h3>
                                <p>Rombel</p>
                            </div>
                            <div class="icon">
                                <i class="nav-icon fas fa-users"></i>
                            </div>
                            <a href="/rombel/index" class="small-box-footer">Lihat Detail <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</section>
</div>
<div class="col-3">
  <section class="content card" style="padding: 15px 15px 0px 15px ">
  <div class="box">
          <div class="row">
              <div class="col">
                  <h4><i class="nav-icon fas fa-dollar-sign my-0 btn-sm-1"></i> Keuangan Sekolah</h4>
                  <hr>
              </div>
          </div>
          <div class="card-body p-0">
                  <ul class="products-list product-list-in-card pl-1 pr-1">
                        <a href="javascript:void(0)" class="product-title">Pemasukan</a>
                          <h5> Rp. 20.000.000,00</h5>
                          <hr>
                  </ul>
                  <ul class="products-list product-list-in-card pl-1 pr-1">
                        <a href="javascript:void(0)" class="product-title">Pengeluaran</a>
                          <h5> Rp. 15.000.000,00</h5>
                          <hr>
                  </ul>
                  <ul class="products-list product-list-in-card pl-1 pr-1">
                        <a href="javascript:void(0)" class="product-title">Saldo</a>
                          <h5> Rp. 5.000.000,00</h5>
                          <hr/>
                  </ul>
          </div>
      </div>
  </section>
</div>
<div class="col-6">
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
                                <p>{{$pengumuman->isi}}</p>
                              </div>
                              <!-- <div class="timeline-footer">
                                <a href="#" class="btn btn-primary btn-sm">Lihat Detail</a>
                              </div> -->
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
  <div class="col-3">
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
                  @foreach($data_pengguna as $pengguna)
                    <li class="item">
                      <div class="product-img">
                        <img src="/adminLTE/img/user.png" alt="Product Image" class="img-size-50">
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">{{$pengguna->name}}
                          <span class="badge badge-warning float-right">{{$pengguna->role}}</span></a>
                          <span class="product-description">
                            Email : {{$pengguna->email}}
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
  <div class="col-3">
  <section class="content card" style="padding: 10px 10px 10px 10px ">
  <div class="box">
          <div class="row">
              <div class="col">
                  <h4><i class="nav-icon fas fa-headset my-0 btn-sm-1"></i> Team Support</h4>
                  <hr>
              </div>
          </div>
          <div class="card-body p-0">
                  <ul class="products-list product-list-in-card pl-2 pr-2">
                  @foreach($data_pengguna as $pengguna)
                    <li class="item">
                      <div class="product-img">
                        <img src="/adminLTE/img/support.png" alt="Product Image" class="img-size-50">
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">{{$pengguna->name}}
                          <span class="badge badge-warning float-right">{{$pengguna->role}}</span></a>
                        <span class="product-description">
                          Email : {{$pengguna->email}}
                        </span>
                        <span class="product-description">
                          HP : {{$pengguna->email}}
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
