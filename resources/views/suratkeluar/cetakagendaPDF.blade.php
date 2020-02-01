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
		}
	</style>
	<center>
        <h5>AGENDA SURAT KELUAR</h4>
        <h3>ORGANISASI OYA OYO</h3>

	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Isi Ringkas </th>
				<th>Tujuan Surat</th>
				<th>Kode</th>
				<th>No. Surat</th>
				<th>Tgl. Surat</th>
				<th>Tgl. Catat</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($suratkeluar as $keluar)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$keluar->isi}}</td>
				<td>{{$keluar->tujuan_surat}}</td>
				<td>{{$keluar->kode}}</td>
				<td>{{$keluar->no_surat}}</td>
                <td>{{$keluar->tgl_surat}}</td>
                <td>{{$keluar->tgl_catat}}</td>
                <td>{{$keluar->keterangan}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</body>
</html>
