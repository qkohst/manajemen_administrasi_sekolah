@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class=" callout callout-primary alert alert-success alert-dismissible fade show" role="alert">
          <h5><i class="fas fa-info"></i> Informasi :</h5>
          - Data pembayaran telah tersimpan <br>
          - Halaman ini dapat dicetak sebagai bukti transaksi <br>
          - Silahkan klik tombol CETAK yang berada dibawah halaman ! <br>
          - Kemudian klik tombol KEMBALI !
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
                <i class="nav-icon far fa-handshake nav-icon my-1 btn-sm-1"></i> Tanda Bukti Transaksi Pembayaran
              </h4>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              Telah terima dari :
              <address>
                <strong>{{$identitas->pesdik->nama}}</strong><br>
              </address>
              Pada Tanggal :
              <address>
                <strong> <?php echo date("d-m-Y"); ?> </strong><br>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              Identitas Siswa :
              <address>
                Tempat, Tanggal Lahir : {{$identitas->pesdik->tempat_lahir}}, {{$identitas->pesdik->tanggal_lahir}}<br>
                Jenis Kelamin : {{$identitas->pesdik->jenis_kelamin}}<br>
                NISN/Induk : {{$identitas->pesdik->nisn}}/{{$identitas->pesdik->induk}}<br>
                Rombel Saat Ini : {{$identitas->pesdik->rombel->nama_rombel}}
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              Petugas :
              <address>
                <strong>{{$identitas->users->name}}</strong><br>
                Email : {{$identitas->users->email}}
              </address>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-bordered table-head-fixed bg-white">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Rincian</th>
                    <th>Nominal Dibayar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0; ?>
                  @foreach($tagihan_dibayar as $dibayar)
                  <?php $no++; ?>
                  <tr>
                    <td>{{$no}}</td>
                    <td>{{$dibayar->pesdik->rombel->nama_rombel}} {{$dibayar->pesdik->rombel->tapel->semester}} {{$dibayar->pesdik->rombel->tapel->tahun}}</td>
                    <td>{{$dibayar->tagihan->rincian}}</td>
                    <td>@currency($dibayar->jumlah_bayar),00</td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <?php
                    $total_dibayar = \App\TransaksiPembayaran::whereIn('tagihan_id', $tagihan_id)->where('pesdik_id', $pesdik_id)->sum('jumlah_bayar');
                    ?>
                    <td colspan="3" align="center"><b>Jumlah Dibayar</b></td>
                    <td align="left">
                      <b>@currency($total_dibayar),00</b>
                    </td>
                  </tr>
                </tfoot>
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
                - Mohon disimpan sebagai bukti pembayaran yang sah <br>
                - Komplain tidak dilayani tanpa menunjukkan bukti pembayaran ini
              </p>
            </div>
            <!-- /.col -->
            <div class="col-3">
              Penyetor <br><br><br>
              <strong>{{$identitas->pesdik->nama}}</strong><br>
            </div>
            <div class="col-3">
              Petugas <br><br><br>
              <strong>{{$identitas->users->name}}</strong><br>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-12">
              <form action="/pembayaran/transaksipembayaran/cetak_invoice" method="POST" target="_blank">
                {{csrf_field()}}
                @foreach($tagihan_id as $id_tagih)
                <input name="id_tagih[]" type="text" class="d-none" id="id_tagih[]" value="{{$id_tagih}}">
                @endforeach
                @foreach($pesdik_id as $id_pesdik)
                <input name="id_pesdik[]" type="text" class="d-none" id="id_pesdik[]" value="{{$id_pesdik}}">
                @endforeach
                <button id="cetak" name="cetak" type="submit" class="btn btn-primary btn-sm my-1 mr-sm-1 float-right" onclick="viewKembali()"><i class="fas fa-print"></i> CETAK</button>
                <a id="kembali" name="kembali" class="btn btn-danger btn-sm my-1 mr-sm-1 float-right" href="index" style="display:none" role="button"><i class="fas fa-undo"></i> KEMBALI</a>
              </form>
            </div>
          </div>
        </div>
        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection