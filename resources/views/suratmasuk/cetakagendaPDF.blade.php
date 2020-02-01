<html>
<head>
	<title>AGENDA SURAT MASUK</title>
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
        <h5>AGENDA SURAT MASUK</h4>
        <h3>ORGANISASI OYA OYO</h3>

	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Isi Ringkas </th>
				<th>Asal Surat</th>
				<th>Kode</th>
				<th>No. Surat</th>
				<th>Tgl. Surat</th>
				<th>Tgl. Diterima</th>
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

</body>
</html>
