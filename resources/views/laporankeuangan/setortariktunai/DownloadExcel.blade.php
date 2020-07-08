<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LAPORAN SETOR TARIK TUNAI</title>
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
    <table class="table">
      <thead>
        <tr>
          <td colspan="6" align="center">
            <h6><b>LAPORAN SETOR DAN TARIK TUNAI TABUNGAN SISWA</b></h6>
          </td>
        </tr>
      </thead>
    </table>

    <!-- Table row -->
    <div class="row">
      <table class="table">
        <thead>
          <tr>
            <td colspan="6" align="center">
              <h6><b>DATA SETOR TUNAI</b></h6>
            </td>
          </tr>
        </thead>
      </table>
      <div class="col-6">
        <table class="table table-bordered table-head-fixed bg-white">
          <thead>
            <tr>
              <th><b>No.</b></th>
              <th><b>Nama Siswa</b></th>
              <th><b>Kelas</b></th>
              <th><b>Tanggal Setor</b></th>
              <th><b>Jumlah</b></th>
              <th><b>Petugas</b></th>
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
              <td>{{$setor->jumlah}}</td>
              <td>{{$setor->users->name}}</td>

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

      <table class="table">
        <thead>
          <tr>
            <td colspan="6" align="center">
              <h6><b>DATA TARIK TUNAI</b></h6>
            </td>
          </tr>
        </thead>
      </table>
      <div class="col-6">
        <table class="table table-bordered table-head-fixed bg-white">
          <thead>
            <tr>
              <th><b>No.</b></th>
              <th><b>Nama Siswa</b></th>
              <th><b>Kelas</b></th>
              <th><b>Tanggal Penarikan</b></th>
              <th><b>Jumlah</b></th>
              <th><b>Petugas</b></th>
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
              <td>{{$tarik->jumlah}}</td>
              <td>{{$tarik->users->name}}</td>
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