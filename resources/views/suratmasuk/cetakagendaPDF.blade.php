<html>
<head>
	<title>AGENDA SURAT MASUK</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 8pt;
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
        <h4>AGENDA SURAT MASUK</h4>
		<br>
	</center>

	<table class="table responsive-sm">
		<thead>
			<tr>
				<th>No</th>
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
			@foreach($suratmasuk as $masuk)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$masuk->isi}}</td>
				<td>{{$masuk->asal_surat}}</td>
				<td>{{$masuk->kode}}</td>
				<td>{{$masuk->no_surat}}</td>
                <td>{{$masuk->tgl_surat}}</td>
                <td>{{$masuk->tgl_terima}}</td>
                <td>{{$masuk->keterangan}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<footer>
		Aplikasi Manajemen Surat | Copyright &copy; <?php echo date("d-m-Y");?> 
    </footer>
</body>

</html>
