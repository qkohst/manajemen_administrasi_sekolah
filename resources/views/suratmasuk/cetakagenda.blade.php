<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AGENDA SURAT MASUK</title>
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

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <td colspan="8" align="center">
                          <h6><b>AGENDA SURAT MASUK</b></h6>
                        </td>
                      </tr>
                      <tr>
                        <th>No.</th>
                        <th>Isi Ringkas </th>
                        <th>Asal Surat</th>
                        <th>Kode</th>
                        <th>No. Surat</th>
                        <th>Tgl. Surat</th>
                        <th>Tgl. Terima</th>
                        <th>Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i=1 @endphp
                      @foreach($data_suratmasuk as $masuk)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{$masuk->isi}}</td>
                        <td>{{$masuk->asal_surat}}</td>
                        <td>{{$masuk->klasifikasi->kode}}</td>
                        <td>{{$masuk->no_surat}}</td>
                        <td>{{$masuk->tgl_surat}}</td>
                        <td>{{$masuk->tgl_terima}}</td>
                        <td>{{$masuk->keterangan}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col">
                  <p class="lead">Catatan :</p>
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 5px;">
                    - Data yang dicetak adalah agenda surat masuk dari tanggal {{$tgl1}} sampai tanggal {{$tgl2}}
                  </p>
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