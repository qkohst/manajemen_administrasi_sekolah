<html>

<head>
    <title>LEMBAR DISPOSISI SURAT</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 11pt;
        }

        footer {
            position: fixed;
            bottom: -40px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 9pt;

            /** Extra personal styles **/
            text-align: center;
            line-height: 35px;
        }

        .line {
            line-height: 50%;
        }
    </style>
    <div class="row">
        <center class="line">
            <img src="{{ public_path($inst->file) }}" width="80">
            <h2>{{ $inst->nama }}</h2>
            <p>Alamat : {{ $inst->alamat }} </p>
            <p>Email : {{ $inst->email }} </p>
            <hr>
        </center>
    </div>
    <table class="table table-bordered table-active" bgcolor="#FFFFFF">
        <tr>
            <td colspan="6" align="center">
                <h6>LEMBAR DISPOSISI</h6>
            </td>
        </tr>
        <tr>
            <td>
                Tanggal Surat
            </td>
            <td colspan="4"> {{ $smasuk->tgl_surat }}</td>
            <td rowspan="2">Kode : <br> <b>{{ $smasuk->kode }}</b></td>
        </tr>
        <tr>
            <td>
                Nomor Surat
            </td>
            <td colspan="4"> {{ $smasuk->no_surat }}</td>
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
    <br>
    <p align="right"> Kepala, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <br><br><br><br> <u><b>{{ $inst->pimpinan}}</b></u> </p>
    </div>
    <footer>
        Copyright &copy; | Aplikasi Manajemen Surat | <?php echo date("d-m-Y h:i:s");?>
    </footer>
</body>

</html>
