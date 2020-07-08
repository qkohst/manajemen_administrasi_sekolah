<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LAPORAN_SETOR_TARIK_TUNAI</title>
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
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-2 invoice-col">
                  <img id="logo" src="{{ asset($inst->file) }}" alt="Logo Instansi" class="rounded" width="75">
                </div>
                <!-- /.col -->
                <div class="col-sm-8 invoice-col">
                  <center>
                    <address class="justify-content-center">
                      <strong>{{ $inst->nama }}</strong><br>
                      Alamat : {{ $inst->alamat }}<br>
                      Email : {{ $inst->email }}
                    </address>
                  </center>
                </div>
                <div class="col-sm-2 invoice-col">

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <table class="table">
                <thead>
                  <tr>
                    <td colspan="8" align="center">
                      <h6><b>LAPORAN SETOR DAN TARIK TUNAI TABUNGAN SISWA</b></h6>
                    </td>
                  </tr>
                </thead>
              </table>
              <!-- /.row -->
              <div class="row">
                <div class="col-6">
                  <i class="fas fa-credit-card"></i><b> Data Setor Tunai</b>
                </div>
                <div class="col-6">
                  <i class="fas fa-credit-card"></i><b> Data Tarik Tunai</b>
                </div>
              </div>

              <!-- Table row -->
              <div class="row">
                <div class="col-6">
                  <table class="table table-bordered table-head-fixed bg-white">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nama Pesdik</th>
                        <th>Kelas</th>
                        <th>Tanggal Setor</th>
                        <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 0; ?>
                      @foreach($data_setor as $setor)
                      <?php $no++; ?>
                      <tr>
                        <td>{{$no}}</td>
                        <td>{{$setor->pesdik->nama}}</td>
                        <td>{{$setor->rombel->nama_rombel}} {{$setor->rombel->tapel->semester}} {{$setor->pesdik->rombel->tapel->tahun}}</td>
                        <td>{{$setor->tanggal}}</td>
                        <td>@currency($setor->jumlah),00</td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="4" align="center"><b>Total Setor Tunai</b></td>
                        <td align="left">
                          <b>@currency($total_setor),00</b>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <div class="col-6">
                  <table class="table table-bordered table-head-fixed bg-white">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nama Pesdik</th>
                        <th>Kelas</th>
                        <th>Tanggal Penarikan</th>
                        <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 0; ?>
                      @foreach($data_tarik as $tarik)
                      <?php $no++; ?>
                      <tr>
                        <td>{{$no}}</td>
                        <td>{{$tarik->pesdik->nama}}</td>
                        <td>{{$tarik->rombel->nama_rombel}} {{$tarik->rombel->tapel->semester}} {{$tarik->pesdik->rombel->tapel->tahun}}</td>
                        <td>{{$tarik->tanggal}}</td>
                        <td>@currency($tarik->jumlah),00</td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="4" align="center"><b>Total Tarik Tunai</b></td>
                        <td align="left">
                          <b>@currency($total_tarik),00</b>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
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