<html>

<head>
    <title>AGENDA SURAT KELUAR</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
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

        .line {
            line-height: 40%;
        }
    </style>
    <div class="row">
        <center class="line">
            <img src="{{ public_path($inst->file) }}" width="80">
            <h2>{{ $inst->nama }}</h2>
            <p>Alamat : {{ $inst->alamat }} </p>
            <p>Email : {{ $inst->email }} </p>
        </center>
    </div>

    <table class="table responsive-sm">
        <tr>
            <td colspan="8" align="center">
                <h6>AGENDA SURAT KELUAR</h6>
            </td>
        </tr>
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
    <footer>
        Aplikasi Manajemen Surat | Copyright &copy; <?php echo date("d-m-Y");?>
    </footer>
</body>

</html>
