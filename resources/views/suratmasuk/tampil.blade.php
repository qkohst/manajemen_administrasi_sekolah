@extends('layouts.master')
@section('content')
<section class="content card" style="padding: 10px 10px 10px 10px ">
    <div class="box">
        <div>
            <form>
                <div class=row>
                    <div class="col">
                        <h4><i class="nav-icon fas fa-envelope-open-text my-2 btn-sm-1"></i> File Surat Masuk</h4>
                        <hr />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <h5>Nama File : {{$suratmasuk->filemasuk}}</h5>
                    </div>
                    <div class=col-md-4>
                        <a style="float: right" class="btn btn-primary btn-sm my-4 mr-2" href="/datasuratmasuk/{{$suratmasuk->filemasuk}}" download="{{$suratmasuk->filemasuk}}" role="button"><i class="fas fa-file-download"></i> Download</a>
                        <a style="float: right" class="btn btn-danger btn-sm my-4 mr-2" href="/suratmasuk/index" role="button"><i class="fas fa-undo"></i> Kembali</a>
                    </div>
                </div>
            </form>
            <div class="text-center">
                <img src="{{URL::to('/')}}/datasuratmasuk/{{$suratmasuk->filemasuk}}" class="rounded img-responsive" alt="File Tidak Dapat Ditampilkan Silahkan Klik Download Untuk Melihat" />
            </div>
        </div>
    </div>
</section>
@endsection