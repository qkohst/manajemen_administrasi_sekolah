@extends('layouts.master')

@section('content')
<section style="padding: 10px 10px 10px 10px ">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="callout callout-info">
          <h5><i class="fas fa-info"></i> Catatan :</h5>
          Untuk Mencetak Data, Silahkan klik tombol cetak yang berada dibawah halaman !
        </div>


        <!-- Main content -->
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-money-check-alt"></i> Rincian Tagihan Pembayaran Siswa
              </h4>
              <hr>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              <address>
                Kelas : <strong>{{$header->rombel->nama_rombel}}</strong><br>
                Tahun Pelajaran : {{$header->rombel->tapel->tahun}} <br>
                Semester : {{$header->rombel->tapel->semester}}
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              Wali Kelas :
              <address>
                <strong>{{$header->rombel->guru->nama}}</strong>
              </address>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <!-- Table row -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header bg-light p-2">
                      <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active btn-sm" href="#laki_laki" data-toggle="tab"><i class="fas fa-male"></i> Laki-Laki</a></li>
                        <li class="nav-item"><a class="nav-link btn-sm" href="#perempuan" data-toggle="tab"><i class="fas fa-female"></i> Perempuan</a></li>
                      </ul>
                    </div>
                    <div class="card-body">
                      <div class="tab-content">
                        <div class="active tab-pane" id="laki_laki">
                          <div class="row">
                            <div class="row table-responsive">
                              <div class="col-12">
                                <table class="table table-striped" id="tabelTagihanInvoice1">
                                  <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Rincian</th>
                                      <th>Nominal Pembayaran </th>
                                      <th>Batas Waktu Pembayaran</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $no = 0; ?>
                                    @foreach($data_tagihan_L as $tagihan_L)
                                    <?php $no++; ?>
                                    <tr>
                                      <td>{{$no}}</td>
                                      <td>{{$tagihan_L->rincian}}</td>
                                      <td>@currency($tagihan_L->nominal),00</td>
                                      <td>{{$tagihan_L->batas_bayar}}</td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                      <td colspan="2" align="center"><b>Total Tagihan</b></td>
                                      <td colspan="2" align="left">
                                        <?php
                                        $jumlah_tagihan =  \App\Tagihan::where('rombel_id', '=', $filter)
                                          ->where(function ($query) {
                                            $query->where('jenis_kelamin', 'Laki-Laki')
                                              ->orWhere('jenis_kelamin', 'Semua');
                                          })->sum('nominal');
                                        ?>
                                        <b>@currency($jumlah_tagihan),00</b><br>
                                      </td>
                                    </tr>
                                  </tfoot>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="row no-print">
                            <div class="col-12">
                              <a class="btn btn-danger btn-sm my-1 mr-1 float-right" href="/pembayaran/tagihan/index" role="button"><i class="fas fa-undo"></i> KEMBALI</a>
                              <a href="/pembayaran/tagihan/{{$header->rombel_id}}/print" target="_blank" class="btn btn-primary btn-sm my-1 mr-1 float-right"><i class="fas fa-print"></i> CETAK</a>
                            </div>
                          </div>
                        </div>

                        <div class="tab-pane" id="perempuan">
                          <div class="row">
                            <div class="row table-responsive">
                              <div class="col-12">
                                <table class="table table-striped" id="tabelTagihanInvoice2">
                                  <thead>
                                    <tr>
                                      <th>No.</th>
                                      <th>Rincian</th>
                                      <th>Nominal Pembayaran </th>
                                      <th>Batas Waktu Pembayaran</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $no = 0; ?>
                                    @foreach($data_tagihan_P as $tagihan_P)
                                    <?php $no++; ?>
                                    <tr>
                                      <td>{{$no}}</td>
                                      <td>{{$tagihan_P->rincian}}</td>
                                      <td>@currency($tagihan_P->nominal),00</td>
                                      <td>{{$tagihan_P->batas_bayar}}</td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                      <td colspan="2" align="center"><b>Total Tagihan</b></td>
                                      <td colspan="2" align="left">
                                        <?php
                                        $jumlah_tagihan =  \App\Tagihan::where('rombel_id', '=', $filter)
                                          ->where(function ($query) {
                                            $query->where('jenis_kelamin', 'Perempuan')
                                              ->orWhere('jenis_kelamin', 'Semua');
                                          })->sum('nominal');
                                        ?>
                                        <b>@currency($jumlah_tagihan),00</b>
                                      </td>
                                    </tr>
                                  </tfoot>
                                </table>
                              </div>
                            </div>
                          </div>
                          <div class="row no-print">
                            <div class="col-12">
                              <a class="btn btn-danger btn-sm my-1 mr-sm-1 float-right" href="/pembayaran/tagihan/index" role="button"><i class="fas fa-undo"></i> KEMBALI</a>
                              <a href="/pembayaran/tagihan/{{$header->rombel_id}}/print" target="_blank" class="btn btn-primary btn-sm my-1 mr-sm-1 float-right"><i class="fas fa-print"></i> CETAK</a>
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
        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection