@extends('layouts.master')

@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
  <div class="box">
    <h4><i class="nav-icon far fa-handshake nav-icon my-1 btn-sm-1"></i> Rekap Pembayaran Siswa</h4>
    <hr>
    <section class="content">
      <div class="container-fluid">
        <div class="row table-responsive">
          <div class="col-md-12">
            <table class="table table-hover table-head-fixed bg-white" id='tabelAgendaMasuk'>
              <thead>
                <tr>
                  <th>Kelas</th>
                  <th>Rincian</th>
                  <th>Batas Pembayaran</th>
                  <th>Tagihan</th>
                  <th>Terbayar</th>
                  <th>Sisa Tagihan</th>
                </tr>
              </thead>
              <tbody>
                @foreach($tagihan_siswa as $tagih)
                <tr>
                  <td>{{$tagih->rombel->nama_rombel}} {{$tagih->rombel->tapel->semester}}</td>
                  <td>{{$tagih->rincian}}</td>
                  <td>{{$tagih->batas_bayar}}</td>
                  <td>@currency($tagih->nominal),00</td>
                  <td>@currency($tagih->jumlah_bayar),00</td>
                  <td>@currency($tagih->nominal-$tagih->jumlah_bayar),00</td>
                </tr>
                @endforeach
                @foreach($tagihan_terbayar as $terbayar)
                <tr>
                  <td>{{$terbayar->rombel->nama_rombel}} {{$terbayar->rombel->tapel->semester}}</td>
                  <td>{{$terbayar->rincian}}</td>
                  <td>{{$terbayar->batas_bayar}}</td>
                  <td>@currency($terbayar->nominal),00</td>
                  <td>@currency($terbayar->jumlah_bayar),00</td>
                  <td>@currency($terbayar->nominal-$terbayar->jumlah_bayar),00</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="3" align="center"><b>Jumlah</b></td>
                  <td align="left"><b>@currency($jumlah_tagihan),00</b><br></td>
                  <td align="left"><b>@currency($jumlah_terbayar),00</b><br></td>
                  <td align="left"><b>@currency($jumlah_tagihan-$jumlah_terbayar),00</b><br></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  </div>
</section>
@endsection