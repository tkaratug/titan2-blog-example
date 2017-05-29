@extends('backend.master')

@section('css')
<!-- Sweet Alert -->
<link rel="stylesheet" href="{{ get_asset('backend/plugins/sweetAlert/sweetalert.css') }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ get_asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Yazılar</h1>
        <ol class="breadcrumb">
            <li><a href="{{ link_to('backend') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Yazılar</li>
        </ol>
    </section>

    <section class="content">

        @if(Session::hasFlash())
            @php $flash = Session::getFlash() @endphp
            @if($flash['code'] == 0)
                <div class="alert alert-danger">{!! $flash['text'] !!}</div>
            @else
                <div class="alert alert-success">{!! $flash['text'] !!}</div>
            @endif
        @endif

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-edit"></i> Tüm Yazılar</h3>
                        <div class="pull-right">
                            <a href="{{ link_to('backend/articles/create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Yeni Yazı</a>
                        </div>
                    </div>
                    <div class="box-body">
                        @if(!$articles)
                        <div class="alert alert-info no-margin">Kayıtlı yazı bulunmamaktadır.</div>
                        @else
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Başlık</th>
                                    <th>Kategori</th>
                                    <th>Tarih</th>
                                    <th>Durum</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($articles as $article)
                                <tr>
                                    <td>{{ $article->articleId }}</td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->categoryName }}</td>
                                    <td>{{ Date::set($article->createdAt)->get('d.m.Y H:i:s') }}</td>
                                    <td>@if($article->status == 1) <span class="label label-success">Yayında</span> @else <span class="label label-danger">Yayında Değil</span> @endif</td>
                                    <td>
                                        <a href="{{ link_to('backend/articles/edit/' . $article->articleId) }}" data-toggle="tooltip" data-placement="top" data-original-title="Düzelt" class="btn btn-xs btn-warning">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="{{ link_to('backend/articles/delete/' . $article->articleId) }}" data-toggle="tooltip" data-placement="top" data-original-title="Sil"
                                            class="btn btn-xs btn-danger deleteArticle">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
<!-- DataTables -->
<script src="{{ get_asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ get_asset('backend/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ get_asset('backend/plugins/sweetAlert/sweetalert.min.js') }}"></script>
<script>
$(function () {
    $("#example1").DataTable();
});

$('.deleteArticle').on('click', function(e){
    e.preventDefault();

    var $this = $(this);

    swal({
        title: "Emin misin?",
        text: "Blog yazısı silindikten sonra tekrar geri getirilemez!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Evet, eminim!",
        cancelButtonText: "Hayır, silinmesin!",
        closeOnConfirm: false
    },
    function(){
        $.ajax({
            url: $this.attr('href'),
            type: "post",
            data: {},
            success: function(data) {
                var response = JSON.parse(data);

                if (response.code == 1) {
                    swal({
                        title: "Tamam!",
                        text: "Blog yazısı silindi.",
                        type: "success",
                        confirmButtonText: "Tamam"
                    },
                    function(isConfirm){
                        location.reload();
                    });
                } else {
                    swal({
                        title: "Uyarı!",
                        text: response.text,
                        type: "error",
                        confirmButtonText: "Tamam"
                    });
                }
            },
            error : function(data) {
                swal("Uyarı!", "Blog yazısı silinirken bir hata oluştu.", "error");
            }
        });
    });
});
</script>
@endsection
