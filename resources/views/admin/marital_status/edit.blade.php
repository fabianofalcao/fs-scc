@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Editar tipos de pessoa</h1>
    
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index')}}">Home</a></li>
        <li><a href="{{ route('marital_status.index') }}">Estados civis</a></li>
        <li>Editar</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                
                @include('admin.includes.errors')
                
                <div class="box-body">

                        {!! Form::model($marital_status,['route' => ['marital_status.update', $marital_status->id], 'id' => 'form_upd', 'method' => 'PUT']) !!}
                            @include('admin.marital_status.form')
                        {!! Form::close() !!}

                </div><!-- /.box-body -->

                <div class="box-footer text-right">
                    <a href="{{ route('marital_status.index') }}" class="btn btn-sm btn-default">Voltar</a>
                    {!! Form::submit('Salvar', ['class' => 'btn btn-sm btn-success', 'form' => 'form_upd']) !!}
                </div>

            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop