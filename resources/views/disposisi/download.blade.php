<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lembar Disposisi Surat Masuk</title>
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
                                <!-- /.col -->
                                <div class="col-sm-2 invoice-col">

                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <td colspan="6" align="center">
                                                <br>
                                                <h6><b>LEMBAR DISPOSISI SURAT</b></h6>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tanggal Surat
                                            </td>
                                            <td colspan="4"> {{ $smasuk->tgl_surat }}</td>
                                            <td>Kode : {{ $smasuk->klasifikasi->kode }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Nomor Surat
                                            </td>
                                            <td colspan="5"> {{ $smasuk->no_surat }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Asal Surat
                                            </td>
                                            <td colspan="5"> {{ $smasuk->asal_surat }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Isi Ringkas
                                            </td>
                                            <td colspan="5"> {{ $smasuk->isi }}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Diterima Tanggal
                                            </td>
                                            <td colspan="5">
                                                {{ $smasuk->tgl_terima }}<br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                No. Agenda
                                            </td>
                                            <td colspan="5">
                                                {{ $smasuk->id  }}<br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Diteruskan Kepada
                                            </td>
                                            <td colspan="5">
                                                {{ $disp->tujuan }}<br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Isi Disposisi
                                            </td>
                                            <td colspan="5">
                                                {{ $disp->isi }}<br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Batas Waktu
                                            </td>
                                            <td colspan="5">
                                                {{ $disp->batas_waktu }}<br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Sifat
                                            </td>
                                            <td colspan="5">
                                                {{ $disp->sifat }}<br>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Catatan
                                            </td>
                                            <td colspan="5">
                                                {{ $disp->catatan }}<br>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <br>
                            <p align="right"> Kepala Sekolah, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <br><br><br><br> <u><b>{{ $inst->pimpinan}}</b></u>
                            </p>
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