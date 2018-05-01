@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Editar usuário</h1>
    
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index')}}">Home</a></li>
        <li><a href="{{ route('company.index') }}">Empresas</a></li>
        <li>Editar</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                
                @include('admin.includes.errors')
                
                <div class="box-body">

                        {!! Form::model($company,['route' => ['company.update', $company->id], 'id' => 'form_upd', 'method' => 'PUT']) !!}
                            @include('admin.company.form')
                        {!! Form::close() !!}

                </div><!-- /.box-body -->

                <div class="box-footer text-right">
                    <a href="{{ route('company.index') }}" class="btn btn-sm btn-default"><i class="fa fa-undo" aria-hidden="true"></i> Voltar</a>
                    {!! Form::submit('Salvar', ['class' => 'btn btn-sm btn-success', 'form' => 'form_upd']) !!}
                </div>

            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop