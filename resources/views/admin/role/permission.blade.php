@extends('adminlte::page')

@section('title')

@section('content_header')
    <h1>Permissões do grupo de usuários: <b>{{ $role->name }}</b></h1>

    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index')}}">Home</a></li>
        <li><a href="{{ route('role.index') }}"> Grupos de usuários</a></li>
        <li>Permissões do grupo de usuários: {{ $role->name }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            {!! Form::open(['route' => ['role.permission.store', $role->id], 'method' => 'POST']) !!}
            <div class="box">
                @include('admin.includes.alerts')
                <div class="box-header">
                    
                    
                    
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    
                        
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>Grupos do usuário: </label>
                                <div class = "panel panel-default">
                                    <div class = "panel-body">
                                        <div class="row">
                                            @forelse($permissions as $permission)
                                                <div class="col-md-4">
                                                    <label class="checkbox-inline text-center">
                                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="{{ $permission->id }}" @if(in_array($permission->id, $permission_role)) checked @endif> {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @empty
                                                <p class="text-center">Não existem grupos de usuários cadastrados!</p>
                                            @endforelse
                                        </div>
                                    </div>
                                    </div>                               
                            </div>
                        </div>
                    </div>
                           
                </div><!-- /.box-body -->
                <div class="box-footer text-right">
                    <a href="{{ route('role.index') }}" class="btn btn-default btn-sm" title="Voltar"><i class="fa fa-undo" aria-hidden="true"></i>  Voltar</a>
                    {!! Form::submit('Salvar', ['class' => 'btn btn-sm btn-success']) !!}
                </div>
                
            </div><!-- /.box -->
            {!! Form::close() !!}
        </div><!-- /.col -->
    </div><!-- /.row -->
@stop