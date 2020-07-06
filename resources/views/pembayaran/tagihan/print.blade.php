<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Rekap Tagihan Pembayaran {{$header->rombel->nama_rombel}} {{$header->rombel->tapel->tahun}} {{$header->rombel->tapel->semester}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/adminLTE/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminLTE/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminLTE/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="/adminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/adminLTE/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminLTE/css/adminlte.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/adminLTE/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/adminLTE/plugins/summernote/summernote-bs4.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/adminLTE/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/adminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
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
                <div class="col-sm-5 invoice-col">
                  <address>
                    <strong>{{$data_instansi->nama}}</strong><br>
                    Alamat : {{$data_instansi->alamat}} <br>
                    Email : {{$data_instansi->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <address>
                    Kelas : <strong>{{$header->rombel->nama_rombel}}</strong><br>
                    Tahun Pelajaran : {{$header->rombel->tapel->tahun}} <br>
                    Semester : {{$header->rombel->tapel->semester}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                  Wali Kelas :
                  <address>
                    <strong>{{$header->rombel->guru->nama}}</strong>
                  </address>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-6">
                  <b>Laki-Laki</b>
                </div>
                <div class="col-6">
                  <b>Perempuan</b>
                </div>
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-6">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Rincian</th>
                        <th>Nominal </th>
                        <th>Batas Waktu</th>
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
                        <td colspan="2" align="center"><b>Total Tagihan Laki-Laki</b></td>
                        <td colspan="2" align="left">
                          <?php
                          $jumlah_tagihan_L = DB::table('tagihan')
                            ->where('rombel_id', '=', $filter)
                            ->where(function ($query) {
                              $query->where('jenis_kelamin', 'Laki-Laki')
                                ->orWhere('jenis_kelamin', 'Semua');
                            })->sum('nominal');
                          ?>
                          <b>@currency($jumlah_tagihan_L),00</b>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <div class="col-6">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Rincian</th>
                        <th>Nominal </th>
                        <th>Batas Waktu</th>
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
                        <td colspan="2" align="center"><b>Total Tagihan Perempuan</b></td>
                        <td colspan="2" align="left">
                          <?php
                          $jumlah_tagihan_P = DB::table('tagihan')
                            ->where('rombel_id', '=', $filter)
                            ->where(function ($query) {
                              $query->where('jenis_kelamin', 'Perempuan')
                                ->orWhere('jenis_kelamin', 'Semua');
                            })->sum('nominal');
                          ?>
                          <b>@currency($jumlah_tagihan_P),00</b>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <hr>
              <br>
              <!-- /.row -->
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Catatan :</p>
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 5px;">
                    - Pembayaran dapat diangsur sesuai dengan batas waktu pembayaran <br>
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="row">
                    <div class="col-1">

                    </div>
                    <div class="col-6">
                      Kepala Sekolah <br><br><br>
                      <strong>{{$data_instansi->pimpinan}}</strong>
                    </div>
                    <div class="col-5">
                      Petugas <br><br><br>
                      <strong>{{auth()->user()->name}}</strong>
                    </div>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->

  <script type="text/javascript">
    window.addEventListener("load", window.print());
  </script>
  <script src="/adminLTE/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/adminLTE/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Select2 -->
  <script src="/adminLTE/plugins/select2/js/select2.full.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/adminLTE/js/adminlte.min.js"></script>
  <!-- Ekko Lightbox -->
  <script src="/adminLTE/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
  <!-- Filterizr-->
  <script src="/adminLTE/plugins/filterizr/jquery.filterizr.min.js"></script>
  <!-- Data Table -->
  <script src="/adminLTE/plugins/datatables/jquery.dataTables.js"></script>
  <script src="/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <!-- overlayScrollbars -->
  <script src="/adminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="/adminLTE/js/demo.js"></script>
</body>

</html>