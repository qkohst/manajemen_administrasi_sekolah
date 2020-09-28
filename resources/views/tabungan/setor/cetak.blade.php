@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="callout callout-success alert alert-success alert-dismissible fade show">
          <h5><i class="fas fa-info"></i> Informasi :</h5>
          - Data setor tunai telah berhasil disimpan ! <br>
          - Halaman ini dapat dicetak sebagai bukti transaksi, Silahkan klik tombol CETAK yang berada dibawah halaman ! <br>
          - Klik tombol KEMBALI setelah selesai mecetak bukti setor tunai !
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <!-- Main content -->
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-credit-card"></i> Tanda Bukti Setor Tunai
                <small class="float-right">Tanggal Cetak : <?php echo date("d-m-Y h:i:s"); ?></small>
              </h4>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              Telah terima dari :
              <address>
                <strong>{{$setor->pesdik->nama}}</strong><br>
                Tempat, Tanggal Lahir : {{$setor->pesdik->tempat_lahir}}, {{$setor->pesdik->tanggal_lahir}}<br>
                Jenis Kelamin : {{$setor->pesdik->jenis_kelamin}}<br>
                NISN/Induk : {{$setor->pesdik->nisn}}/{{$setor->pesdik->induk}}<br>
                Rombel : {{$setor->pesdik->rombel->nama_rombel}}
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              Petugas :
              <address>
                <strong>{{$setor->users->name}}</strong><br>
                Email : {{$setor->users->email}}
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <br>
              <b>Nomor Berkas : *{{$setor->pesdik->nisn}}-0{{$setor->id}}</b><br>
              <b>Tanggal Catat :</b> {{$setor->created_at}}<br>

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
                    <th>No.</th>
                    <th>Nomor Transaksi</th>
                    <th>Tanggal</th>
                    <th>Keterangan </th>
                    <th>Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>ST0{{$setor->id}}</td>
                    <td>{{$setor->tanggal}}</td>
                    <td>{{$setor->keterangan}}</td>
                    <td>@currency($setor->jumlah),00</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
              <p class="lead">Catatan :</p>
              <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                - Mohon disimpan sebagai bukti setor tunai yang sah <br>
                - Komplain tidak dilayani tanpa menunjukkan bukti setor ini
              </p>
              <div class="row">
                <div class="col-1">

                </div>
                <div class="col-6">
                  Penyetor <br><br><br>
                  <strong>{{$setor->pesdik->nama}}</strong>
                </div>
                <div class="col-5">
                  Petugas <br><br><br>
                  <strong>{{$setor->users->name}}</strong>
                </div>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-6">
              <p class="lead">Rekap Tabungan Siswa :</p>
              <?php
              $id = $setor->pesdik->id;
              $total_setor = DB::table('setor')->where('setor.pesdik_id', '=', $id)
                ->sum('setor.jumlah');
              $total_tarik = DB::table('tarik')->where('tarik.pesdik_id', '=', $id)
                ->sum('tarik.jumlah');
              ?>
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Total Setor Tunai</th>
                    <td>@currency($total_setor),00</td>
                  </tr>
                  <tr>
                    <th>Total Tarik Tunai</th>
                    <td>@currency($total_tarik),00</td>
                  </tr>
                  <tr>
                    <th>Sisa Saldo</th>
                    <td><b>@currency($total_setor-$total_tarik),00</b></td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-12">
              <a class="btn btn-danger btn-sm my-1 mr-1 float-right" href="/tabungan/setor/index" role="button"><i class="fas fa-undo"></i> KEMBALI</a>
              <a href="/tabungan/setor/{{$setor->id}}/cetakprint" target="_blank" class="btn btn-primary btn-sm my-1 mr-1 float-right"><i class="fas fa-print"></i> CETAK</a>
            </div>
          </div>
        </div>
        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection