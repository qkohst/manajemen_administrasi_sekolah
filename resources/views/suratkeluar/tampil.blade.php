@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <div>
            <form>
                <div class=row>
                    <div class="col">
                        <h3><i class="nav-icon fas fa-envelope my-2 btn-sm-1"></i> File Surat Keluar</h3>
                        <hr />
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <h5>Nama File : {{$suratkeluar->filekeluar}}</h5>
                    </div>
                    <div class=col-4>
                        <a style="float: right" class="btn btn-primary btn-sm my-4 mr-sm-2"
                            href="/datasuratkeluar/{{$suratkeluar->filekeluar}}" download="{{$suratkeluar->filekeluar}}"
                            role="button"><i class="fas fa-file-download"></i> Download</a>
                        <a style="float: right" class="btn btn-danger btn-sm my-4 mr-sm-2" href="/suratkeluar/index"
                            role="button"><i class="fas fa-undo"></i> Kembali</a>
                    </div>
                </div>

            </form>
            <div class="text-center">
                <img src="{{URL::to('/')}}/datasuratkeluar/{{$suratkeluar->filekeluar}}" class="rounded" width="900"
                    alt="File Tidak Dapat Ditampilkan Silahkan Klik Download Untuk Melihat" />
            </div>
        </div>
    </div>
</section>
@endsection
