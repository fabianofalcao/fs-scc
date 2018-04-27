@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Editar tipos de pessoa</h1>
    
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index')}}">Home</a></li>
        <li><a href="{{ route('person_types.index') }}">Tipos de pessoa</a></li>
        <li>Editar</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                
                @include('admin.includes.errors')
                
                <div class="box-body">

                        {!! Form::model($person_type,['route' => ['person_types.update', $person_type->id], 'id' => 'form_upd', 'method' => 'PUT']) !!}
                            @include('admin.person_type.form')
                        {!! Form::close() !!}

                </div><!-- /.box-body -->

                <div class="box-footer text-right">
                    <a href="{{ route('person_types.index') }}" class="btn btn-sm btn-default">Voltar</a>
                    {!! Form::submit('Salvar', ['class' => 'btn btn-sm btn-success', 'form' => 'form_upd']) !!}
                </div>

            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop