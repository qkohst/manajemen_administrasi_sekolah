<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tanda Bukti Tarik Tunai No_{{$identitas->pesdik_id}}</title>
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
                    <i class="nav-icon far fa-handshake nav-icon my-1 btn-sm-1"></i> Tanda Bukti Transaksi Pembayaran
                    <small class="float-right">Lembar Untuk Penyetor<br></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Telah terima dari :
                  <address>
                    <strong>{{$identitas->pesdik->nama}}</strong><br>
                  </address>
                  Pada Tanggal :
                  <address>
                    <strong> <?php echo date("d-m-Y"); ?> </strong><br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Identitas Siswa :
                  <address>
                    Tempat, Tanggal Lahir : {{$identitas->pesdik->tempat_lahir}}, {{$identitas->pesdik->tanggal_lahir}}<br>
                    Jenis Kelamin : {{$identitas->pesdik->jenis_kelamin}}<br>
                    NISN/Induk : {{$identitas->pesdik->nisn}}/{{$identitas->pesdik->induk}}<br>
                    Rombel Saat Ini : {{$identitas->pesdik->rombel->nama_rombel}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Petugas :
                  <address>
                    <strong>{{$identitas->users->name}}</strong><br>
                    Email : {{$identitas->users->email}}
                  </address>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-bordered table-head-fixed bg-white">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Rincian</th>
                        <th>Nominal Dibayar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 0; ?>
                      @foreach($tagihan_dibayar as $dibayar)
                      <?php $no++; ?>
                      <tr>
                        <td>{{$no}}</td>
                        <td>{{$dibayar->pesdik->rombel->nama_rombel}} {{$dibayar->pesdik->rombel->tapel->semester}} {{$dibayar->pesdik->rombel->tapel->tahun}}</td>
                        <td>{{$dibayar->tagihan->rincian}}</td>
                        <td>@currency($dibayar->jumlah_bayar),00</td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <?php
                        $total_dibayar = \App\TransaksiPembayaran::whereIn('tagihan_id', $tagihan_id)->where('pesdik_id', $pesdik_id)->sum('jumlah_bayar');
                        ?>
                        <td colspan="3" align="center"><b>Jumlah Dibayar</b></td>
                        <td align="left">
                          <b>@currency($total_dibayar),00</b>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Catatan :</p>
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    - Mohon disimpan sebagai bukti pembayaran yang sah <br>
                    - Komplain tidak dilayani tanpa menunjukkan bukti pembayaran ini
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-3">
                  Penyetor <br><br><br>
                  <strong>{{$identitas->pesdik->nama}}</strong><br>
                </div>
                <div class="col-3">
                  Petugas <br><br><br>
                  <strong>{{$identitas->users->name}}</strong><br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Untuk Memisah halaman -->
        <div style="page-break-after: always;"></div>

        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="nav-icon far fa-handshake nav-icon my-1 btn-sm-1"></i> Tanda Bukti Transaksi Pembayaran
                    <small class="float-right">Lembar Untuk Petugas<br></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Telah terima dari :
                  <address>
                    <strong>{{$identitas->pesdik->nama}}</strong><br>
                  </address>
                  Pada Tanggal :
                  <address>
                    <strong> <?php echo date("d-m-Y"); ?> </strong><br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Identitas Siswa :
                  <address>
                    Tempat, Tanggal Lahir : {{$identitas->pesdik->tempat_lahir}}, {{$identitas->pesdik->tanggal_lahir}}<br>
                    Jenis Kelamin : {{$identitas->pesdik->jenis_kelamin}}<br>
                    NISN/Induk : {{$identitas->pesdik->nisn}}/{{$identitas->pesdik->induk}}<br>
                    Rombel Saat Ini : {{$identitas->pesdik->rombel->nama_rombel}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Petugas :
                  <address>
                    <strong>{{$identitas->users->name}}</strong><br>
                    Email : {{$identitas->users->email}}
                  </address>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-bordered table-head-fixed bg-white">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Rincian</th>
                        <th>Nominal Dibayar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 0; ?>
                      @foreach($tagihan_dibayar as $dibayar)
                      <?php $no++; ?>
                      <tr>
                        <td>{{$no}}</td>
                        <td>{{$dibayar->pesdik->rombel->nama_rombel}} {{$dibayar->pesdik->rombel->tapel->semester}} {{$dibayar->pesdik->rombel->tapel->tahun}}</td>
                        <td>{{$dibayar->tagihan->rincian}}</td>
                        <td>@currency($dibayar->jumlah_bayar),00</td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <?php
                        $total_dibayar = \App\TransaksiPembayaran::whereIn('tagihan_id', $tagihan_id)->where('pesdik_id', $pesdik_id)->sum('jumlah_bayar');
                        ?>
                        <td colspan="3" align="center"><b>Jumlah Dibayar</b></td>
                        <td align="left">
                          <b>@currency($total_dibayar),00</b>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Catatan :</p>
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    - Mohon disimpan sebagai bukti pembayaran yang sah <br>
                    - Komplain tidak dilayani tanpa menunjukkan bukti pembayaran ini
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-3">
                  Penyetor <br><br><br>
                  <strong>{{$identitas->pesdik->nama}}</strong><br>
                </div>
                <div class="col-3">
                  Petugas <br><br><br>
                  <strong>{{$identitas->users->name}}</strong><br>
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