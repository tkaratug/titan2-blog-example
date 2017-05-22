@extends('backend.master')

@section('css')
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Yönetici Şifresi</h1>
        <ol class="breadcrumb">
            <li><a href="/backend"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Yönetici Şifresi</li>
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

        {!! Form::open(['action' => '/backend/admin/update', 'method' => 'post']) !!}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-lock"></i> Yönetici Şifresini Değiştirme</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('current', 'Mevcut Şifre') !!}
                    {!! Form::password('current', ['id' => 'current', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('new', 'Yeni Şifre') !!}
                    {!! Form::password('new', ['id' => 'new', 'class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('new_confirm', 'Yeni Şifre (Tekrar)') !!}
                    {!! Form::password('new_confirm', ['id' => 'new_confirm', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="box-footer">
                {!! Form::button('save', '<i class="fa fa-save"></i> Kaydet', ['type' => 'submit', 'class' => 'btn btn-sm btn-success']) !!}
            </div>
        </div>
        {!! Form::close() !!}

    </section>

</div>
@endsection

@section('js')
@endsection
