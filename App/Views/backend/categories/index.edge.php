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
        <h1>Kategoriler</h1>
        <ol class="breadcrumb">
            <li><a href="/backend"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Kategoriler</li>
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
                        <h3 class="box-title"><i class="fa fa-list"></i> Kategoriler</h3>
                        <div class="pull-right">
                            <a href="/backend/categories/create" data-toggle="modal" data-target="#remoteModal" data-backdrop="static" data-keyboard="false" class="btn btn-sm btn-success">
                                <i class="fa fa-plus"></i> Yeni Kategori
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        @if(!$categories)
                        <div class="alert alert-info no-margin">Kategori bulunmamaktadır.</div>
                        @else
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kategori</th>
                                    <th>Slug</th>
                                    <th>Tarih</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->categoryId }}</td>
                                    <td>{{ $category->categoryName }}</td>
                                    <td>{{ $category->categorySlug }}</td>
                                    <td>{{ Date::set($category->createdAt)->get('d.m.Y H:i:s') }}</td>
                                    <td>
                                        <a href="/backend/categories/edit/{{ $category->categoryId }}" data-tooltip="tooltip" data-placement="top" data-original-title="Düzelt" class="btn btn-xs btn-warning"
                                            data-toggle="modal" data-target="#remoteModal" data-backdrop="static" data-keyboard="false">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="/backend/categories/delete/{{ $category->categoryId }}" data-tooltip="tooltip" data-placement="top" data-original-title="Sil"
                                            class="btn btn-xs btn-danger deleteCategory">
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
    $('[data-tooltip="tooltip"]').tooltip();
    $("#example1").DataTable();
});

$('.deleteCategory').on('click', function(e){
    e.preventDefault();

    var $this = $(this);

    swal({
        title: "Emin misin?",
        text: "Kategori silindikten sonra tekrar geri getirilemez!",
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
                        text: "Kategori silindi.",
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
                swal("Uyarı!", "Kategori silinirken bir hata oluştu.", "error");
            }
        });
    });
});
</script>
@endsection
