<html>
<head>
	<title>LEMBAR DISPOSISI SURAT</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 11pt;
            border: 1px solid red;
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
        .table-borderless th {
            border: 0;
        }
        .table-borderless td {
            border: 1;
        }
     </style>
    <div class="row">
            <center>
                <b>{{ $inst->nama}}</b><br> 
                Alamat : {{ $inst->alamat}} <br>
                Email : {{ $inst->email}} <hr>
            <center>
    </div>
	<table class="table table-bordered">
		<tr>
            <td colspan="2" align="center"><b>LEMBAR DISPOSISI</b></td>
        </tr>
        <tr>
            <td>Kode Klasifikasi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $smasuk->kode }}</td>
            <td>Tanggal Surat : {{ $smasuk->tgl_surat}}</td>
        </tr>
        <tr>
            <td colspan="2"> Nomor Surat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
            {{ $smasuk->no_surat }}</td>
        </tr>
        <tr>
            <td colspan="2">Asal Surat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
            {{ $smasuk->asal_surat }}</td>
        </tr>
        <tr>
            <td colspan="2">Isi Ringkas &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
            {{ $smasuk->isi }}</td>
        </tr>
        <tr>
            <td>Diterima Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $smasuk->tgl_terima }}</td>
            <td>No. Agenda : {{ $smasuk->id}}</td>
        </tr>
        <tr>
            <td colspan="2">Diteruskan Kepada &nbsp;&nbsp;: {{ $disp->tujuan }}</td>
        </tr>
        <tr>
        <table class="table table-borderless table-condensed table-hover">
            <tr>
                <td width="75">
                <b>Isi Disposisi</b>
                </td>
                <td colspan="2">
                : {{ $disp->isi }}<br>
                </td>
            </tr>
            <tr>
                <td width="75">
                <b>Batas Waktu</b>
                </td>
                <td colspan="2">
                : {{ $disp->batas_waktu }}<br>
                </td>
            </tr>
            <tr>
                <td width="75">
                <b>Sifat</b>
                </td>
                <td colspan="2">
                : {{ $disp->sifat }}<br>
                </td>
            </tr>
            <tr>
                <td width="75">
                <b>Catatan</b>
                </td>
                <td colspan="2">
                : {{ $disp->catatan }}<br>
                </td>
            </tr>
        </table>
        </tr>
	</table>
        <br><p align="right"> Kepala, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <br><br><br><br> <u><b>{{ $inst->pimpinan}}</b></u> </p>
    </div>
	<footer>
		Aplikasi Manajemen Surat | Copyright &copy; <?php echo date("d-m-Y h:i:s");?> 
        <!-- | id_user : {{ $disp->users_id }} -->
    </footer>
</body>
</html>
