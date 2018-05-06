@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Adicionar parceiro</h1>
    
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index')}}">Home</a></li>
        <li><a href="{{ route('user.index') }}">Parceiros</a></li>
        <li>Adicionar</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                
                @include('admin.includes.errors')
                
                <div class="box-body">

                        {!! Form::open(['route' => 'partner.store', 'id' => 'form_add', 'method' => 'POST']) !!}
                            @include('admin.partner.form')
                        {!! Form::close() !!}

                </div><!-- /.box-body -->

                <div class="box-footer text-right">
                    <a href="{{ route('partner.index') }}" class="btn btn-sm btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Voltar</a>
                    {!! Form::submit('Salvar', ['class' => 'btn btn-sm btn-success', 'form' => 'form_add']) !!}
                </div>

            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop