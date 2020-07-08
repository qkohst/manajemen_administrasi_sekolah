<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>LAPORAN KEUANGAN SEKOLAH</title>
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
          <td colspan="5" align="center">
            <h6><b>LAPORAN KEUANGAN SEKOLAH</b></h6>
          </td>
        </tr>
      </thead>
    </table>

    <!-- Table row -->
    <div class="row">
      <table class="table">
        <thead>
          <tr>
            <td colspan="5" align="center">
              <h6><b>DATA PEMASUKAN SEKOLAH</b></h6>
            </td>
          </tr>
        </thead>
      </table>
      <div class="col-6">
        <table class="table table-bordered table-head-fixed bg-white">
          <thead>
            <tr>
              <th><b>No.</b></th>
              <th><b>Kategori</b></th>
              <th><b>Tanggal</b></th>
              <th><b>Jumlah</b></th>
              <th><b>Keterangan</b></th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 0; ?>
            @foreach($data_pemasukan as $pemasukan)
            <?php $no++; ?>
            <tr>
              <td>{{$no}}</td>
              <td>{{$pemasukan->kategori->nama_kategori}}</td>
              <td>{{$pemasukan->created_at}}</td>
              <td>{{$pemasukan->jumlah}}</td>
              <td>{{$pemasukan->keterangan}}</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" align="center"><b>Total Pemasukan</b></td>
              <td colspan="2" align="left">
                <b>@currency($total_pemasukan),00</b>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>

      <table class="table">
        <thead>
          <tr>
            <td colspan="5" align="center">
              <h6><b>DATA PENGELUARAN SEKOLAH</b></h6>
            </td>
          </tr>
        </thead>
      </table>
      <div class="col-6">
        <table class="table table-bordered table-head-fixed bg-white">
          <thead>
            <tr>
              <th><b>No.</b></th>
              <th><b>Kategori</b></th>
              <th><b>Tanggal</b></th>
              <th><b>Jumlah</b></th>
              <th><b>Keterangan</b></th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 0; ?>
            @foreach($data_pengeluaran as $pengeluaran)
            <?php $no++; ?>
            <tr>
              <td>{{$no}}</td>
              <td>{{$pengeluaran->kategori->nama_kategori}}</td>
              <td>{{$pengeluaran->created_at}}</td>
              <td>{{$pengeluaran->jumlah}}</td>
              <td>{{$pengeluaran->keterangan}}</td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" align="center"><b>Total Pengeluaran</b></td>
              <td colspan="2" align="left">
                <b>@currency($total_pengeluaran),00</b>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>

      <table class="table">
        <thead>
          <tr>
            <td colspan="3" align="center"><b>SISA SALDO</b></td>
            <td colspan="2" align="left">
              <b>@currency($total_pemasukan-$total_pengeluaran),00</b>
            </td>
          </tr>
        </thead>
      </table>
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