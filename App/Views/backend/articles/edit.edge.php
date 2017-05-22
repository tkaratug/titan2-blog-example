@extends('backend.master')

@section('css')
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ get_asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Yazı Düzeltme</h1>
        <ol class="breadcrumb">
            <li><a href="/backend"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="/backend/articles">Yazılar</a></li>
            <li class="active">Yazı Düzeltme</li>
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

            {!! Form::open(['role' => 'form', 'action' => base_url('backend/articles/update/' . $article->articleId), 'method' => 'post']) !!}
            {!! Form::hidden('_token', ['value' => csrf_token()]) !!}
            <div class="col-xs-9">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Yazı Detayları</h3>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('title', 'Başlık') !!}
                            {!! Form::text('title', ['id' => 'title', 'class' => 'form-control', 'placeholder' => 'Yazı başlığı...', 'value' => $article->title]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('content', 'Yazı Metni') !!}
                            {!! Form::textarea('content', ['id' => 'content', 'class' => 'form-control', 'placeholder' => 'Yazı metni...', 'rows' => 20, 'content' => $article->content]) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-3">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Yayınla</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('categoryId', 'Kategori') !!}
                            {!! Form::select('categoryId', $categories, $article->categoryId, ['id' => 'categoryId', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('status', 'Durum') !!}
                            {!! Form::select('status', [0 => 'Taslak', 1 => 'Yayında'], $article->status, ['id' => 'status', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! Form::button('save', '<i class="fa fa-save"></i> Kaydet', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </section>
</div>
@endsection

@section('js')
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ get_asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script>
    $(function () {
        //bootstrap WYSIHTML5 - text editor
        $("#content").wysihtml5();
    });
</script>
@endsection
