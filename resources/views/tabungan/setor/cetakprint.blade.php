<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tanda Bukti Tarik Tunai No_{{$setor->pesdik->nisn}}-0{{$setor->id}}</title>
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
                    <i class="fas fa-credit-card"></i> Tanda Bukti Setor Tunai
                    <small class="float-right">Tanggal Cetak : <?php echo date("d-m-Y h:i:s"); ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Telah terima dari :
                  <address>
                    <strong>{{$setor->pesdik->nama}}</strong><br>
                    Tempat, Tanggal Lahir : {{$setor->pesdik->tempat_lahir}}, {{$setor->pesdik->tanggal_lahir}}<br>
                    Jenis Kelamin : {{$setor->pesdik->jenis_kelamin}}<br>
                    NISN/Induk : {{$setor->pesdik->nisn}}/{{$setor->pesdik->induk}}<br>
                    Rombel : {{$setor->pesdik->rombel->nama_rombel}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Petugas :
                  <address>
                    <strong>{{$setor->users->name}}</strong><br>
                    Email : {{$setor->users->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <br>
                  <b>Nomor Berkas : *{{$setor->pesdik->nisn}}-0{{$setor->id}}</b><br>
                  <b>Tanggal Catat :</b> {{$setor->created_at}}<br><br>
                  Lembar Untuk Penyetor<br>

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nomor Transaksi</th>
                        <th>Tanggal</th>
                        <th>Keterangan </th>
                        <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>ST0{{$setor->id}}</td>
                        <td>{{$setor->tanggal}}</td>
                        <td>{{$setor->keterangan}}</td>
                        <td>@currency($setor->jumlah),00</td>
                      </tr>
                    </tbody>
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
                    - Mohon disimpan sebagai bukti setor tunai yang sah <br>
                    - Komplain tidak dilayani tanpa menunjukkan bukti setor ini
                  </p>
                  <div class="row">
                    <div class="col-1">

                    </div>
                    <div class="col-6">
                      Penyetor <br><br><br>
                      <strong>{{$setor->pesdik->nama}}</strong>
                    </div>
                    <div class="col-5">
                      Petugas <br><br><br>
                      <strong>{{$setor->users->name}}</strong>
                    </div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Rekap Tabungan Siswa :</p>
                  <?php
                  $id = $setor->pesdik->id;
                  $total_setor = DB::table('setor')->where('setor.pesdik_id', '=', $id)
                    ->sum('setor.jumlah');
                  $total_tarik = DB::table('tarik')->where('tarik.pesdik_id', '=', $id)
                    ->sum('tarik.jumlah');
                  ?>
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Total Setor Tunai</th>
                        <td>@currency($total_setor),00</td>
                      </tr>
                      <tr>
                        <th>Total Tarik Tunai</th>
                        <td>@currency($total_tarik),00</td>
                      </tr>
                      <tr>
                        <th>Sisa Saldo</th>
                        <td>@currency($total_setor-$total_tarik),00</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
        <br><br><br><br><br>
        <hr>
        <br>
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-credit-card"></i> Tanda Bukti Setor Tunai
                    <small class="float-right">Tanggal Cetak : <?php echo date("d-m-Y h:i:s"); ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Telah terima dari :
                  <address>
                    <strong>{{$setor->pesdik->nama}}</strong><br>
                    Tempat, Tanggal Lahir : {{$setor->pesdik->tempat_lahir}}, {{$setor->pesdik->tanggal_lahir}}<br>
                    Jenis Kelamin : {{$setor->pesdik->jenis_kelamin}}<br>
                    NISN/Induk : {{$setor->pesdik->nisn}}/{{$setor->pesdik->induk}}<br>
                    Rombel : {{$setor->pesdik->rombel->nama_rombel}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Petugas :
                  <address>
                    <strong>{{$setor->users->name}}</strong><br>
                    Email : {{$setor->users->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <br>
                  <b>Nomor Berkas : *{{$setor->pesdik->nisn}}-0{{$setor->id}}</b><br>
                  <b>Tanggal Catat :</b> {{$setor->created_at}}<br><br>
                  Lembar Untuk Petugas<br>

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nomor Transaksi</th>
                        <th>Tanggal</th>
                        <th>Keterangan </th>
                        <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>ST0{{$setor->id}}</td>
                        <td>{{$setor->tanggal}}</td>
                        <td>{{$setor->keterangan}}</td>
                        <td>@currency($setor->jumlah),00</td>
                      </tr>
                    </tbody>
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
                    - Mohon disimpan sebagai bukti setor tunai yang sah <br>
                    - Komplain tidak dilayani tanpa menunjukkan bukti setor ini
                  </p>
                  <div class="row">
                    <div class="col-1">

                    </div>
                    <div class="col-6">
                      Penyetor <br><br><br>
                      <strong>{{$setor->pesdik->nama}}</strong>
                    </div>
                    <div class="col-5">
                      Petugas <br><br><br>
                      <strong>{{$setor->users->name}}</strong>
                    </div>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Rekap Tabungan Siswa :</p>
                  <?php
                  $id = $setor->pesdik->id;
                  $total_setor = DB::table('setor')->where('setor.pesdik_id', '=', $id)
                    ->sum('setor.jumlah');
                  $total_tarik = DB::table('tarik')->where('tarik.pesdik_id', '=', $id)
                    ->sum('tarik.jumlah');
                  ?>
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Total Setor Tunai</th>
                        <td>@currency($total_setor),00</td>
                      </tr>
                      <tr>
                        <th>Total Tarik Tunai</th>
                        <td>@currency($total_tarik),00</td>
                      </tr>
                      <tr>
                        <th>Sisa Saldo</th>
                        <td>@currency($total_setor-$total_tarik),00</td>
                      </tr>
                    </table>
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