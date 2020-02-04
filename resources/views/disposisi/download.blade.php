<html>
<head>
	<title>AGENDA SURAT KELUAR</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
            border: 1px solid red;
		}
		footer {
                position: fixed; 
                bottom: -20px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

                /** Extra personal styles **/
                text-align: center;
                line-height: 35px;
        }
	</style>
	<center>
        <h5>SMP DARUT TAUHID TAMBAKBOYO</h5>
        <p align="center"> Alamat       : Jl. KH. Ashary Pabeyan Tambakboyo-Tuban </p>
        <p align="center"> Email       : s.daruttauhid@gmail.com </p>
		<hr />
	</center>
	<table class="table table-bordered">
		<tr>
            <td colspan="2" align="center"><b>LEMBAR DISPOSISI</b></td>
        </tr>
        <tr>
            <td>Kode Klasifikasi : {{ $smasuk->kode }}</td>
            <td>Tanggal Surat : {{ $smasuk->tgl_surat}}</td>
        </tr>
        <tr>
            <td colspan="2"> Nomor Surat : {{ $smasuk->no_surat }}</td>
        </tr>
        <tr>
            <td colspan="2">Asal Surat : {{ $smasuk->asal_surat }}</td>
        </tr>
        <tr>
            <td colspan="2">Isi Ringkas : {{ $smasuk->isi }}</td>
        </tr>
        <tr>
            <td>Diterima Tanggal : {{ $smasuk->tgl_terima }}</td>
            <td>No. Agenda : {{ $smasuk->id}}</td>
        </tr>
        <tr>
            <td colspan="2">Diteruskan Kepada : {{ $disp->tujuan }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <b>Isi Disposisi : </b><br>
                {{ $disp->isi }} <br>
                <b>Batas Waktu : </b>{{ $disp->batas_waktu }}<br>
                <b>Sifat : </b>{{ $disp->sifat }}<br>   
                <b>Catatan : </b>{{ $disp->catatan }}<br>   
            </td>
        </tr>
        <tr>
            <td>Dientry Pada : <?php echo date("d-m-Y h:i:s");?></td>
            <td>Petugas : {{$disp->users_id}}</td>
        </tr>
	</table>
    <div class="row">
        <div class="col-6">
        </div>
        <div class="col-6">
        <p align="left"> Kepala Sekolah </p>
        <p align="left"> <b>MOCH. MUNIR, S.E.</b> </p>
        </div>
    </div>
	<footer>
		Aplikasi Manajemen Surat | Copyright &copy; <?php echo date("d-m-Y ");?> 
    </footer>
</body>
</html>
